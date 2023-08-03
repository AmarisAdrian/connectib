<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public static $validacion = [
        'cedula' => 'required|integer',
        'nombre' => 'required|string|max:255',
        'celular' =>'integer',
        'email' => 'required|email|unique:users|max:255',
        'fecha_nacimiento' => 'required|date',
    ];
    public static function validarMayorEdad($attribute,$value,$parameters,$validator){
        $fecha_nacimiento = Carbon::createFromFormat('Y-m-d',$value);
        $edad = $fecha_nacimiento->diffInYears(carbon::now());
        return $edad>=18;
    }
    public static function addUser($data){
        $validator = Validator::make($data,self::$validacion);
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }
        $data['password'] = bcrypt($data['password']);
        $user = new self($data);
        $user->save();
        return [
            'success'=>true,
            'user'=> $user
        ];
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
    ];
}
