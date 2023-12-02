<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductoController extends Controller
{
    public function index()
    {
        $productos = producto::all();
        $categorias = categoria::all();
        return view ('layouts.productos', compact('productos', 'categorias'));
    }

    public function edit($id)
    {
        $productos = producto::findOrFail($id);
        $categorias = categoria::findOrFail($id);
        return view ('producto.index', compact('productos, categorias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreproducto' => 'required|string|max:255',
            'descripcionproducto' => 'string|max:255',
            'precioproducto' => 'required|numeric|min:0',
            'stockminimo' => 'required|integer|min:0',
            'cantidadproducto' => 'required|integer|min:0',
            'marcaproducto' => 'required|string|max:255',
            'unidadmedidaproducto' => 'required|string|max:255',
            'clasificacionproducto' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id',
            'fotoproducto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            'min' => 'El Campo :atribute  debe superar :min caracteres',
            'mimes' => 'El campo :attribute debe ser una imagen con formato: :values.',
        ];
            
        $customAttributes =
        [
            'nombreproducto' => 'Nombre del producto',
            'descripcionproducto' => 'Descripcion del producto',
            'precioproducto' => 'Precio del producto',
            'cantidadproducto' => 'Cantidad del producto',
            'stockminimo' => 'Stock minimo del producto',
            'marcaproducto' => 'Marca del producto',
            'unidadmedidaproducto' => 'Unidad de medida del producto',
            'clasificacionproducto' => 'Clasificacion del producto',

        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
        
        
        if ($validator->fails()) {
            return redirect()->route('producto.index')->withErrors($validator)->withInput()->with('errorC','Error al crear el producto revise e intente nuevamente');
        }

        $productos = new Producto();
        $productos->nombreproducto = $request->input('nombreproducto');
        $productos->descripcionproducto = $request->input('descripcionproducto');
        $productos->cantidadproducto = $request->input('cantidadproducto');
        $productos->stockminimo = $request->input('stockminimo');
        $productos->marcaproducto = $request->input('marcaproducto');
        $productos->unidadmedidaproducto = $request->input('unidadmedidaproducto');
        $productos->precioproducto = $request->input('precioproducto');
        $productos->clasificacionproducto = $request->input('clasificacionproducto');
        $productos->id_categoria = $request->input('id_categoria');
       
        if ($request->hasFile('fotoproducto')) {  
            $imageName = Str::slug($productos->nombreproducto) . '.' . $request->file('fotoproducto')->getClientOriginalExtension();
        
            //genera el nombre 
            $imagenPath = $request->file('fotoproducto')->storeAs('public/productos', $imageName);
            $productos->fotoproducto = $imageName;
        }
        $productos->save();

        return redirect()->route('producto.index')->with('successC', 'Producto creado con éxito');
    
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombreproducto' => 'required|string|max:255',
            'descripcionproducto' => 'string|max:255',
            'precioproducto' => 'required|numeric|min:0',
            'cantidadproducto' => 'required|integer|min:0',
            'stockminimo' => 'required|integer|min:0',
            'marcaproducto' => 'required|string|max:255',
            'unidadmedidaproducto' => 'required|string|max:255',
            'estadoproducto'=>'required|boolean',
            'clasificacionproducto' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id',
            'fotoproducto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            'mimes' => 'El Campo :atribute debe ser :mimes',
            'min' => 'El Campo :atribute  debe superar :min caracteres',
            ];

        $customAttributes =
        [
            'nombreproducto' => 'nombre del producto',
            'descripcionproducto' => 'descripcion del producto',
            'precioproducto' => 'Precio del producto',
            'cantidadproducto' => 'Cantidad del producto',
            'stockminimo' => 'Stock minimo del producto',
            'marcaproducto' => 'Marca del producto',
            'unidadmedidaproducto' => 'Unidad de medida del producto',
            'estadoproducto'=>'Estado del producto',
            'clasificacionproducto' => 'Clasificacion del producto',

        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
       
    
        if ($validator->fails()) {
            
            return redirect()->route('producto.index', $id)->withErrors($validator)->withInput()->with('error','Error al actualizar el producto revise e intente nuevamente');
        
        }

        $productos = producto::find($id);
        $productos->nombreproducto = $request->input('nombreproducto');
        $productos->descripcionproducto = $request->input('descripcionproducto');
        $productos->cantidadproducto = $request->input('cantidadproducto');
        $productos->stockminimo = $request->input('stockminimo');
        $productos->marcaproducto = $request->input('marcaproducto');
        $productos->unidadmedidaproducto = $request->input('unidadmedidaproducto');
        $productos->estadoproducto = $request->input('estadoproducto');
        $productos->precioproducto = $request->input('precioproducto');
        $productos->clasificacionproducto = $request->input('clasificacionproducto');
        $productos->id_categoria = $request->input('id_categoria');


        if ($request->hasFile('fotoproducto')) {
            // Elimina la foto anterior si existe
            if (!is_null($productos->fotoproducto) && Storage::disk('public')->exists($productos->fotoproducto)) {
                Storage::disk('public')->delete($productos->fotoproducto);
            }

            // Guarda la nueva foto

            $uploadedFile = $request->file('fotoproducto');
            $imageName = Str::slug($productos->nombreproducto) . '.' . $request->file('fotoproducto')->getClientOriginalExtension();
            //genera el nombre 
            $imagenPath = $request->file('fotoproducto')->storeAs('public/productos', $imageName);
            $productos->fotoproducto = $imageName;
        }


        $productos->save();

        return redirect()->route('producto.index')->with('success', 'Producto actualizado con éxito');
    }
    
    public function DesactivarProducto($id)
    {
        $productos = producto::findOrFail($id);

        // Cambia el estado del producto (1 para activar, 0 para desactivar)
        $productos->estadoproducto = $productos->estadoproducto == 1 ? 0 : 1;
        $productos->save();

        return redirect()->back()->with('success', 'Estado de producto actualizado exitosamente');
    }
}
