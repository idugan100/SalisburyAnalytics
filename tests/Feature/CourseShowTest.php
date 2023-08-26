<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\UsageLog;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CourseShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_course_premium_redirect()
    {
        UsageLog::factory()->create();
        Course::factory()->create();

        $response = $this->get(route("courses.show",1));

        $response->assertStatus(302);
        $response->assertRedirect("/premium");    
    }

    public function test_show_course_when_subscribed()
    {
        $user = User::factory()->create();
        $user->stripe_id=env("TEST_CUSTOMER_STRIPE_ID");
        $user->save();
        
        UsageLog::factory()->create();

        Course::factory()->create();

        $user->newSubscription('default', env("PLAN_ID"))->create();
                 
        $response = $this->actingAs($user)
        ->get(route("courses.show",2));

        $response->assertStatus(200);
    }

    public function test_show_course_checkout_redirect_if_logged_in_and_not_subscribed(){

        $user = User::factory()->create();
        UsageLog::factory()->create();
        
        Course::factory()->create();

        $response = $this->actingAs($user)
        ->get(route("courses.show",3));

        $response->assertStatus(302);
        $response->assertRedirect("/product-checkout"); 

    }
}
