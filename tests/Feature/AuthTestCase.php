<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class AuthTestCase extends TestCase
{
    use RefreshDatabase;

    protected $subscribed_user;

    protected $unsubscribed_user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subscribed_user = User::factory()->create();
        $this->subscribed_user->stripe_id = env('TEST_CUSTOMER_STRIPE_ID');

        $this->subscribed_user->newSubscription('default', env('PLAN_ID'))->create();
        $this->subscribed_user->pm_type = 'visa';
        $this->subscribed_user->save();

        $this->unsubscribed_user = User::factory()->create();
        $this->unsubscribed_user->save();
    }
}
