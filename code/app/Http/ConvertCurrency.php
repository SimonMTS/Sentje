<?php

namespace App\Http;

class ConvertCurrency
{

    public static function EURtoUSD( $amount )
    {
        try {
            
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.exchangeratesapi.io/latest');
            $rate = json_decode($response->getBody())->rates->USD;
        
        } catch (Exception $e) {
            
            $rate = 1.12;

        }

        return $amount * $rate;
    }

}