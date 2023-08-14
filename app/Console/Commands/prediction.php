<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Datas;


class prediction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prediction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Predict Data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('The command started!');
        try {
            $data = Datas::orderBy('data_id', 'desc')->first();
            $datas = Datas::orderBy('data_id', 'desc')->limit(31)->get()->toArray();
            // dump($data);
            $input = escapeshellcmd("python ./app/Console/python/model.py $data");
            $output = shell_exec($input);
            if($output){
                // $values = array_values($data);
                $this->info($output);
            }
            $this->info('The command was successful!');
        } catch (\Exception $e) {
             $this->info('Predict Command Error: ' . $e->getMessage() . "\n");
        }
    }

}