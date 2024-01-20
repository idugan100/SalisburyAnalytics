<?php

namespace App\Jobs;

use App\Models\Professor;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecalculateProfessorStatistics implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array<Professor>
     */
    private $professors;

    /**
     * @param  array<Professor>  $professors
     */
    public function __construct($professors)
    {
        $this->professors = $professors;
    }

    public function handle(): void
    {
        foreach ($this->professors as $professor) {
            $professor->calculate_statistics();
        }
    }
}
