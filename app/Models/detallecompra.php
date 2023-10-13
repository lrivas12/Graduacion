<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallecompra extends Model
{
    use HasFactory;
    protected $fillable = ['compra_id', 'productos_id', 'costocompra', 'cantidadcompra', 'subtotalcompra'];

    public function compra()
    {
        return $this->belongsTo(Compras::class);
    }

    public function producto()
    {
        return $this->belongsTo(producto::class);
    }
}
