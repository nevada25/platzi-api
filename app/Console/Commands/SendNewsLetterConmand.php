<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NewsletterNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendNewsLetterConmand extends Command
{

    protected $signature = 'send:newsletter
                            {emails?*} : Correos Electronicos a los cuales enviar directamente
                            {--s|schedule : Si debe ser ejecutado directamente o no}';

    protected $description = 'Envia un correo electronico a todos los usuarios que hayan verificado su cuenta';


    public function handle()
    {
        $userEmails = $this->argument('emails');
        $schedule = $this->option('schedule');

        $builder = User::query();

        if ($userEmails) {
            $builder->whereIn('email', $userEmails);
        }

        $builder->whereNotNull('email_verified_at');
        $count = $builder->count();

        if ($count) {
            $this->info("Se enviaran {$count} correos");

            if ($this->confirm('¿Estas de acuerdo?') || $schedule) {
                $this->output->progressStart($count);
                $builder->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
                $this->output->progressFinish();
                $this->info('Correos enviados');
                return;
            }
        }

        $this->info('No se enviaron correos');
  /*      $emails = $this->argument('emails');
        $builder = User::query();
        if ($emails) {
            $builder->whereIn('email', $emails);
        }
        $count = $builder->count();

        if ($count) {
            $this->output->progressStart($count);
            $builder
                ->whereDate('created_at','=',Carbon::now()->subDays(7)->format('Y-m-d'))
                ->whereNull('email_verified_at')
                ->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
            $this->info("Se enviaron {$count} correos");
            $this->output->progressFinish();
        } else {
            $this->info('No se envio ningun correo');
        }*/

    }
}
/*
 *   if ($count) {
            $this->output->progressStart($count);
            $builder
                ->whereNotNull('email_verified_at')
                ->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
            $this->info("Se enviaron {$count} correos");
            $this->output->progressFinish();
        } else {
            $this->info('No se envio ningun correo');
        }*/
