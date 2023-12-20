<?php

namespace App\services;

use Illuminate\Http\Request;


class IsBot
{
    public static function check(Request $request)
    {
        $user_agent = preg_match('/.*bot.*|.*python-requests.*|.*http.*|.*node-fetch.*|.*postman.*|.*curl.*|.*Bytespider.*/', $request->userAgent());
        $ip = preg_match(
            '/54.198.193.239|23.20.205.139|54.198.181.10|54.237.245.103|52.90.196.158|3.84.129.243|52.90.196.158|54.173.157.97|44.203.91.18|3.81.172.31|54.183.164.142|44.200.174.154|54.243.7.211|34.204.78.11|54.159.21.79/'
            ,$request->ip());

        return ($ip || $user_agent);
    }
}
