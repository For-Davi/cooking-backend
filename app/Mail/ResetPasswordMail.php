<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    public $name;

    public $appUrl;

    public function __construct($token, $name, $appUrl)
    {
        $this->token = $token;
        $this->name = $name;
        $this->appUrl = $appUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-mail para redefinição de senha',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-password',
            with: [
                'token' => $this->token,
                'user' => $this->name,
                'appUrl' => $this->appUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
