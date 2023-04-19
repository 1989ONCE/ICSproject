<?php

namespace App\Exports;

use App\Models\Datas;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Datas::all();
    }
}
