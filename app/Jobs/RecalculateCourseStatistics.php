<?php

namespace App\Jobs;

use App\Models\Course;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RecalculateCourseStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * @var array<Course>
     */
    private $courses;
    
    /**
     * @param array<Course> $courses
     */
    public function __construct( $courses)
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
