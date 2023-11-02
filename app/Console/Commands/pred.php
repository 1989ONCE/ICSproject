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
                        ->limit(32)->get(['T01_6_ph', 'T01_6_ss', 'T01_12_ph', 'T01_14_ph', 'T01_12_drug1_current', 'T01_12_drug2_current'])
                        ->map(function ($value) {
                            return [
                                $value->T01_6_ph*100,
                                $value->T01_6_ss,
                                $value->T01_12_ph*100,
                                $value->T01_14_ph*100,
                                $value->T01_12_drug1_current,
                                $value->T01_12_drug2_current,
                            ];
                        });
            $datas2 = Datas::orderBy('data_id', 'desc')
                        ->limit(900)->get(['T01_6_ph', 'T01_6_ss', 'T01_12_ph', 'T01_14_ph', 'T01_12_drug1_current', 'T01_12_drug2_current'])
                        ->map(function ($value) {
                            return [
                                $value->T01_6_ph*100,
                                $value->T01_6_ss,
                                $value->T01_12_ph*100,
                                $value->T01_14_ph*100,
                                $value->T01_12_drug1_current,
                                $value->T01_12_drug2_current,
                            ];
                        });
            # data order: (1)t01-6-ph (2)t01-6-ss (3)t01-12-ph (4)t01-14-ph (5)t01-12-drug1 (6)t01-12-drug2
            $this->var_pred($datas);
            $this->lstm_pred($datas2);
            $this->arima_pred($datas);
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
            $this->info("[VAR]predicted value of pH for next minute: ".$output);
            $var_pred = new Prediction();
            $var_pred->added_on = date('Y-m-d H:i:s');
            $var_pred->fk_model_id = $var->model_id;
            $output = (double)$output;
            $var_pred->pred_ph = round($output, 2);
            $var_pred->save();
            $this->info('The command was successful!');
            }
        else{
            $this->info("No model set or Not enough realtime data to generate prediction result!");
        }
    }

    // generate lstm prediction
    public function lstm_pred($datas): void
    {
        $lstm = Ai_model::where('model_name', 'lstm')->first();
        $input = escapeshellcmd("python3 ./app/Console/python/rnn_model.py $datas $lstm->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[LSTM]predicted value of pH for next minute: ".$output);
            $lstm_pred = new Prediction();
            $lstm_pred->added_on = date('Y-m-d H:i:s');
            $lstm_pred->fk_model_id = $lstm->model_id;
            $output = (double)$output;
            $lstm_pred->pred_ph = round($output, 2);
            $lstm_pred->save();
            $this->info('The command was successful!');
        }
        else{
            $this->info("No model set or Not enough realtime data to generate prediction result!");
        }
    }

    // generate armia prediction
    public function arima_pred($datas): void
    {
        $arima = Ai_model::where('model_name', 'arima')->first();
        $input = escapeshellcmd("python3 ./app/Console/python/stat_model2.py $datas $arima->model_loc");
        $output = shell_exec($input);
        if($output !== null){
            $this->info("[ARIMA]predicted value of pH for next minute: ".$output);
            $arima_pred = new Prediction();
            $arima_pred->added_on = date('Y-m-d H:i:s');
            $arima_pred->fk_model_id = $arima->model_id;
            $output = (double)$output;
            $arima_pred->pred_ph = round($output, 2);
            $arima_pred->save();
            $this->info('The command was successful!');
        }
        else{
            $this->info("No model set or Not enough realtime data to generate prediction result!");
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
	    $pred->added_on = date('Y-m-d H:i:s');
            $pred->fk_model_id = $id;
            $pred->pred_ph = (double)$output1;
            $pred->save();
            $this->info('The command was successful!');
        }
        else if ($output2 !== null){
            $this->info("predicted value of SS for next minute: ".$output2);
	    $pred = new Prediction();
	    $pred->added_on = date('Y-m-d H:i:s');
            $pred->fk_model_id = $id;
            $pred->pred_ph = (double)$output2;
            $pred->save();
            $this->info('The command was successful!');
        }
        else {
            $this->info("Your model inputs type is not supported, please change to another model!");
        }
    }
}
