<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;
use Illuminate\Support\Facades\Validator;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = categoria::all();
        return view('layouts.categoria', compact('categorias'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make ($request->all(),[
            'nombrecategoria' => 'required|string|max:255',
            'tipocategoria' => 'required|string|max:255',

        ]);

            $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
        ];
        
        $customAttributes =
        [
            'nombrecategoria'=>'Nombre de la categoria',
            'tipocategoria'=>'Tipo de Categoria',
        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
    if($validator->fails()){


        return redirect()->route('categoria.index') ->withErrors($validator)->withInput()->with('errorC','Error al crear la Categoria, revise e intente nuevamente.');
   }
   $categorias = categoria::create([
    'nombrecategoria' => $request->input('nombrecategoria'),
    'tipocategoria' => $request->input('tipocategoria'),
   ]);

    $categorias->save();
    return redirect()->route('categoria.index', $categorias)->with('successC','Categoria creado con exito');

    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoria $categoria, $id)
    {
        $categorias = categoria::findOrFail($id);
        return view('categoria.index', compact('categorias'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorias = categoria::findOrFail($id);
        $validator = Validator::make ($request->all(),[
            'nombrecategoria' => 'required|string|max:255',
            'tipocategoria' => 'required|string|max:255',

        ]);
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            ];
        $customAttributes =
        [
            'nombrecategoria'=>'Nombre de la categoria',
            'tipocategoria'=>'Tipo de Categoria',
        ];
        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
    
        if($validator->fails())
        {
        return redirect()->route('categoria.index', $categorias->id)->withErrors($validator)->withInput()->with('error', 'Error al actualizar la categoria, revise e intente nuevamente');
        }
       
        $categorias->update([
    
            'nombrecategoria' => $request->input('nombrecategoria'),
            'tipocategoria' => $request->input('tipocategoria'),
           
        ]);
        $categorias->save();
        return redirect()->route('categoria.index')->with('success','Categoria actualizado con exito');  
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $categorias = categoria::findOrFail($id);
        $categorias->delete();
            return redirect()->route('categoria.index')->with('successE', 'Categoría eliminada correctamente');
    }
}