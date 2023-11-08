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

    public function store(Request $request)
    {

        $validator = Validator::make ($request->all(),[
            'nombreempresa' => 'required|string|max:255',
            'rucempresa' => 'required|string|max:255',
            'contactoempresa' => 'required|string|max:255',
            'direccionempresa' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2002048',
        ]);

        if($validator->fails())
        {
            return redirect()->route('empresa.index') ->withErrors($validator)->withInput()->with('errorC','Error al crear la entidad, revise e intente nuevamente.');
        }

        $empresas = empresa::create([
            'nombreempresa'=>$request->input('nombreempresa'),
            'rucempresa'=>$request->input('rucempresa'),
            'direccionempresa'=>$request->input('direccionempresa'),
            'contactoempresa'=>$request->input('contactoempresa'),

        ]);

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

       return redirect()->route('empresa.index', $empresas)->with('successC', 'Entidad Creado Correctamente!');
    }

    public function update(Request $request, $id)
    {
        $empresas = empresa::findOrFail($id);
        $validator = Validator::make ($request->all(),[
            'nombreempresa' => 'required|string|max:255',
            'rucempresa' => 'required|string|max:255',
            'contactoempresa' => 'required|string|max:255',
            'direccionempresa' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2002048',
        ]);

        if($validator->fails())
        {
            return redirect()->route('empresa.index', $empresas->id) ->withErrors($validator)->withInput()->with('errorC','Error al actualizar la entidad, revise e intente nuevamente.');
        }
        
        $empresas->update([

            'nombreempresa'=>$request->input('nombreempresa'),
            'rucempresa'=>$request->input('rucempresa'),
            'direccionempresa'=>$request->input('direccionempresa'),
            'contactoempresa'=>$request->input('contactoempresa'),

        ]);
            
        if($request->hasFile('logo')){
            $uploadedFile=$request->file('logo');
            $photoName=Str::slug($empresas->nombreempresa) . '.' . $uploadedFile->getClientOriginalExtension();
            $photoPath=$uploadedFile->storeAs('public/empresa', $photoName);
            $empresas->logo=$photoName;
        }

        $empresas->save();
        
        return redirect()->route('empresa.index')->with('success','Entidad actualizado con exito');  
    }
}
