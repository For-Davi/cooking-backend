<?php

namespace App\Jobs;

use App\Mail\InviteUserMail;
use App\Models\User;
use App\Models\Enterprise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInviteUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    public User $admin;
    public Enterprise $enterprise;
    public string $token;

    public function __construct(User $user, User $admin, Enterprise $enterprise, string $token)
    {
        $this->user = $user;
        $this->admin = $admin;
        $this->enterprise = $enterprise;
        $this->token = $token;
    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(
            new InviteUserMail($this->user, $this->admin, $this->enterprise, $this->token)
        );
    }
}

