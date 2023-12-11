<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Auth\MustVerifyEmail;
class UsuarioController extends Controller
{

    use MustVerifyEmail;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('layouts.usuario', compact('users'));
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
        $validator = Validator::make($request->all(), [
            'usuario'=> 'required|string|max:255|unique:users,usuario,',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'estado'=> 'required|string',
            'privilegios'=>'required|string|max:255',
            'foto'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'=> ['required',
            'string',
            'max:20',
            'min:8',         // Mínimo de 8 caracteres
            'regex:/\d/',    // Al menos un número
            'regex:/[A-Z]/', // Al menos una letra mayúscula
            'regex:/[\W_]/', // Al menos un carácter especial
            'confirmed',      // Debe coincidir con el campo de confirmación de contraseña,
        ],
        ]);

        $customMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no debe superar :max caracteres.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'unique' => 'El campo :attribute ya está en uso.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'confirmed' => 'La confirmación de contraseña no coincide.',
            'image' => 'El campo :attribute debe ser una imagen válida.',
            'mimes' => 'El campo :attribute debe ser una imagen con formato: :values.',
        ];

        $customAttributes =
        [
            'usuario'=>'Nombre del  usuario',
            'email'=>'Correo del usuario',
            'password'=>'Contraseña del  usuario',
            'privilegios'=>'Privilegios del usuario',
        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);


        if($validator->fails()){
            return redirect()->route('usuario.index')->withErrors($validator)->withInput()->with('errorC', 'Error al crear el Usuario, revise e intente nuevamente');
        }

        $hashedPassword = bcrypt($request->input('password'));

        $users = User::create([
        'usuario'=>$request->input('usuario'),
        'email'=>$request->input('email'),
        'password'=>$request->input('password'),
        'privilegios'=>$request->input('privilegios'),
        'estado'=>$request->input('estado'),
        'password'=>$hashedPassword,
        ]);

       // $users->sendEmailVerificationNotification();

        if($request->hasFile('foto')){
            $uploadedFile=$request->file('foto');
            $photoName=Str::slug($users->usuario) . '.' . $uploadedFile->getClientOriginalExtension();
        $photoPath=$uploadedFile->storeAs('public/usuarios', $photoName);
        $users->foto=$photoName;
        }
        
        $users->save();

       return redirect()->route('usuario.index', $users)->with('successC', '¡Usuario Creado Correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'usuario'=> 'required|string|max:255|unique:users,usuario,'. $id,
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
            'estado'=> 'required|string',
            'privilegios'=>'required|string|max:255',
            'foto'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'=> 'nullable|string|min:8|max:20',
        ]);
        $customMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no debe superar :max caracteres.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'unique' => 'El campo :attribute ya está en uso.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'confirmed' => 'La confirmación de contraseña no coincide.',
            'image' => 'El campo :attribute debe ser una imagen válida.',
            'mimes' => 'El campo :attribute debe ser una imagen con formato: :values.',
        ];

        $customAttributes =
        [
            'usuario'=>'Nombre del  usuario',
            'email'=>'Correo del usuario',
            'password'=>'Contraseña del  usuario',
            'privilegios'=>'Privilegios del usuario',
        ];

        $validator->setAttributeNames($customAttributes);
        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            session(['error_id' => $user->id]);
            return redirect()->route('usuario.index', $user->id)
                ->withErrors($validator)->withInput()
                ->with('error', 'Error al Actualizar Usuario, revise e intente nuevamente');
        }

        $user->usuario = $request->input('usuario');
        $user->email = $request->input('email');
        $user->privilegios = $request->input('privilegios');
        $user->estado = $request->input('estado');

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('foto')) {
            if (!is_null($user->foto) && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->storeAs('public/usuarios', $user->usuario . '.' . $request->file('foto')->getClientOriginalExtension());
        }

        $user->save();

        return redirect()->route('usuario.index')->with('success', '¡Usuario Actualizado Exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function DesactivarUsuario($id)
    {
        $user = User::findOrFail($id);

        // Cambia el estado del usuario (1 para activar, 0 para desactivar)
        $user->estado = $user->estado == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Usuario Actualizado Exitosamente');
    }
}