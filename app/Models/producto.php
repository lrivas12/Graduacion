<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'fotoproducto',
        'nombreproducto',
        'descripcionproducto',
        'cantidadproducto',
        'marcaproducto',
        'unidadmedidaproducto',
        'precioproducto',
        'estadoproducto',
        'stockminimo',
        'clasificacionproducto',
        'id_categoria',
    ];
    public function categoria()
    {
        return $this->belongsTo(categoria::class, 'id_categoria');
    }
}
