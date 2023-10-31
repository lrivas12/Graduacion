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
    $ventas = factura::all();
    $detallepagos = detallepago::all();
    return view ('layouts.credito',compact('pagos, ventas, detallepagos'));
    }

    public function edit($id)
    {
        $pagos = pago::findOrFail($id);


    }

    public function update(Request $request, $id)
    {
      $pagos = pago::findOrFail($id);
    }
}
