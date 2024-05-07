<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\data;




class NewRegisteration extends Mailable
{
    use Queueable, SerializesModels;


    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(data $user)
    {
        $this->user = $user;
    }


    public function content()
    {
        return new Content('emails.NewRegisteration');
    }



    public function build(): self
    {

        $username = $this->user->user_name;
        return $this
            ->from('eng.rawantarek21@gmail.com', 'Laravel Registration Webpage') // Set sender info
            ->to('rawan25112003@gmail.com')
            ->subject('New registered user')
            ->view('emails.NewRegisteration')
            ->with(['username' => $username]); // Pass username to the view data
    }
}