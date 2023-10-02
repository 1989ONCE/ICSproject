<?php

namespace App\Exports;

use App\Models\Datas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DatasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Datas::all()->map(function($data) {
            return [
               'T01_6_ph' => $data->T01_6_ph,
               'T01_6_ss' => $data->T01_6_ss,
               'T01_12_ph' => $data->T01_12_ph,
               'T01_14_ph' => $data->T01_14_ph,
               'added_on' => $data->added_on
            ];
         });
    }

    public function headings(): array
    {
        return [
            '化混槽1ph值',
            '化混槽ss值',
            '化混槽2ph值',
            '放流槽ph值',
            '資料添加時間'
        ];
    }
}