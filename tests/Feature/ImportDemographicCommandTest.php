<?php

namespace Tests\Feature;

use App\Models\StudentDemographicInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportDemographicCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_demographic_command_is_sucessfull(): void
    {
        $this->artisan('import:student-demographic-info')->assertSuccessful();
    }

    public function test_import_demographic_command_inserts_data(): void
    {
        $this->artisan('import:student-demographic-info');
        $count = StudentDemographicInfo::count();
        $this->assertGreaterThan(0,$count);
    }
}
