<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUsageLogCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_usage_log_command_is_sucessfull(): void
    {
        $this->artisan('create-usage-log')->assertSuccessful();
    }

    public function test_create_usage_log_command_creates_log(): void
    {
        $this->artisan('create-usage-log');

        $this->assertDatabaseCount('usage_log', 1);
    }
}
