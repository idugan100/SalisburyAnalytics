<?php

namespace App\Services;

class IsBot
{
    public static function check(string $ip, string $user_agent): bool
    {
        $user_agent_result = preg_match('/.*bot.*|Mediapartners-Google|.*python-requests.*|.*http.*|.*node-fetch.*|.*postman.*|.*curl.*|.*Bytespider.*|.*Status Cake Uptime Monitoring.*/', $user_agent);
        $ip_result = preg_match(
            '/54.198.193.239|18.203.99.29|23.20.205.139|54.198.181.10|54.237.245.103|52.90.196.158|3.84.129.243|52.90.196.158|54.173.157.97|44.203.91.18|3.81.172.31|54.183.164.142|44.200.174.154|54.243.7.211|34.204.78.11|54.159.21.79/', $ip
        );

        return $user_agent_result || $ip_result;
    }
}
