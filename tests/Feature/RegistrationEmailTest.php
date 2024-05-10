<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str; // Import the Str class
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\Data;
use App\Mail\NewRegisteration;

class RegistrationEmailTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistrationEmailSentToAdmin()
    {
        // Seed the database
        // You can use factories or directly insert data depending on your setup
        $this->seed();

        // Disable real email sending for the test
        Mail::fake();

        // Simulate user registration
        $userData = [
            'name' => 'Roaa Talat',
            'user_name' => 'roaa12',
            'email' => 'roaatalat@gmail.com',
            'password' => 'Roaa1234@',
            'birthdate' => '2004-02-14',
            'phone' => '01121295650',
            'address' => '123 Street, City',
        ];
        $user = Data::create($userData);

        // Admin's email address
        $adminEmail = 'roaatalat211@gmail.com'; 

        // Trigger email sending
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new NewRegisteration($user));

        // Assert that the email was sent to the admin
        Mail::assertSent(NewRegisteration::class, function ($mail) use ($adminEmail) {
            return $mail->hasTo($adminEmail);
        });

        // Assert email content
        Mail::assertSent(NewRegisteration::class, function ($mail) use ($user) {
            $mailContent = $mail->build()->render();
            return Str::contains($mailContent, $user->user_name) ;
        });
    }
}
