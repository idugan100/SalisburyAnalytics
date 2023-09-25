<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Review;
use Database\Factories\ReviewFactory;
use App\Http\Controllers\ReviewController;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewSubmissionApprovalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //processing
    public function test_new_review_has_pending_status()
    {
        $review=Review::factory()->create();
        $this->assertSame($review->approved_flag,ReviewController::PROCESSING_FLAG);
        
    }

    public function test_processing_reviews_not_show_to_users(){
        $review=Review::factory()->create();
        UsageLog::factory()->create();
        $response=$this->get(route("reviews.index"));
        $response->assertStatus(200);
        $response->assertDontSee($review->response);
    }

    public function test_processing_screen_redirection_if_not_logged_in(){
        $response=$this->get(route("reviews.processing"));
        $response->assertStatus(302);
        $response->assertSee("login");
    }

    public function test_processing_screen_redirection_if_not_admin(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route("reviews.processing"));
        $response->assertStatus(302);
        $response->assertSee("/courses");
    }

    public function test_processing_screen_acess_if_admin(){
        $user = User::factory()->create();
        $user->email=env("ADMIN_EMAIL");
        $user->save();
        $response = $this->actingAs($user)->get(route("reviews.processing"));
        $response->assertStatus(200);
        $response->assertSee("Processing Reviews");
    }

    public function test_
    //approval
    public function test_review_approval_route(){
        $review=Review::factory()->create();
        $review_controller= new ReviewController();
        $review_controller->approve($review);
        $this->assertSame($review->approved_flag, ReviewController::APPROVED_FLAG);
    }

    public function test_approved_screen_redirection_if_not_logged_in(){
        $review=Review::factory()->create();
        $response=$this->get(route("review.approve",$review));
        $response->assertStatus(302);
        $response->assertSee("login");
    }

    public function test_approved_screen_redirection_if_not_admin(){
        $user = User::factory()->create();
        $review=Review::factory()->create();
        $response = $this->actingAs($user)->get(route("review.approve",$review));
        $response->assertStatus(302);
        $response->assertSee("/courses");
    }

    public function test_approved_review_screen_redirection_if_admin(){
        $user = User::factory()->create();
        $user->email=env("ADMIN_EMAIL");
        $user->save();
        $response = $this->actingAs($user)->get(route("reviews.approved"));
        $response->assertStatus(200);
        $response->assertSee("Approved Reviews");

    }
    //rejection
}
