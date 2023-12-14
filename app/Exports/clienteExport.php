<?php

namespace App\Exports;

use App\Models\cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClienteExport implements FromCollection, WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return cliente::all();
    }

    public function headings(): array
    {
        // Obtén los nombres de las columnas del modelo Cliente
        $columnas = Schema::getColumnListing((new cliente())->getTable());

        // Retorna los nombres de las columnas
        return $columnas;
    }
}
