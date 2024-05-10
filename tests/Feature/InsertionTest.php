<?php

namespace Tests\Feature;

use App\Models\data;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//inserts a new user into the database and displays a success message. it doesn't include validation checks for the form fields.
class InsertionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function form_inserts_new_student_and_displays_success_message()
    {
        // Valid form data
        $formData = [
            'name' => 'Roaa Talat',
            'user_name' => 'roaa12',
            'email' => 'roaatalat211@gmail.com',
            'password' => 'Roaa1234@',
            'birthdate' => '2004-02-14',
            'phone' => '01121295650',
            'address' => '123 Street, City',
        ];

        // Submit the form
        $response = $this->post(route('user.register'), $formData);

        // Assert that the user is redirected to the home route
        $response->assertRedirect(route('home'));

        // Assert that the user was inserted into the database
        $this->assertDatabaseHas('data', [
            'name' => 'Roaa Talat',
            'user_name' => 'roaa12',
            'email' => 'roaatalat211@gmail.com',
            'birthdate' => '2004-02-14',
            'phone' => '01121295650',
            'address' => '123 Street, City',
        ]);

        // Assert that the password is hashed in the database
        $this->assertTrue(Hash::check($formData['password'], Data::where('email', $formData['email'])->first()->password));
        
        // Assert that the response contains the success message
        $response->assertSessionHas('success', 'User registered successfully!');

    }
}