<?php

namespace App\Http\Controllers;

use App\Models\proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProveedoresController extends Controller
{
   public function index()
   {
    $proveedores=proveedores::all();
    return view('proveedores.principal', compact('proveedores'));
    
   }

   public function store(Request $request)
   {
        $validator = Validator::make($request->all(),[
            'razonsocialproveedor' => 'required|string|max:40:unique:proveedores',
            'numerorucproveedor' => 'string|max:20',
            'telefonoproveedor'=> 'string|max:8',

        ]);
    
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
        ];

        $customAttributes = 
        [
            'razonsocialproveedor' => 'Razon Social del proveedor',
            'numerorucproveedor' => 'Numero RUC del proveedor',
            'telefonoproveedor'=> 'Telefono del proveedor',
        ];
        
        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
        if($validator->fails()){

            return redirect()->route('proveedores.index') ->withErrors($validator)->withInput()->with('errorC','Error al crear proveedor, revise e intente nuevamente.');
        }
        $proveedores = proveedores::create([
            'razonsocialproveedor' => $request->input('razonsocialproveedor'),
            'numerorucproveedor' => $request->input('numerorucproveedor'),
            'telefonoproveedor' => $request->input('telefonoproveedor'),
        ]);

        $proveedores->save();
        return redirect()->route('proveedores.index', $proveedores)->with('successC','Proveedor creado con exito');
    }

   public function edit($id)
   {

    $proveedores=proveedores::findOrFail($id);
    return view('proveedores.edit',compact('proveedores'));
   }


   public function update(Request $request, $id)
   {
    $proveedores = proveedores::findOrFail($id);
    
    $validator = Validator::make($request->all(),[
        'razonsocialproveedor' => 'required|string|max:40|unique:proveedores,razonsocialproveedor,' . $proveedores->id,
        'numerorucproveedor' => 'string|max:20',
        /* 'estadoproveedor' => 'required|boolean', */
        'telefonoproveedor'=> 'string|max:8',
    ]);
    $customAttributes = 
        [
            'razonsocialproveedor' => 'Razon Social del proveedor',
            'numerorucproveedor' => 'Numero RUC del proveedor',
            /* 'estadoproveedor'=> 'Estado del proveedor', */
            'telefonoproveedor'=> 'Telefono del proveedor',
        ];
    
    $customMessages =[
        'required' => 'El Campo :atribute es Obligatorio',
        'max' => 'El Campo :atribute no debe superar :max caracteres',
        ];

        
        
        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);

    if($validator->fails())
    {
        return redirect()->route('proveedores.index', $proveedores->id)->withErrors($validator)->withInput()->with('error', 'Error al actualizar proveedor, revise e intente nuevamente');
    }
   
    $proveedores->update([

        'razonsocialproveedor' => $request->input('razonsocialproveedor'),
        'numerorucproveedor' => $request->input('numerorucproveedor'),
       /*  'estadoproveedor' => $request->input('estadoproveedor'), */
        'telefonoproveedor' => $request->input('telefonoproveedor'),
       
    ]);
    
    return redirect()->route('proveedores.index')->with('success','Proveedor actualizado con exito');
   }
   public function DesactivarCategoria($id)
   {
       $proveedores = proveedores::findOrFail($id);

       // Cambia el estado de la categoria (1 para activar, 0 para desactivar)
       $proveedores->estadoproveedor = $proveedores->estadoproveedor == 1 ? 0 : 1;
       $proveedores->save();

       return redirect()->back()->with('success', 'Estado de la cateoria actualizado exitosamente');
   }
}