<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UsageLog;
use App\Models\Professor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessorShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_professor_premium_redirect()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        Professor::factory()->create();

        $response = $this->get(route("professors.show",1));

        $response->assertStatus(302);
        $response->assertRedirect("/premium");    
    }

    public function test_show_professor_when_subscribed()
    {
        $user = User::factory()->create();
        $user->stripe_id=env("TEST_CUSTOMER_STRIPE_ID");
        $user->save();
        
        $usage_log= new UsageLog();
        $usage_log->save();
        Professor::factory()->create();

        $user->newSubscription('default', env("PLAN_ID"))->create();
                 
        $response = $this->actingAs($user)
        ->get(route("professors.show",2));

        $response->assertStatus(200);
    }

    public function test_show_professor_checkout_redirect_if_logged_in_and_not_subscribed(){

        $user = User::factory()->create();
        $usage_log= new UsageLog();
        $usage_log->save();
        Professor::factory()->create();

        $response = $this->actingAs($user)
        ->get(route("professors.show",3));

        $response->assertStatus(302);
        $response->assertRedirect("/product-checkout"); 

    }
}
