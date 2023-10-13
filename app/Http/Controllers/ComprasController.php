<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\compra;
use App\Models\producto;
use App\Models\detallecompra;
use App\Models\proveedores;


use Illuminate\Support\Facades\Validator;
class ComprasController extends Controller
{
    public function index()
    {
        $proveedores = proveedores::all();
        $compras = compra::all();
        return view('layouts.stock', compact('compras','proveedores'));
    }
    public function create(){
        
        $productos = producto::where('estadoproducto', '1')->get();
        $proveedores = proveedores::where('estadoproveedor', '1')->get();

        return view('layouts.compras', compact('proveedores', 'productos'));
    }

    public function show($id)
    {
        $compras = compra::findOrFail($id);
        $proveedores = proveedores::all();
        $detallecompras = detallecompra::where('compras_id', $compras->id)->get();
        return view('layouts.compras', compact('compras','detallecompras','proveedores'));
    }

    

    public function store(Request $request)
    {
        $products = json_decode($request->detalleCompra);

        $validator = Validator::make($request->all(),[
            'fechacompra' => 'required|date',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);
       
        if($validator->fails())
        {

        return redirect()->route('compras.create') ->withErrors($validator)->withInput()->with('errorC','Error al crear compra, revise e intente nuevamente.');   
        }
        $compras = new compra();
        $compras->fechacompra = $request->fechacompra;
        $compras->totalcompra = $products->total;
        $compras->proveedor_id = $request->proveedor_id;

        $compras->save();
        foreach($products->datos as $key =>$value)
        {
            $detallecompras = new detallecompra();
            $detallecompras->productos_id=$value->id;
            $detallecompras->cantidadcompra=$value->cantidadcompra;
            $detallecompras->costocompra=$value->costocompra;
            $detallecompras->subtotalcompra=$value->subtotal;
            $detallecompras->compra_id=$compras->id;
            $detallecompras->save();

            //Suma la cantidad a stock productos
            $prod = producto::findOrFail($value->id);
            $prod->cantidadproducto += $value->cantidadcompra;
            $prod->precioproducto = $value->precioproducto;
            $prod->save();

        }
        return "compra exitosa";
       // return redirect()->route('compras.create')->with('successC', 'Compra creado con éxito');
    }       

        public function apiShowProductos(producto $producto){
    
        return $producto;
    }

}

