<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use ModbusMaster;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\rtCommand::class,
        Commands\pred::class,
        Commands\alarmCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            info('call');
        })->everyMinute();

        $schedule->command('cron:alarm_send')->everyMinute();
        $schedule->command('cron:pred')->hourly();
    }

    /**
     * Define the application's command short schedule.
     */

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule): void
    {
        // this artisan command will run every second
        $shortSchedule->command('cron:rtdata')->everySecond();
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
