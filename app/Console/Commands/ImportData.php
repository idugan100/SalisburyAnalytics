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
    public function handle()
    {
        $file_path = $this->ask('Enter the filepath you are going to import: ');

        $reader = ReaderEntityFactory::createReaderFromFile($file_path);

        $reader->open($file_path);
        $row_counter=0;
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // do stuff with the row
                $cells = $row->getCells();
                $row_counter++;
            }
        }

        echo "import completed ". $row_counter . " records processed";
        return Command::SUCCESS;
    }
}
