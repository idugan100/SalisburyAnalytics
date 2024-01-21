<?php

namespace App\Jobs;

use App\Models\Professor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RecalculateProfessorStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $timeout = 300;

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
            Log::info('Calculation for professor '.$professor->id .' completed');
        }
    }
}
