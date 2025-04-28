<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class LoginFormTest extends TestCase
{
    public function testLoginForm()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/login',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
