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
               'T01_2_drug' => $data->T01_2_drug,
               'T01_4_drug' => $data->T01_4_drug,
               'T01_5_drug1' => $data->T01_5_drug1,
               'T01_5_drug2' => $data->T01_5_drug2,
               'T01_6_drug' => $data->T01_6_drug,
               'T01_12_drug1' => $data->T01_12_drug1,
               'T01_12_drug2' => $data->T01_12_drug2,
               'T01_13_drug' => $data->T01_13_drug,
               'added_on' => $data->added_on
            ];
         });
    }

    public function headings(): array
    {
        return [
            'ph中和槽-液鹼(45%)',
            '冷卻塔-液鹼(45%)',
            '快混槽1-液鹼(45%)',
            '快混槽1-硫酸鋁(7.5%)',
            '慢混槽1-polymer(0.1%)',
            '快混槽2-液鹼(45%)',
            '快混槽2-硫酸鋁(7.5%)',
            '慢混槽2-polymer(0.1%)',
            '資料添加時間'
        ];
    }
}