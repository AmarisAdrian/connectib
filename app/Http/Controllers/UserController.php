<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Country;
use App\State;
use App\City;
use App\Models\User as modelUser;
class UserController extends Controller{

    /*
     Retorna la lista de usuarios ,incluso si realizan una consulta 
    @return list */
    public function userList(request $request){
        $flag = false;
        $data = null;
        $paginacion =  !is_null($request->get('paginacion'))?$request->get('paginacion'):10;
        $pais = Country::get();
         try{
            $search = $request->get('search');
            if(!empty($search) && !is_null($search)){
                $data = User::where(function($query) use ($search){
                        $query->where('cedula','LIKE', '%' . $search . '%')
                        ->orWhere('nombre','LIKE', '%' . $search . '%')
                        ->orWhere('celular','LIKE', '%' . $search . '%')
                        ->orWhere('email','LIKE', '%' . $search . '%');
                    })->paginate( $paginacion);
                $flag = true;                
            }else{
                $data = User::paginate( $paginacion);
            }
            $data = $this->manipulateAgeUserList($data);
        }catch(\Exception $e){
            Session::put('error', 'Ha ocurrido una excepcion: '.$e->getMessage());   
        }
        return view('usuarios.usuarios',['flag'=>$flag ,'data'=>$data,'pais'=>$pais]);
    }

     /*
     Retorna la edad con base en la fecha de nacimiento y la fecha actual
      @return int */
    private static function calculateAge($fecha_nacimiento){
        $fecha_actual = Carbon::parse(Carbon::Now()->format('Y-m-d'));
        return $fecha_actual->diffForHumans($fecha_nacimiento);
    }
     /*
     Agrega el dato de edad al objeto de la  lista de usuario
      @return string */
    private function manipulateAgeUserList($data){
        foreach($data as $item){
            $item->edad = UserController::calculateAge($item->fecha_nacimiento);
        }
        return $data;
    }
     /*
     Consulta los departamentos por paises
      @return list */
    public function getState($id){
        $estados = State::where('country', $id)->get();
        return $estados;
    }
    /*
    Consulta las ciudades por departamento
    @return list */
    public function getCity($id){
        $estados = City::where('id_state', $id)->get();
        return $estados;
    }
    /*
    Registra un nuevo usuario
    @return list */
    public function addUser(request $request){
        try{
           $data = $request->only('cedula','password','email','nombre','celular','cedula','ciudad','fecha_nacimiento');
            $result = modelUser::addUser($data);
            if ($result['success']) {
                session()->put("success","Usuario registrado exitosamente");
            } else {
                session()->put("error","Usuario no pudo ser registrado".$result['errors']);
            }
        }catch(\Exception $ex){
            session::put("error",$ex->getMessage());
        }
        return redirect()->route('usuario.userList');

    }
}