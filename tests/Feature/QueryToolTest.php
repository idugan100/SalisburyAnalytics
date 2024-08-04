<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QueryToolTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_query_tool_premium_redirect()
    {
        UsageLog::factory()->create();

        $response = $this->get('/query_tool');

        $response->assertStatus(302);
        $response->assertRedirect('/premium');
    }

    public function test_show_query_tool_when_subscribed()
    {

        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)
            ->get(route('qtool'));

        $response->assertStatus(200);
    }

    public function test_show_query_tool_checkout_redirect_if_logged_in_and_not_subscribed()
    {

        UsageLog::factory()->create();

        $response = $this->actingAs($this->unsubscribed_user)
            ->get(route('qtool'));

        $response->assertStatus(302);
        $response->assertRedirect('/product-checkout');

    }
}
