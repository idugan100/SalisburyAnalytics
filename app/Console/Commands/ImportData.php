<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


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

     //TOdo implemnt transactions -https://laravel.com/docs/10.x/database#database-transactions
     //TODO implement try catch
    public function handle()
    {
        $file_path = $this->ask('Enter the filepath you are going to import: ');

        $reader = ReaderEntityFactory::createReaderFromFile($file_path);

        $reader->open($file_path);
        $headers=$this->getHeaders($reader);
        $confirm_headers = $this->confirm('Are the following headers correct: ' . implode("," ,$headers));
        //add exit if they are not confirmed
        $row_counter=0;
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row_number => $row) {
                if($row_number>1){ //not done for header row
                    $data=$this->rowToArray($row);
                    $this->table($headers,[$data]);
                    $course_ID=$this->insertCourse($data);
                    $professor_ID=$this->insertProfessor($data);
                    $this->createGradeLineIterm($course_ID,$professor_ID);
                }
                $row_counter++;
            }
        }

        $this->info( "import completed ". "{{set up counter here}}" . " records processed");
        return Command::SUCCESS;
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
        //implement insertion
        echo("inserting course \n");
        return 2;
    }

    private function insertProfessor($data){
        //implment insertion
        echo("inserting professor \n");
        return 5;
    }

    private function createGradeLineIterm($course_ID, $professor_ID){
        //implement insertion
        echo("inserting grade line item \n");
    }
}
