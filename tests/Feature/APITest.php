<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ApiTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/'
        ]);
    }

    public function testActorsBornOnSpecificDate()
    {
        $response = $this->client->post('api.php', [
            'form_params' => [
                'birthdate' => '1990-05-01'
            ]
        ]);

        $body = (string) $response->getBody();

        // Check if the body contains expected output
        $this->assertStringContainsString('Actors Born on 1990-05-01', $body);
        $this->assertStringContainsString('Kerry Bishé', $body);
    }
}
