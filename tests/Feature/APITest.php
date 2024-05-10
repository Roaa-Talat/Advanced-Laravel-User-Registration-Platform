<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class APITest extends TestCase
{
    /** @test */
    public function test_mock_http()
    {
        // This api is supposed to return a list of countries in JSON format,
        // we can mock it so that it only returns Italy.
        Http::fake([
            'https://restcountries.com/v3.1/all' => Http::response(
                [
                    'name' => 'Italy',
                    'code' => 'IT'
                ],
                200
            ),
        ]);

        $response = Http::get('https://restcountries.com/v3.1/all');

        $this->assertJsonStringEqualsJsonString(
            $response->body(),
            json_encode([
                'name' => 'Italy',
                'code' => 'IT'
            ],)
        );
    }

    // /** @test */
    // public function it_returns_actors_born_on_given_date()
    // {
    //     // Mocking the external API response
    //     Http::fake([
    //         'imdb188.p.rapidapi.com/api/v1/getBornOn*' => Http::response(['data' => ['list' => [['nameText' => ['text' => 'Actor Name']]]]], 200),
    //     ]);

    //     //Simulate POST request with all required data
    //     $response = $this->followingRedirects()->json('POST', '/register', [
    //         'name' => 'Roaa Talat',
    //         'user_name' => 'roaa12',
    //         'email' => 'roaatalat211@gmail.com',
    //         'password' => 'Roaa1234@',
    //         'birthdate' => '2004-02-14',
    //         'phone' => '01121295650',
    //         'address' => '123 Street, City',
    //     ], [
    //         'X-RapidAPI-Host' => 'imdb188.p.rapidapi.com',
    //         'X-RapidAPI-Key' => 'fdf00fecd8mshd9dc1dd4a1930b9p1dea8bjsn54f59102e9b9',
    //     ]);

    //     // Assert the response has the correct status code
    //     $this->assertEquals(200, $response->status());


    // }
}


