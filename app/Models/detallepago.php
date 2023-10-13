<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallepago extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidadmodopago',
    ];
}
