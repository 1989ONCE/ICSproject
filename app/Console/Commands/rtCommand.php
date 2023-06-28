<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ModbusMaster;
use App\Models\Testdatas;

class rtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rtdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
            $values = array_values($data);

            $row = $timestamp . ',' . implode(',', $values) . "\n";
            $testdata = new Testdatas;
            $testdata->added_on = $timestamp;
            $testdata->data1 = $values[0];
            $testdata->data2 = $values[1];
            $testdata->data3 = $values[2];
            $testdata->data4 = $values[3];
            $testdata->data5 = $values[4];
            $testdata->data6 = $values[5];
            $testdata->data7 = $values[6];
            $testdata->data8 = $values[7];
            $testdata->data9 = $values[8];
            $testdata->data10 = $values[9];
            
            $testdata->save();
            
            // $timestamp . ' ' . implode(' ', $values) . "\n";
        } catch (\Exception $e) {
            echo 'Modbus Error: ' . $e->getMessage() . "\n";
        }
    }

}
