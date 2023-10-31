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
        $compra = compra::all();
        $productos = producto::all();
        return view('layouts.comprasm', compact('compra','productos', 'proveedores'));
    }
    public function create(){
        
        $productos = producto::where('estadoproducto', '1')->get();
        $proveedores = proveedores::where('estadoproveedor', '1')->get();

        return view('layouts.compras', compact('proveedores', 'productos'));
    }

    public function show($id)
    {
        $compra = compra::findOrFail($id);
        $proveedores = proveedores::all();
        $detallecompras = detallecompra::where('compra_id', $compra->id)->get();
        return view('layouts.comprasv', compact('compra','detallecompras','proveedores'));
    }

    public function edit($id)
    {
        $proveedores = proveedores::all();
        $compra = compra::findOrFail($id);
        $productos = producto::where('estadoproducto', '1')->get();
        $detalles = detallecompra::where('compra_id', $compra->id)->get();
        $productosjson =[];
        foreach($detalles as $item)
        {
            $pr = producto::find($item->productos_id);
            $pr["cantidadcompra"]= $item->cantidadcompra;
            $pr["costocompra"]= $item->costocompra;
            $pr["subtotalcompra"]= $item->subtotalcompra;
            $pr["original"]=true;
        
            $productosjson[] = $pr;
        }
       
        //$productosjson = json_encode($productosjson);
        
        return view('layouts.comprase', compact('compra', 'detalles', 'productos', 'productosjson', 'proveedores'));
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

         return redirect()->route('compras.index')->with('successC', 'Compra creado con éxito');
    }
    
    public function update(Request $request, $id)
    {
        $products = json_decode($request->detallecompra);
        $validator = Validator::make($request->all(),[
            'fechacompra' => 'required|date',
           
        ]);
        if($validator->fails())
        {
        return redirect()->route('compras.edit', $id)->withErrors($validator)->withInput()->with('error', 'Error al actualizar el producto, revise e intente nuevamente');
        }

        $total = 0;
        foreach ($products as $item) {
            $total += (double) ($item->costocompra * $item->cantidadcompra);
        }
        
       $compras = compra::findOrFail($id);

       $compras->proveedor_id = $request->input('proveedor_id');
       $compras->fechacompra = $request->input('fechacompra');
       $compras->totalcompra =$total;
       $compras->update();

       // Itera sobre los detalles de compra y guárdalos en la base de datos
        foreach ($products as $item) {
            //Actualizar producto
            $prod = producto::findOrFail($item->id);
            $prod->precioproducto = $item->precioproducto;
            if(property_exists($item,'nuevo') && $item->nuevo){
                $detallecompras = new detallecompra();
                $detallecompras->productos_id=$item->id;
                $detallecompras->cantidadcompra=$item->cantidadcompra;
                $detallecompras->costocompra=$item->costocompra;
                $detallecompras->subtotalcompra=$item->subtotalcompra;
                $detallecompras->compra_id=$compras->id;
                $detallecompras->save();
                //Suma la cantidad a stock productos
            $prod->cantidadproducto += $item->cantidadcompra;
            
            }
            else
            {


                $detallecompras = detallecompra::where("compra_id", $compras->id)
                ->where("productos_id", (int) $item->id)
                ->first();

                $detallecompras["costocompra"] = $item->costocompra;
                $detallecompras["subtotalcompra"] = (float)($item->costocompra * $item->cantidadcompra);

                if($item->cantidadcompra > $detallecompras["cantidadcompra"])
                {
                    $prod->cantidadproducto += ($item->cantidadcompra - $detallecompras["cantidadcompra"]);
                }
                if($item->cantidadcompra < $detallecompras["cantidadcompra"])
                {
                    $prod->cantidadproducto -= ($detallecompras["cantidadcompra"] - $item->cantidadcompra);
                    
                    if($prod->cantidadproducto <= 0)
                    {
                        $prod->cantidadproducto = 0;
                    }
                    
                }
            }

            $prod->update();
            $detallecompras["cantidadcompra"] = $item->cantidadcompra;
            $detallecompras->update();
                
        }
        return redirect()->route('compras.show', $id)->with('successC', 'Compra actualizada exitosamente.');       
    }

    public function apiShowProductos(producto $producto)
    {
    
        return $producto;
    }

}


