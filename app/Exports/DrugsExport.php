<?php

namespace App\Exports;

use App\Models\Datas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DrugsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Datas::all()->map(function($data) {
            return [
               'T01_12_drug1_daily' => $data->T01_12_drug1_daily,
               'T01_12_drug2_daily' => $data->T01_12_drug2_daily,
               'added_on' => $data->added_on
            ];
         });
    }

    public function headings(): array
    {
        return [
            '化混槽2-液鹼',
            '化混槽2-硫酸鋁',
            '資料添加時間'
        ];
    }
}