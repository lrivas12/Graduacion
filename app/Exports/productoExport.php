<?php

namespace App\Exports;

use App\Models\producto;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class productoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return producto::with('categoria')->get();
    }

    public function headings(): array
    {
        $columnas = Schema::getColumnListing((new producto())->getTable());

        // Retorna los nombres de las columnas
        return $columnas;
    }

    public function map($productos): array
    {
        
        return [
            $productos->id,
            $productos->nombreproducto,
            $productos->fotoproducto,
            $productos->cantidadproducto,
            $productos->precioproducto,
            $productos->unidadmedidaproducto,
            $productos->marcaproducto,
            $productos->estadoproducto,
            $productos->stockminimo,
            ($productos->categoria)->nombrecategoria,
            $productos->created_at,
            $productos->updated_at,
        ];
    }
}
