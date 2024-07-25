<?php

namespace App\Services;

use App\Models\FinancialOutcomeInfo;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FinancialOutcomesManager
{
    /** @var object */
    private $api_data_response;

    /** @var array<FinancialOutcomeInfo> */
    private $outcomes;

    /** @var string */
    private static $route = 'https://api.data.gov/ed/collegescorecard/v1/schools.json';

    /** @var bool */
    public $is_error;

    /** @var string */
    public $error_message;

    /** @var int */
    public $api_count;

    /** @var int */
    public $ingested_count;

    public function __construct()
    {
        $this->api_count = 0;
        $this->ingested_count = 0;
        $this->outcomes = [];
        $this->is_error = false;
    }

    public function import(): void
    {
        try {
            //extract from api
            $this->api_request();
            //transform json to eloquent models
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
            'school.name' => env("UNIVERSITY_NAME"),
            'api_key' => env('DoE_API_KEY'),
        ]);

        $body = json_decode($response->body());
        $this->api_data_response = $body->results[0]->latest->programs->cip_4_digit;
        $this->api_count = count($this->api_data_response);
    }

    private function insert_into_db(): void
    {
        DB::beginTransaction();
        FinancialOutcomeInfo::query()->delete();
        foreach ($this->outcomes as $outcome) {
            $outcome->save();
        }
        DB::commit();
        $this->ingested_count = count($this->outcomes);
    }

    private function marshal_data(): void
    {
        foreach ($this->api_data_response as $program) {
            try {
                $outcome = new FinancialOutcomeInfo();

                //names
                $outcome->program_name = $program->title ? strtolower($program->title) : throw new Exception('Empty Name Value');
                $outcome->credential_name = $program->credential->title ? strtolower($program->credential->title) : throw new Exception('Empty Name Value');

                //earnings
                $outcome->median_income_year_1 = $program->earnings->{'1_yr'}->overall_median_earnings ?? throw new Exception('Empty 1 yr earnings Value');
                $outcome->median_income_year_4 = $program->earnings->{'4_yr'}->overall_median_earnings ?? throw new Exception('Empty 4 yr earnings Value');

                //employment
                $outcome->employed_count_year_1 = $program->earnings->{'1_yr'}->working_not_enrolled->overall_count ?? throw new Exception('Empty employment Value');
                $outcome->unemployed_count_year_1 = $program->earnings->{'1_yr'}->not_working_not_enrolled->overall_count ?? throw new Exception('Empty employment Value');
                $outcome->employed_count_year_4 = $program->earnings->{'4_yr'}->working_not_enrolled->overall_count ?? throw new Exception('Empty employment Value');
                $outcome->unemployed_count_year_4 = $program->earnings->{'4_yr'}->not_working_not_enrolled->overall_count ?? throw new Exception('Empty employment Value');

                $this->outcomes[] = $outcome;
            } catch (Exception $e) {

            }
        }

    }
}
