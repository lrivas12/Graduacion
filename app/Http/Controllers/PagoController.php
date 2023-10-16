<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pago;

class PagoController extends Controller
{
    public function index()
    {
    $pagos = pago::all();
    return view ('layouts.credito',compact('pago'));
    }

    public function store()
    {
        
        return redirect()->route('pago.index')->with('successC', 'Credito creado con éxito');
    }
}
