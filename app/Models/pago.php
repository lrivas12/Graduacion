<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    use HasFactory;

    protected $fillable = [

        'fechapago', 'cantidadpago', 'estadopago', 'detallepagos_id',
    ];

    public function detallepago()
    {
        return $this->belongsTo(detallepago::class); 
    }

}
