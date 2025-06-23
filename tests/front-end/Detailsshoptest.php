<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class Detailsshoptest extends TestCase
{
    public function testDetailsShop()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/formations/1',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
