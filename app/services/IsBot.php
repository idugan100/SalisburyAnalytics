<?php
namespace App\services;

class IsBot

{
    public static function check($agent_string){
        $result=preg_match("/.*bot.*|.*python-requests.*|.*http.*|.*node-fetch.*|.*postman.*|.*curl.*|.*ByteSpider.*/",$agent_string);
        return $result ? True : False;
    }

}