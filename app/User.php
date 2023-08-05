<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $connection = 'mysql';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula',
        'nombre',
        'email',
        'celular',
        'codigo_ciudad',
        'fecha_nacimiento',
        'password'
    ];

    public static $validacion = [
        'cedula' => 'required|integer',
        'nombre' => 'required|string|max:100',
        'email' => 'required|email|unique:users|max:100',
        'celular' => 'nullable|integer',
        'fecha_nacimiento' => 'required|date',
        'codigo_ciudad' => 'required|integer',
        'password' => ['required', 'string', 'confirmed', 'min:8' ,'regex:/^(?=.*[A-Z])(?=.*\d).+$/']
    ];
    public static $validacionActualizar = [
        'id' => 'required|integer',
        'nombre' => 'required|string|max:100',
        'celular' =>'nullable|integer',
        'fecha_nacimiento' => 'required|date',
        'password' => ['required', 'string', 'confirmed', 'min:8' ,'regex:/^(?=.*[A-Z])(?=.*\d).+$/']
    ];
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

}
