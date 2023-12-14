<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RecalculateCourseStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private $courses;
    /**
     * Create a new job instance.
     */
    public function __construct(array $courses)
    {
        $this->courses=$courses;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->courses as $course){
            $course->calculate_statistics();
        }
    }
}
