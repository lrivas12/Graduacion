<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modopago extends Model
{
    use HasFactory;

    protected $fillable =[
        'nombremodopago', 'detallemodopago',
    ];
}
