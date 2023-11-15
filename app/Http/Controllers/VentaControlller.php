<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detallefactura;
use App\Models\producto;
use App\Models\cliente;
use App\Models\detallepago;
use App\Models\pago;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VentaControlller extends Controller
{
    public function index()
    {
        $clientes = cliente::all();
        $productos = producto::all();
        $ventas = factura::orderBy('id', 'desc')->get();;

        return view ('layouts.factura', compact ('ventas','productos', 'clientes'));
    }

    public function create()
    {
        $productos = producto::where('estadoproducto','1')->get();
        $clientes = cliente::all();
        $pagos = pago::all();
        return view ('layouts.factura', compact ('productos', 'pagos', 'clientes'));
    }

    public function show($id)
    {
        $ventas = factura::findOrFail($id);
        $productos = producto::all();
        $clientes = cliente::all();
        return view ('layouts.facturav', compact ('ventas','productos', 'clientes'));
    }
    public function store(Request $request)
    {
        $users = Auth::user();
        $products = json_decode($request ->detalleVenta);
        $validator = Validator::make($request->all(),[
            'fechafactura' => 'required|date',
            'tipoventa' => 'required|string',
            'clientes_id' => 'required|exists:clientes,id',
        ]);
        if($validator->fails())
        {
            return redirect()->route('factura.create')->withErrors($validator)->withInput()->with('errorC', 'Error al crear venta, revise e intente nuevamente.');
        }
        $ventas = new factura();
        $ventas->fechafactura=$request->fechafactura;
        $ventas->descuentoventa=$request->descuento;
        $ventas->tipoventa= $request->tipoventa;
        $ventas->clientes_id=$request->clientes_id;
        $totaldescuento = $products->total - $ventas->descuentoventa;
        $ventas->totalventa = $totaldescuento;
        $ventas->users_id = 1;
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
            $prod->cantidadproducto -= $value->cantidadventa;
            $prod->precioproducto = $value->precioproducto;
            $prod->save(); 

            
        }

        if($request->tipoventa=== 'credito'){
            $pagos = new pago();
            $pagos->facturas_id = $ventas->id;
            $pagos->cantidadpago = $ventas->totalventa;
            $pagos->fechapago = $ventas->fechafactura;
            $pagos->estadopago = 1;
            $pagos->save();
            
            $detallepago = new detallepago();
            $detallepago->fechadetallepago = $ventas->fechafactura;
            $detallepago->cantidaddetallepago = $request->adelanto;
            $detallepago->saldodetallepago = $request->saldo;
            $detallepago->pagos_id = $pagos->id;
            $detallepago->save();
        }
    
        return redirect()->route('factura.create')->with('successC', 'Venta creado con éxito');
    
    }
    
    public function apiShowProductos(producto $producto)
    {
    
        return $producto; 
    }

    public function pdf()
    {
        $venta = factura::findOrFail();

        $productos = producto::all();
        $clientes = cliente::all();
        // Obtén los detalles de la compra
        $detalles = detallefactura::where('facturas_id', $venta->id)->get();

       return view('layouts.facturav', compact('venta', 'detalles', 'productos', 'clientes', 'rutas'));
         

    }

}
