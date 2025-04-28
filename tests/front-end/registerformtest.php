<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class RegisterFormTest extends TestCase
{
    public function TestRegisterForm()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/register',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
