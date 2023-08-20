<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Datas;
use App\Models\Prediction;
use App\Models\Ai_model;

class pred extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pred';

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
            $datas = Datas::orderBy('data_id', 'desc')
                        ->limit(31)->get(['T01_15_ph', 'T01_15_temp', 'T01_15_ec', 'T01_12_ph', 'T01_15_cod'])
                        ->map(function ($value) {
                            return [
                                $value->T01_15_ph,
                                $value->T01_15_temp,
                                $value->T01_15_ec,
                                $value->T01_12_ph,
                                $value->T01_15_cod,
                            ];
                        });

            # data order: (1)ph (2)temp (3)ec (4)ss (5)cod
            $this->var_pred($datas);
            // $this->lstm_pred($datas);
            // $this->arima_pred($datas);
            // $this->bpann_pred($datas);
            // $this->gru_pred($datas);            
            // $this->excel_pred($datas);



        } catch (\Exception $e) {
             $this->info('Predict Command Error: ' . $e->getMessage() . "\n");
        }
    }

    // generate var prediction
    public function var_pred($datas): void
    {
        $var = Ai_model::where('model_name', 'var')->first();
        $input = escapeshellcmd("python ./app/Console/python/stat_model.py $datas $var->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[VAR]predicted value of COD for next minute: ".$output);
            $var_pred = new Prediction();
            $var_pred->fk_model_id = 2;
            $var_pred->T01_15_pre_cod = (double)$output;
            $var_pred->save();
            $this->info('The command was successful!');
            }
        else{
            $this->info("Not enough realtime data to generate prediction result!");
        }
    }

    // generate lstm prediction
    public function lstm_pred($datas): void
    {
        $lstm = Ai_model::where('model_name', 'lstm')->first();
        $input = escapeshellcmd("python ./app/Console/python/rnn_model.py $datas $lstm->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[LSTM]predicted value of COD for next minute: ".$output);
            $lstm_pred = new Prediction();
            $lstm_pred->fk_model_id = 3;
            $lstm_pred->T01_15_pre_cod = (double)$output;
            $lstm_pred->save();
            $this->info('The command was successful!');
        }
        else{
            $this->info("Not enough realtime data to generate prediction result!");
        }
    }
}