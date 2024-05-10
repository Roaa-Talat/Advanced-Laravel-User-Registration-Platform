<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\data;
use Tests\TestCase;

class UsernameUniquenessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unique_username_test()
    {
        // Create a user with a specific username
        $existingUser = data::factory()->create([
            'user_name' => 'existing_username',
        ]);

        // Attempt to register with the same username
        $formData = [
            'name' => 'Roaa Talat',
            'user_name' => 'existing_username',// Same username as the existing user
            'email' => 'roaatalat211@gmail.com',
            'password' => 'Roaa1234@',
            'birthdate' => '2004-02-14',
            'phone' => '01121295650',
            'address' => '123 Street, City',
        ];

        // Submit the registration form
        $response = $this->post(route('user.register'), $formData);

        // Assert that the user is redirected back to the registration form
        $response->assertRedirect();

        // Assert that there are validation errors related to the username field
        $response->assertSessionHasErrors('user_name');

        // Assert that the error message indicates the non-uniqueness of the username
        $this->assertEquals(
            'The username is already taken.',
            session('errors')->first('user_name')
        );
    }

    

}
