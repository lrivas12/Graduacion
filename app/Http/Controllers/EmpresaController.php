<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empresa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = empresa::all();
        return view('layouts.empresa', compact('empresas'));
    }


    public function update(Request $request, $id)
    {
        $empresas = empresa::findOrFail($id);
        $validator = Validator::make ($request->all(),[
            'nombreempresa' => 'required|string|max:50',
            'rucempresa' => 'required|string|max:30',
            'contactoempresa' => 'required|string|min:8|max:20',
            'direccionempresa' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $customMessages =[
            'required' => 'El Campo :atribute es Obligatorio',
            'max' => 'El Campo :atribute no debe superar :max caracteres',
            ];
        $customAttributes =
        [
            'nombreempresa'=>'Nombre de la empresa',
            'rucempresa'=>'RUC de la empresa',
            'contactoempresa'=>'Numero de la empresa',
            'direccionempresa'=>'Direccion de la empresa',
        ];
        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);

        if($validator->fails())
        {
            return redirect()->route('empresa.index', $empresas->id) ->withErrors($validator)->withInput()->with('errorC','Error al actualizar la entidad, revise e intente nuevamente.');
        }
        $empresas = empresa::find($id);
        $empresas->nombreempresa = $request->input('nombreempresa');
        $empresas->rucempresa = $request->input('rucempresa');
        $empresas->contactoempresa = $request->input('contactoempresa');
        $empresas->direccionempresa = $request->input('direccionempresa');

        // Manejo de carga de nuevo logo
        if ($request->hasFile('logo')) {
            // Elimina el logo anterior si existe
            if (!empty($empresas->logo) && file_exists(public_path($empresas->logo))) {
                unlink(public_path($empresas->logo));
        }
            $nuevoLogoPath = 'vendor/adminlte/dist/img';
            $nuevoLogoNombre = 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move($nuevoLogoPath, $nuevoLogoNombre);
            $empresas->logo = $nuevoLogoPath . '/' . $nuevoLogoNombre;
        }

        $empresas->save();
        
        return redirect()->route('empresa.index')->with('success','Entidad actualizado con exito');  
    }

    public function ObtenerDatos()
    {
        $empresas = empresa::first();
        if($empresas)
        {
            return response()->json($empresas);
        }
        else
        {
            return response()->json(['error'=>'Empresa no encontrada'], 404);
        }
    }
}
