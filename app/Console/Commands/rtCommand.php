<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ModbusMaster;
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
        $ip = '111.70.29.235';
        $port = 502;

        $startAddress = 169;
        $registerCount = 10;

        $modbus = new ModbusMaster($ip, "TCP"); 

        try {
            $timestamp = date('Y-m-d H:i:s');
            $data = $modbus->readMultipleRegisters(1, $startAddress, $registerCount);
            if($data){
                $values = array_values($data);
                $row = $timestamp . ',' . implode(',', $values) . "\n";
                $data = new Datas;
                $data->added_on = $timestamp;
                $data->T01_2_drug = $values[3];
                $data->T01_4_ph = $values[2];
                $data->T01_4_drug = $values[7];
                $data->T01_5_ph = $values[2];
                $data->T01_5_drug1 = $values[6];
                $data->T01_5_drug2 = $values[3];
                $data->T01_6_drug = $values[6];
                $data->T01_12_ph = $values[2];
                $data->T01_12_drug1 = $values[3];
                $data->T01_12_drug2 = $values[7];
                $data->T01_13_drug = $values[17];
                $data->T01_15_ph = $values[2];
                $data->T01_15_temp = $values[15];
                $data->T01_15_ec = $values[19];
                $data->T01_15_cod = $values[19];

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
            else {
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