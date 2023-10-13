<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use Illuminate\Support\Facades\Validator;

class clienteController extends Controller
{
     public function index()
     {
        $cliente = cliente::all();
        return view ('layouts.cliente', compact('cliente')); 
     }

     public function store(Request $request)
     {
        $validator = Validator::make ($request->all(),[
            'nombrecliente' => 'required|string|max:255',
            'apellidocliente' => 'required|string|max:255',
            'direccioncliente' => 'string|max:255',
            'telefonocliente' => 'string|max:8',
            'correocliente' => 'string|max:255',
        ]);
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            ];
            
            $customAttributes =
            [
                'nombrecliente'=>'Nombre del cliente',
                'apellidocliente'=>'Apellido del cliente',
                'telefonocliente'=>'Telefono del cliente',
                'correocliente'=>'Correo del cliente',
            ];
    
            $validator->setAttributeNames($customAttributes);
            $validator->setCustomMessages($customMessages);
            if($validator->fails()){
        
        
                return redirect()->route('cliente.index') ->withErrors($validator)->withInput()->with('errorC','Error al crear la Cliente, revise e intente nuevamente.');
           }
           $clientes = cliente::create([
            'nombrecliente' => $request->input('nombrecliente'),
            'apellidocliente' => $request->input('apellidocliente'),
            'direccioncliente' => $request->input('direccioncliente'),
            'telefonocliente' => $request->input('telefonocliente'),
            'correocliente' => $request->input('correocliente'),

           ]);
        
            $clientes->save();
            return redirect()->route('cliente.index', $clientes)->with('successC','Cliente creado con exito');
        
     }

     public function edit(cliente $cliente, $id)
     {
        $cliente = cliente::findOrFail($id);

        return view('cliente.index', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $clientes = cliente::findOrFail($id);
        $validator = Validator::make ($request->all(),[
            'nombrecliente' => 'required|string|max:255',
            'apellidocliente' => 'required|string|max:255',
            'direccioncliente' => 'string|max:255',
            'telefonocliente' => 'string|max:8',
            'correocliente' => 'string|max:255',
        ]);
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            ];

            $customAttributes =
        [
            'nombrecliente'=>'Nombre del cliente',
            'apellidocliente'=>'Apellido del cliente',
            'telefonocliente'=>'Telefono del cliente',
            'correocliente'=>'Correo del cliente',
        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);
    
        if($validator->fails())
        {
        return redirect()->route('cliente.index', $clientes->id)->withErrors($validator)->withInput()->with('error', 'Error al actualizar el cliente, revise e intente nuevamente');
        }
       
        $clientes->update([
    
            'nombrecliente' => $request->input('nombreclienteE'),
            'apellidocliente' => $request->input('apellidoclienteE'),
            'direccioncliente' => $request->input('direccionclienteE'),
            'telefonocliente' => $request->input('telefonoclienteE'),
            'correocliente' => $request->input('correoclienteE'),

           
        ]);
        $clientes->save();
        return redirect()->route('cliente.index')->with('success','Cliente actualizado con exito');   
    }

    public function destroy($id)
    {
        $clientes = cliente::findOrFail($id);
        $clientes->delete();
            return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente');
    
    }
}