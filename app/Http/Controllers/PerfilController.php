<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PerfilController extends Controller
{
    use MustVerifyEmail;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        return view('layouts.perfil', compact('user'));
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
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255|unique:users,usuario,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {

            session(['error_id' => $user->id]);
            return redirect()->route('perfil.show', $user->id)->withErrors($validator)->withInput()->with('error', 'Error al actualizar tus datos, revise e intente nuevamente');
        }

        $user->usuario = $request->input('usuario');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        // $user->sendEmailVerificationNotification(); // este metodo 'no existe o no esta definido en User' y crashea el sistema a la hora de actualizar datos de perfil

        // Actualizar la contraseña si se proporciona
        if ($request->has('password')) {
            $hashedPassword = bcrypt($request->input('password'));
            $user->password = $hashedPassword;
        }


        if ($request->hasFile('foto')) {
            if (Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $uploadedFile = $request->file('foto');
            $photoName = $request->input('usuario') . '.' . $uploadedFile->getClientOriginalExtension();
            $photoPath = $uploadedFile->storeAs('public/usuarios', $photoName);
            $user->foto = $photoPath;
        }
        $user->save();

        return redirect()->route('perfil.show', $user->id)->with('success', '¡Tus datos se actualizaron correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
