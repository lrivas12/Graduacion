<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'email',
        'password',
        'privilegios',
        'estado',
        'foto',
    ];

    public function adminlte_image()
    {
        $user = Auth::user();
         // Verificar si el usuario tiene una foto de perfil cargada
         if ($user->foto) {
            // Devolver la URL de la foto de perfil del usuario autenticado
            return asset('storage/usuarios/' . $user->foto);
        } else {
            // Si el usuario no tiene una foto de perfil, puedes devolver una imagen por defecto
            return asset('storage/usuarios/user.png');
        }
    }

    public function adminlte_desc()
    {
        // Obtén el nombre de usuario del usuario autenticado
        //$user = Auth::user();

        //return $user->username;
        return $this->usuario . ' ( ' . $this->privilegios . ' ) ';

    }

    public function adminlte_profile_url()
    {
        $user = Auth::user();
        return route('perfil.show', ['perfil' => $user->id]);

    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
