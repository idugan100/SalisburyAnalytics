<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Symfony\Component\Process\Process;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ViewAboutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_about_view()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/about');


        $this->assertSame(1,UsageLog::where("created_at",now())->first()->about_views);
    }

}
