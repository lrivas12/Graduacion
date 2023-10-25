<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pago;
use App\Models\detallepago;
use App\Models\factura;
use Illuminate\Support\Facades\Validator;
class PagoController extends Controller
{
    public function index()
    {
    $pagos = pago::all();
    return view ('layouts.credito',compact('pagos'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

        'fechapago'=> 'required|date',
        'cantidadpago' =>  'required|integer|min:1',
        'estadopago' => 'required|',
        'detallepagos_id' => 'required|exists:detallepago,id',

        ]);

        if ($validator -> fails()) {
        
        return redirect()->route('pago.index')->with('errorC','Error al crear el credito, revise e intente nuevamente.');
        }

    }
}
