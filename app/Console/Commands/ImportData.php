<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Course;


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
        try{
            DB::beginTransaction();

            $file_path = $this->ask('Enter the filepath you are going to import: ');
            $reader = ReaderEntityFactory::createReaderFromFile($file_path);
            $reader->open($file_path);

            $headers=$this->getHeaders($reader);
            $confirm_headers = $this->confirm('Are the following headers correct: ' . implode(", " ,$headers));
            // TODO add exit if they are not confirmed

            $row_counter=0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row_number => $row) {
                    if($row_number>1){ //not done for header row
                        $data=$this->rowToArray($row);
                        $this->table($headers,[$data]);
                        $course_ID=$this->insertCourse($data);
                        $professor_ID=$this->insertProfessor($data);
                        $this->createGradeLineItem($course_ID,$professor_ID);
                    }
                    $row_counter++;
                }
            }
    
            $this->info( "import completed ". $row_counter . " records processed");
            DB::commit();
            return Command::SUCCESS;
        }
        catch(Exception $e){
            DB::rollBack();
            $this->error("Error: " .$e->getMessage());
            return 1;
        }
        
    }

    private function getHeaders($reader){
        
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                return $this->rowToArray($row);
            }
        }
    }

    private function rowToArray($row){
        $data_array=[];
        foreach($row->getCells() as $cell){
            $data_array[]=$cell->getValue();
        }
        return $data_array;
    }

    private function insertCourse($data){
        $course=DB::table('courses')->where("courseNumber",$data[2])->where("departmentCode",$data[1])->first();
        if($course){
            echo($data[1] . "-" . $data[2] . " found\n");
            return $course->id;
        }
        else{
            $course_title = $this->ask("What is the name of " . $data[1] . "-" . $data[2] . "?");
            $course_desciption = $this->ask("What is the course description of " . $data[1] . "-" . $data[2] . "?");
            $new_course = new Course;
            $new_course->courseTitle = $course_title;
            $new_course->description = $course_desciption;
            $new_course->departmentCode = $data[1];
            $new_course->courseNumber = $data[2];
            $new_course->save();

            echo("inserting course " . $data[1] . "-" . $data[2] . "\n");
            return $new_course->id;
        }
        
    }

    private function insertProfessor($data){
        //implement insertion
        echo("inserting professor \n");
        return 5;
    }

    private function createGradeLineItem($course_ID, $professor_ID){
        //implement insertion
        echo("inserting grade line item \n");
    }
}
