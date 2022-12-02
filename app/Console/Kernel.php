<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Notification;
use App\Mail\SentNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Se reenviaran las notificaciones que caduquen dentro una semana y las que vencen el dia de mañana u hoy
            $today = Carbon::now();
            $tomorow = $today->add(1, 'day');
            $date = $today->add(7, 'day');
            $notificaciones = Notification::whereDate('fecha_de_expiracion', $date->isoFormat('Y-m-d'))
            ->orWhere(function($query) {
                $query->whereDate('fecha_de_expiracion', $today->isoFormat('Y-m-d'));
            })
            ->orWhere(function($query) {
                $query->whereDate('fecha_de_expiracion', $tomorow->isoFormat('Y-m-d'));
            })
            ->get();
            foreach ($notificaciones as $notificacion) 
            {
                Mail::to($notificacion->usuario()->email)->send(new SentNotification($notificacion));
            }
        })->weekdays()->dailyAt('08:00'); // ->weekdays()->everyTwoMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
