<?php

namespace Tests\Feature;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewPortalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_approve()
    {
        $review=new Review();
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
