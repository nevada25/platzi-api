<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailVerificationReminderCommand extends Command
{
    protected $signature = 'send:reminder';

    protected $description = 'Envia un correo electronico a los usuarios que no han verificado su cuenta despues de haberse registraod hace una semana';
    public function handle()
    {
        User::query()
             ->whereNull('email_verified_at')
            ->each(function (User $user) {
                // Equivalente a $this->notify(new VerifyEmail);
                $user->sendEmailVerificationNotification();
            });
    }
}
