<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Professor;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\XLSX\Reader;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command to import data from an excel file into the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            $file_path = $this->ask('Enter the filepath you are going to import: ');
            $reader = new Reader();
            $reader->open($file_path);

            $headers = $this->getHeaders($reader);
            $confirm_headers = $this->confirm('Are the following headers correct: '.implode(', ', $headers));
            if (! $confirm_headers) {
                $this->error('Incorrect headers please double check the file');

                return Command::FAILURE;
            }

            $row_counter = 0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row_number => $row) {
                    if ($row_number > 1) { //not done for header row
                        DB::beginTransaction();
                        $data = $this->rowToArray($row);
                        $this->table($headers, [$data]);
                        $course_ID = $this->insertCourse($data);
                        $professor_ID = $this->insertProfessor($data);
                        $this->createGradeLineItem($course_ID, $professor_ID, $data);
                        DB::commit();
                    }
                    $row_counter++;
                }
            }

            $this->info('import completed '.$row_counter.' records processed');

            return Command::SUCCESS;
        } catch (Exception $e) {
            DB::rollBack();
            $this->error('Error: '.$e->getMessage());

            return 1;
        }

    }

    /**
     * @return array<string>
     */
    private function getHeaders(Reader $reader): array
    {

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                return $this->rowToArray($row);
            }
        }

        return [];
    }

    /**
     * @return array<string>
     */
    private function rowToArray(Row $row)
    {
        $data_array = [];
        foreach ($row->getCells() as $cell) {
            $data_array[] = $cell->getValue();
        }

        return $data_array;
    }

    /**
     * @param  array<string>  $data
     */
    private function insertCourse(array $data): int
    {
        $course = DB::table('courses')->where('courseNumber', $data[2])->where('departmentCode', $data[1])->first();
        if ($course) {
            echo $data[1].'-'.$data[2]." found\n";

            return $course->id;
        } else {
            $course_title = $this->ask('What is the name of '.$data[1].'-'.$data[2].'?');
            $course_desciption = $this->ask('What is the course description of '.$data[1].'-'.$data[2].'?');
            $new_course = new Course;
            $new_course->courseTitle = $course_title;
            $new_course->description = $course_desciption;
            $new_course->departmentCode = $data[1];
            $new_course->courseNumber = (int) $data[2];
            $new_course->save();

            echo 'inserting course '.$data[1].'-'.$data[2]."\n";

            return $new_course->id;
        }

    }

    /**
     * @param  array<string>  $data
     */
    private function insertProfessor($data): int
    {
        $name_array = explode(',', $data[4]);
        $professor = Professor::where('lastName', $name_array[0])->where('firstName', $name_array[1])->first();
        if ($professor) {
            echo 'Professor '.$name_array[1].' '.$name_array[0]." found\n";

            return $professor->id;
        } else {
            $new_professor = new Professor;
            $new_professor->firstName = $name_array[1];
            $new_professor->lastName = $name_array[0];
            $new_professor->save();
            echo 'Inserting professor '.$name_array[1].' '.$name_array[0]."\n";

            return $new_professor->id;
        }
    }

    /**
     * @param  array<string>  $data
     */
    private function createGradeLineItem(int $course_ID, int $professor_ID, $data): void
    {
        switch ($data[0]) {
            case 'Fall10':
                $year = 2010;
                $semester = 'Fall';
                break;
            case 'Fall11':
                $year = 2011;
                $semester = 'Fall';
                break;
            case 'Fall12':
                $year = 2012;
                $semester = 'Fall';
                break;
            case 'Fall13':
                $year = 2013;
                $semester = 'Fall';
                break;
            case 'Fall14':
                $year = 2014;
                $semester = 'Fall';
                break;
            case 'Fall23':
                $year = 2023;
                $semester = 'Fall';
                break;
            case 'Spring10':
                $year = 2010;
                $semester = 'Spring';
                break;
            case 'Spring11':
                $year = 2011;
                $semester = 'Spring';
                break;
            case 'Spring12':
                $year = 2012;
                $semester = 'Spring';
                break;
            case 'Spring13':
                $year = 2013;
                $semester = 'Spring';
                break;
            case 'Spring14':
                $year = 2014;
                $semester = 'Spring';
                break;
            case 'Spring15':
                $year = 2015;
                $semester = 'Spring';
                break;
            default:
                $year = 0;
                $semester = '';
                break;
        }
        $line_items = DB::table('courses_x_professors_with_grades')
            ->where('course_ID', $course_ID)
            ->where('professor_ID', $professor_ID)
            ->where('semester', $semester)
            ->where('year', (int) $year)
            ->where('quantity', (int) $data[6])
            ->where('grade', $data[5])
            ->where('section_number', (int) $data[3])
            ->get();
        if (count($line_items) == 0) {

            DB::table('courses_x_professors_with_grades')->insert([
                'course_ID' => $course_ID,
                'professor_ID' => $professor_ID,
                'semester' => $semester,
                'quantity' => (int) $data[6],
                'grade' => $data[5],
                'section_number' => (int) $data[3],
                'year' => (int) $year,
            ]);
            echo "inserting grade line item \n";
        } else {
            echo "line item already entered \n";
        }

    }
}
