<?php

namespace App\Services;

use App\Models\StudentDemographicInfo;
use Exception;
use Illuminate\Support\Facades\Http;

class StudentDemographicsManager
{
    /** @var object */
    private $api_data_response;

    /** @var StudentDemographicInfo */
    private $student_demographic_info;

    /** @var string */
    private static $route = 'https://api.data.gov/ed/collegescorecard/v1/schools.json';

    /** @var bool */
    public $is_error;

    /** @var string */
    public $error_message;

    public function __construct()
    {
        $this->student_demographic_info = new StudentDemographicInfo();
        $this->is_error = false;
    }

    public function import(): void
    {
        try {
            //extract from api
            $this->api_request();
            //transform json to eloquent model
            $this->marshal_data();
            //load model into db and log
            $this->insert_into_db();
        } catch (Exception $e) {
            $this->is_error = true;
            $this->error_message = $e->getMessage();
        }

    }

    private function api_request(): void
    {
        $response = Http::get($this::$route, [
            'school.name' => env('UNIVERSITY_NAME'),
            'api_key' => env('DoE_API_KEY'),
        ]);

        $body = json_decode($response->body());
        $this->api_data_response = $body->results[0]->latest;
    }

    private function insert_into_db(): void
    {
        $this->student_demographic_info->save();
    }

    private function marshal_data(): void
    {
        //ethnicity
        $ethnicity_object = $this->api_data_response->student->demographics->race_ethnicity;

        $this->student_demographic_info->native_american_pct = $this->format_percentage($ethnicity_object->aian);
        $this->student_demographic_info->pacific_islander_pct = $this->format_percentage($ethnicity_object->nhpi);
        $this->student_demographic_info->asian_pct = $this->format_percentage($ethnicity_object->asian);
        $this->student_demographic_info->black_pct = $this->format_percentage($ethnicity_object->black);
        $this->student_demographic_info->white_pct = $this->format_percentage($ethnicity_object->white);
        $this->student_demographic_info->hispanic_pct = $this->format_percentage($ethnicity_object->hispanic);
        $this->student_demographic_info->two_or_more_races_pct = $this->format_percentage($ethnicity_object->two_or_more);
        $this->student_demographic_info->unknow_race_pct = $this->format_percentage($ethnicity_object->unknown);

        //gender
        $gender_object = $this->api_data_response->student->demographics;
        $this->student_demographic_info->male_pct = $this->format_percentage($gender_object->men);
        $this->student_demographic_info->non_male_pct = $this->format_percentage($gender_object->women);

        //parental education
        $education_object = $this->api_data_response->student->share_firstgeneration_parents;
        $first_gen_percentage = $this->api_data_response->student->demographics->first_generation;

        $this->student_demographic_info->middle_school_pct = $this->format_percentage($first_gen_percentage * $education_object->middleschool);
        $this->student_demographic_info->high_school_pct = $this->format_percentage($first_gen_percentage * $education_object->highschool);
        $this->student_demographic_info->some_college_pct = $this->format_percentage($first_gen_percentage * $education_object->somecollege);
        $this->student_demographic_info->college_degree_pct = $this->format_percentage(1 - $first_gen_percentage);

        //student type
        $enrollment_object = $this->api_data_response->student->enrollment;
        $this->student_demographic_info->undergraduate_count = $enrollment_object->undergrad_12_month;
        $this->student_demographic_info->graduate_count = $enrollment_object->grad_12_month;

        //parental income
        $income_object = $this->api_data_response->student;
        $this->student_demographic_info->pct_0_30000 = $this->format_percentage($income_object->share_lowincome->{'0_30000'});
        $this->student_demographic_info->pct_30001_48000 = $this->format_percentage($income_object->share_middleincome->{'30001_48000'});
        $this->student_demographic_info->pct_48001_75000 = $this->format_percentage($income_object->share_middleincome->{'48001_75000'});
        $this->student_demographic_info->pct_75001_110000 = $this->format_percentage($income_object->share_highincome->{'75001_110000'});
        $this->student_demographic_info->pct_110001_greater = $this->format_percentage($income_object->share_highincome->{'110001plus'});
    }

    private function format_percentage(float $number): float
    {
        return round(($number * 100), 1);
    }
}
