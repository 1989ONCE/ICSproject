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
               'T01_15_ph' => $data->T01_15_ph,
               'T01_15_temp' => $data->T01_15_temp,
               'T01_15_ec' => $data->T01_15_ec,
               'T01_15_cod' => $data->T01_15_cod,
               'added_on' => $data->added_on
            ];
         });
    }

    public function headings(): array
    {
        return [
            '放流槽ph值',
            '放流槽水溫',
            '放流槽導電度',
            '放流槽COD',
            '資料添加時間'
        ];
    }
}