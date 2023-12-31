<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'fechacompra',
        'totalcompra', 
        'proveedor_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(proveedores::class, 'proveedor_id');
    }

    public function detallesCompra()
    {
        return $this->hasMany(detallecompra::class);
    }
}
