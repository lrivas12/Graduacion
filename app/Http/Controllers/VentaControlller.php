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
        $ventas = factura::all();
        return view ('layouts.factura', compact ('ventas','productos', 'clientes'));
    }

    public function create()
    {

        $productos = producto::where('estadoproducto','1')->get();
        $clientes = cliente::where('estadocliente', '1')->get();
        $pagos = pago::all();
        return view ('layouts.factura', compact ('ventas','productos', 'pagos', 'clientes'));
    }

    public function show($id)
    {
        $ventas = factura::findOrFail($id);
        $productos = producto::all();
        $clientes = cliente::all();
        return view ('layouts.factura', compact ('ventas','productos', 'clientes'));
    }
    public function store(Request $request)
    {
        $users = Auth::user();
        $products = json_decode($request ->detalleventa);
        $validator = Validator::make($request->all(),[
            'facturaventa' => 'required|date',
            'descuentoventa' => 'numeric|min:0',
            'tipoventa' => 'required|string',
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
        $ventas->tipoventa= $request->tipoventa;
        $ventas->clientes_id=$request->clientes_id;
        $ventas->users_id=$request->users_id;
        $totaldescuento = $products->total - $ventas->descuentoventa;
        $ventas->total = $totaldescuento;

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

            if($request->tipoventa=== 'credito'){
                $pagos = new pago();
                $pagos->facturas_id = $ventas->id;
                $pagos->cantidadpago = $ventas->totalventa;
                $pagos->save();
            }
            else
            {

                $prod = producto::findOrFail($value->id);
                $prod->cantidadproducto -= $value->cantidadventa;
                $prod->save();
            }

            if($request->tipoventa=== 'credito'){
                $detallepago = new detallepago();
                $detallepago->fechadetallepago = $ventas->fechaventa;
                $detallepago->cantidaddetallepago = $request->adelanto;
                $detallepago->saldodetallepago = $request->saldo;
                $detallepago->pagos_id = $pagos->id;
                $detallepago->save();
            }
        }
    
        return redirect()->route('factura.index')->with('successC', 'Venta creado con éxito');
    
    }
    
    public function apiShowProductos(producto $producto)
    {
    
        return $producto; 
    }

}
