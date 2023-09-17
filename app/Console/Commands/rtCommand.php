<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Datas;
use App\Models\Power;


class rtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:rtdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to Modbus, and receive realtime data per second.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
                $timestamp = date('Y-m-d H:i:s');

                $input = escapeshellcmd("python3 ./app/Console/python/data.py");
                $drug_input = escapeshellcmd("python3 ./app/Console/python/data_ID1.py");

                $output = shell_exec($input);
                $output2 = shell_exec($drug_input);
                if($output){
                    $output = str_replace( array('[', ']', '\n'), '', $output);
                    $output = preg_replace( "/\n/", "", $output);
                    $values = explode(", ", $output);

                    $output2 = str_replace( array('[', ']', '\n'), '', $output2);
                    $output2 = preg_replace( "/\n/", "", $output2);
                    $values2 = explode(", ", $output2);

                    $data = new Datas;
    
                    $data->added_on = $timestamp;
                    
                    //ph & ss
                    $data->T01_6_ph_pre = number_format($values[1], 1, '.', ','); //port 103
                    $data->T01_6_ph_aft = number_format($values[2]/100, 1, '.', ','); // port 101
                    $data->T01_6_ss = number_format($values[3], 1, '.', ','); // port 102
                    $data->T01_12_ph_pre = number_format($values[4]/100, 1, '.', ','); // port 104
                    $data->T01_12_ph_aft = number_format($values[5]/1000, 1, '.', ','); // port 107 
                    $data->T01_14_ph = number_format($values[6]/100, 1, '.', ','); // port 105
    
                    // drug record
                    // $data->T01_12_drug_current = number_format($values2[1], 1, '.', ',');
                    // $data->T01_12_drug_daily = number_format($values[1], 1, '.', ',');
		    
		            $data->T01_12_drug1_current = $values2[1];
	                $data->T01_12_drug2_current = number_format($values2[2], 2, '.', ',');
                    $data->T01_12_drug1_daily = null;
                    $data->T01_12_drug2_daily = null;
                    $data->save();
    
                    // if power return
                    $first_p = Power::orderBy('onofftime', 'desc')->first();
                    if($first_p->status == 0) {
                        $power = new Power;
                        $power->status = true;
                        $power->onofftime = date('Y-m-d H:i:s');
                        $power->save();
                    }
                }
                else{
                    throw new Exception("設備斷訊");
                }
        } catch (\Exception $e) {
            // if power has ben cut off
            $first_p = Power::orderBy('onofftime', 'desc')->first();
            if(is_null($first_p) == 1 || $first_p->status == 1 ) {
                $power = new Power;
                $power->status = false;
                $power->onofftime = date('Y-m-d H:i:s');
                $power->save();
            }
            echo 'Modbus Error: ' . $e->getMessage() . "\n";
        }
    }

}
