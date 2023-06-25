<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Professor;


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
                        DB::beginTransaction();
                        $data=$this->rowToArray($row);
                        $this->table($headers,[$data]);
                        $course_ID=$this->insertCourse($data);
                        $professor_ID=$this->insertProfessor($data);
                        $this->createGradeLineItem($course_ID, $professor_ID, $data);
                        DB::commit();
                    }
                    $row_counter++;
                }
            }
    
            $this->info( "import completed ". $row_counter . " records processed");
            
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
        $name_array=explode(",",$data[3]);
        $professor=Professor::where("lastName",$name_array[0])->where("firstName",$name_array[1])->first();
        if($professor){
            echo("Professor " . $name_array[1] . " " . $name_array[0] . " found\n");
            return $professor->id;
        }
        else{
            $new_professor= new Professor;
            $new_professor->firstName = $name_array[1];
            $new_professor->lastName = $name_array[0];
            $new_professor->save();
            echo("Inserting professor " . $name_array[1] . " " . $name_array[0] . "\n");
            return $new_professor->id;
        }
    }

    private function createGradeLineItem($course_ID, $professor_ID, $data){
        $line_items=DB::table('courses_x_professors_with_grades')
            ->where("course_ID",$course_ID)
            ->where("professor_ID",$professor_ID)
            ->where("semester",$data[0])
            ->where("quantity",$data[5])
            ->where("grade",$data[4])
            ->get();
        if(count($line_items)==0){
            $date_array=explode(" ",$data[0]);
            $year=2000+$date_array[1];
            if($date_array[0]=="Spr"){
                $semester="Spring";
            }
            else{
                $semester="Fall";
            }
            DB::table('courses_x_professors_with_grades')->insert([
                "course_ID" => $course_ID,
                "professor_ID" => $professor_ID,
                "semester" => $semester,
                "quantity" => $data[5],
                "grade" => $data[4],
                "year"=> $year
                ]);
            echo("inserting grade line item \n");
        }
        else{
            echo("line item already entered \n");
        }
        
    }
}
