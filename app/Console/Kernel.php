<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use ModbusMaster;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('pred')->everyMinute();
        $schedule->call(function(){
            info('call');
        })->everyMinute();

        $schedule->command('alarm_send')->everyMinute();
    }

    /**
     * Define the application's command short schedule.
     */

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule): void
    {
        // this artisan command will run every second
        $shortSchedule->command('rtdata')->everySecond();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
