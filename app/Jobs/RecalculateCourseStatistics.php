<?php

namespace App\Jobs;

use App\Models\Course;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecalculateCourseStatistics implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array<Course>
     */
    private $courses;

    /**
     * @param  array<Course>  $courses
     */
    public function __construct($courses)
    {
        $this->courses = $courses;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->courses as $course) {
            $course->calculate_statistics();
        }
    }
}
