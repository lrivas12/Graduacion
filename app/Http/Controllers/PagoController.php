<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pago;
use App\Models\detallepago;
use App\Models\factura;
use App\Models\cliente;
use Illuminate\Support\Facades\Validator;
class PagoController extends Controller
{
  public function index()
  {
    $pagos = pago::orderBy('id','desc')->get();
    $ventas = factura::all();
    $detallepagos = detallepago::all();
    $clientes = cliente::all();
    return view ('layouts.creditov', compact('pagos', 'ventas', 'detallepagos', 'clientes'));
  } 

  public function edit($id)
  {
    $pagos = pago::findOrFail($id);
    $clientes = cliente::all();
    $ventas = factura::all();
    $detallepagos = detallepago::all();
    return view('layouts.credito', compact('pagos', 'clientes', 'ventas', 'detallepagos'));
  }

  public function show($id)
  {

    $pagos = pago::findOrFail($id);
    $ventas = factura::all();
    $clientes = cliente::all();
    $detallepagos = detallepago::where('pagos_id', $id)->get();
    return view('layouts.credito', compact('pagos', 'ventas', 'clientes', 'detallepagos'));

  }

  public function update(Request $request, $id)
  {
    $pagos = pago::findOrFail($id);    
    $totalPagosCredito = detallepago::where('pagos_id', $id)->sum('cantidaddetallepago');
    $newdetallepagos = new detallepago();
    $newdetallepagos->fechadetallepago = $request->fechadetallepago;
    $newdetallepagos->cantidaddetallepago = $request->cantidaddetallepago;
    $newdetallepagos->saldodetallepago = $pagos->cantidadpago - ($totalPagosCredito + $newdetallepagos->cantidaddetallepago);
    $newdetallepagos->pagos_id = $id;
    $newdetallepagos->save();
    return redirect()->route('pago.show', $id)->with('successC', 'Abono agregado exitosamente.');
  }
}