<?php


namespace App\Models;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * CustomEmailNotification constructor.
     */
    public function __construct($data)
    {
        $this->email_data = $data;
    }

    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), 'awesomedude')->subject("Welcome to my FirstLaravel")->view('mail.signup-email', ['email_data' => $this->email_data]);
    }
}
