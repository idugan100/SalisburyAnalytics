<?php

namespace Tests\Feature;

use App\Http\Controllers\ReviewController;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_approval(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $review = Review::factory()->create();

        $this->actingAs($user)->get(route('review.approve', $review));

        $this->assertDatabaseHas('reviews', [
            'response' => $review->response,
            'approved_flag' => ReviewController::APPROVED_FLAG,
        ]);
    }

    public function test_review_rejection(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $review = Review::factory()->create();

        $this->actingAs($user)->get(route('review.reject', $review));

        $this->assertDatabaseHas('reviews', [
            'response' => $review->response,
            'approved_flag' => ReviewController::REJECTED_FLAG,
        ]);
    }

    public function test_review_reprocessing(): void
    {
        $user = User::factory()->create();
        $user->email = env('ADMIN_EMAIL');

        $review = Review::factory()->create();
        $review->approved_flag = ReviewController::APPROVED_FLAG;
        $review->save();

        $response = $this->actingAs($user)->get(route('review.reprocess', ['review' => $review, 'origin' => 'approved']));
        $response->assertStatus(302);
        $this->assertDatabaseHas('reviews', [
            'response' => $review->response,
            'approved_flag' => ReviewController::PROCESSING_FLAG,
        ]);
    }
}
