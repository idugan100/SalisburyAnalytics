<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryToolTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_query_tool_premium_redirect()
    {
        UsageLog::factory()->create();

        $response = $this->get('/query_tool');

        $response->assertStatus(302);
        $response->assertRedirect('/premium');
    }

    public function test_show_query_tool_when_subscribed()
    {
        $user = User::factory()->create();
        $user->stripe_id = env('TEST_CUSTOMER_STRIPE_ID');
        $user->save();

        UsageLog::factory()->create();

        $user->newSubscription('default', env('PLAN_ID'))->create();
        $user->pm_type = 'visa';

        $response = $this->actingAs($user)
            ->get(route('qtool'));

        $response->assertStatus(200);
    }

    public function test_show_query_tool_checkout_redirect_if_logged_in_and_not_subscribed()
    {

        $user = User::factory()->create();
        UsageLog::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('qtool'));

        $response->assertStatus(302);
        $response->assertRedirect('/product-checkout');

    }
}
