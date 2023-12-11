<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    use HasFactory;

    protected $fillable = [

        'fechapago', 'cantidadpago', 'estadopago',  'facturas_id',
    ];

    public function detallepago()
    {
        return $this->hasMany(detallepago::class, 'pagos_id');
    }

    public function factura()
    {
        return $this->belongsTo(factura::class,'facturas_id'); 
    }

}
