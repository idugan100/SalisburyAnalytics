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

    public $professors;
    /**
     * Create a new job instance.
     */
    public function __construct(array $professors)
    {
        $this->professors=$professors;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->professors as $professor){
            $professor->calculate_statistics();
        }
    }
}
