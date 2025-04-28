<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class logoutTest extends TestCase
{
    public function testLogout()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/logout',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
