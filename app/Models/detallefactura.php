<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallefactura extends Model
{
    use HasFactory;

    protected $fillable =[
        'cantidadventa', 'subtotalventa', 'productos_id', 'facturas_id',

    ];
    
    public function factura()
    {

        return $this->belongsTo(factura::class, 'facturas_id');
    }

    public function producto()
    {

        return $this->belongsTo(producto::class);
    }

}
