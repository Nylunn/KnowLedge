<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class Shoptest extends TestCase
{
    public function TestShop()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/formations',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
