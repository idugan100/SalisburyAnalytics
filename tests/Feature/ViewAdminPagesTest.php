<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_view_processing_reviews(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $response = $this->actingAs($user)->get(route('reviews.processing'));
        $response->assertStatus(200);
    }

    public function test_admin_view_rejected_reviews(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $response = $this->actingAs($user)->get(route('reviews.rejected'));
        $response->assertStatus(200);
    }

    public function test_admin_view_approved_reviews(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $response = $this->actingAs($user)->get(route('reviews.approved'));
        $response->assertStatus(200);
    }

    public function test_admin_view_usage(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $response = $this->actingAs($user)->get(route('usage.index'));
        $response->assertStatus(200);
    }

    public function test_non_admin_view_rejected_reviews(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('reviews.rejected'));
        $response->assertStatus(302);
    }

    public function test_non_admin_view_approved_reviews(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('reviews.approved'));
        $response->assertStatus(302);
    }

    public function test_non_admin_view_processing_reviews(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('reviews.processing'));
        $response->assertStatus(302);
    }

    public function test_non_admin_view_usage(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('usage.index'));
        $response->assertStatus(302);
    }
}
