<?php

namespace App\Jobs;

use App\Models\Professor;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RecalculateProfessorStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * @var array<Professor>
     */
    private $professors;
    

    /**
     * @param array<Professor> $professors
     */
    public function __construct($professors)
    {
        $this->professors=$professors;
    }

    public function handle(): void
    {
        foreach($this->professors as $professor){
            $professor->calculate_statistics();
        }
    }
}
