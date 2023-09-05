<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class lineNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'line:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send notifications to specific users via Line App.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . 'rRwtTGnQl4YZMx6uLCyNhVmkX2906NwzshVkAXiXlce',
        ])
        ->asForm()
        ->post('https://notify-api.line.me/api/notify', [
            'message' => 'test',
        ]);
    }
}
