<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Enterprise;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
       public User $user,
       public User $admin,
       public Enterprise $enterprise,
       public string $token 
        )
    {}

    public function build()
    {
        return $this->subject('Convite para o  Dalle Manage')
            ->view('emails.invite-user');
    }
}
