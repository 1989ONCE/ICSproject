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
    protected $signature = 'cron:pred';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Predict water quality per hour';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('The command started!');
        try {
            $model = Ai_model::all();
            $datas = Datas::orderBy('data_id', 'desc')
                        ->limit(31)->get(['T01_6_ph_pre', 'T01_6_ph_aft', 'T01_6_ss', 'T01_12_ph_pre', 'T01_12_ph_aft', 'T01_14_ph'])
                        ->map(function ($value) {
                            return [
                                $value->T01_6_ph_pre,
                                $value->T01_6_ph_aft,
                                $value->T01_6_ss,
                                $value->T01_12_ph_pre,
                                $value->T01_12_ph_aft,
                                $value->T01_14_ph,
                            ];
                        });

            # data order: (1)ph (2)ss
            $this->var_pred($datas);
            $this->lstm_pred($datas);
            for($i=0; $i<=count($model); $i++){
                if($model[$i]->model_name != 'var' || $model[$i]->model_name != 'lstm' || $model[$i]->model_name != 'arima'){
                    $this->other_pred($datas, $model[$i]->model_loc, $model[$i]->model_id);
                }
            }
            // $this->arima_pred($datas);

        } catch (\Exception $e) {
             $this->info('Predict Command Error: ' . $e->getMessage() . "\n");
        }
    }

    // generate var prediction
    public function var_pred($datas): void
    {
        $var = Ai_model::where('model_name', 'var')->first();
        $input = escapeshellcmd("python3 ./app/Console/python/stat_model.py $datas $var->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[VAR]predicted value of SS for next minute: ".$output);
            $var_pred = new Prediction();
            $var_pred->fk_model_id = $var->model_id;
            $var_pred->pred_ss = (double)$output;
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
        $input = escapeshellcmd("python3 ./app/Console/python/rnn_model.py $datas $lstm->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[LSTM]predicted value of SS for next minute: ".$output);
            $lstm_pred = new Prediction();
            $lstm_pred->fk_model_id = $lstm->model_id;
            $lstm_pred->pred_ss = (double)$output;
            $lstm_pred->save();
            $this->info('The command was successful!');
        }
        else{
            $this->info("Not enough realtime data to generate prediction result!");
        }
    }

    // generate other prediction
    public function other_pred($datas, $loc, $id): void
    {
        $input1 = escapeshellcmd("python3 ./app/Console/python/stat_model.py $datas $loc");
        $output1 = shell_exec($input1);
        $input2 = escapeshellcmd("python3 ./app/Console/python/rnn_model.py $datas $loc");
        $output2 = shell_exec($input2);
        if($output1 !== null){
            $this->info("predicted value of SS for next minute: ".$output1);
            $pred = new Prediction();
            $pred->fk_model_id = $id;
            $pred->pred_ss = (double)$output1;
            $pred->save();
            $this->info('The command was successful!');
        }
        else if ($output2 !== null){
            $this->info("predicted value of SS for next minute: ".$output2);
            $pred = new Prediction();
            $pred->fk_model_id = $id;
            $pred->pred_ss = (double)$output2;
            $pred->save();
            $this->info('The command was successful!');
        }
        else {
            $this->info("Your model inputs type is not supported, please change to another model!");
        }
    }
}