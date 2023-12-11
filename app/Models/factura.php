<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    use HasFactory;

    protected $fillable =[

        'fechafactura', 'descuentoventa', 'tipoventa', 'totalventa', 'clientes_id', 'users_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'clientes_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function detallefactura()
    {
        return $this->hasMany(detallefactura::class, 'facturas_id');
    }
    }
