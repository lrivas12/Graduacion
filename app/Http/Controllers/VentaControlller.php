<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detallefactura;
use App\Models\producto;
use App\Models\cliente;
use Illuminate\Support\Facades\Validator;

class VentaControlller extends Controller
{
    public function index()
    {
        $clientes = cliente::all();
        $ventas = factura::all();
        return view ('layouts.factura', compact ('ventas', 'clientes'));
    }

    public function store(Request $request)
    {

        $products = json_decode($request ->detalleventa);
        $validator = Validator::make($request->all(),[
            'facturaventa' => 'required|date',
            'descuentoventa' => 'numeric|min:0',
            'clientes_id' => 'required|exists:clientes_id',
            'users_id' => 'required|exists:users_id',
        ]);
        if($validator->fails())
        {
            return redirect()->route('factura.index')->withErrors($validator)->withInput()->with('errorC', 'Error al crear venta, revise e intente nuevamente.');
        }
        $ventas = new factura();
        $ventas->fechaventa=$request->fechaventa;
        $ventas->descuentoventa=$request->descuentoventa;
        $ventas->clientes_id=$request->clientes_id;
        $ventas->users_id=$request->users_id;

        $ventas->save();
        foreach($products->datos as $key =>$value)
        {
            $detalleventas = new detallefactura();
            $detalleventas->productos_id=$value->id;
            $detalleventas->cantidadventa=$value->cantidadventa; 
            $detalleventas->subtotalventa=$value->subtotalventa;
            $detalleventas->facturas_id=$ventas->id;
            $detalleventas->save();
            
            $prod = producto::findOrFail($value->id);
            $prod->cantidadproducto += $value->cantidadcompra;
            $prod->precioproducto = $value->precioproducto;
            $prod->save();
        }
    
        return redirect()->route('factura.index')->with('successC', 'Venta creado con éxito');
    
    }
    
    public function apiShowProductos(producto $producto)
    {
    
        return $producto; 
    }
}
