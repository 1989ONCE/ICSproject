<?php

namespace App\Exports;

use App\Models\Power;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PowersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Power::all()->map(function($data) {
            if($data->status == 0){
                $status = '設備斷訊';
            }
            else{
                $status = '訊號恢復';
            }
            return [
               'power_id' => $data->power_id,
               'status' => $status,
               'onofftime' => $data->onofftime,
            ];
         });
    }

    public function headings(): array
    {
        return [
            '紀錄ID',
            '設備狀態',
            '斷訊/恢復時間',
        ];
    }
}