<?php

namespace App\Exports;

use App\Models\factura;
use Maatwebsite\Excel\Concerns\FromCollection;

class facturaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return factura::all();
    }
}
