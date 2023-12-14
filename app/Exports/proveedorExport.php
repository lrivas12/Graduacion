<?php

namespace App\Exports;

use App\Models\proveedores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\WithHeadings;

class proveedorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return proveedores::all();
    }

    public function headings(): array
    {
        // Obtén los nombres de las columnas del modelo Cliente
        $columnas = Schema::getColumnListing((new proveedores())->getTable());

        // Retorna los nombres de las columnas
        return $columnas;
    }
}
