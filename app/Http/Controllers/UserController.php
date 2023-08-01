<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
    /*
     Retorna la lista de usuarios ,incluso si realizan una consulta 
    @return list */
    public function userList(request $request){
        return view('usuarios.usuarios');
    }
}