<?php

namespace Tests\Unit;

use App\Services\IsBot;
use PHPUnit\Framework\TestCase;

class IsBotTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_find_bot_by_user_agent(): void
    {
        $isBot = new IsBot();
        $result = $isBot::check('192.123.03.21', 'Mozilla/5.0 (Linux; Android 5.0) AppleWebKit/537.36 (KHTML, like Gecko) Mobile Safari/537.36 (compatible; Bytespider; spider-feedback@bytedance.com)');

        $this->assertTrue($result);
    }

    public function test_find_bot_by_ip_address(): void
    {
        $isBot = new IsBot();
        $result = $isBot::check('54.198.181.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Safari/605.1.15');

        $this->assertTrue($result);
    }

    public function test_find_bot_by_ip_and_user_agent()
    {
        $isBot = new IsBot();
        $result = $isBot::check('54.198.181.10', 'Mozilla/5.0 (Linux; Android 5.0) AppleWebKit/537.36 (KHTML, like Gecko) Mobile Safari/537.36 (compatible; Bytespider; spider-feedback@bytedance.com)');

        $this->assertTrue($result);
    }

    public function test_find_real_user()
    {
        $isBot = new IsBot();
        $result = $isBot::check('192.123.03.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Safari/605.1.15');

        $this->assertFalse($result);
    }
}
