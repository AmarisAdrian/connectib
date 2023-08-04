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
use Illuminate\Support\Facades\Validator;
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
    @return void */
    public function addUser(request $request){
        try{
           $data = $request->only('cedula','nombre','email','celular','codigo_ciudad','fecha_nacimiento','password','password_confirmation');
            $result = self::sendAddUser($data);
            if ($result['success']) {
                session()->put("success","Usuario registrado exitosamente");
            } else {
                session()->put("error","Usuario no pudo ser registrado. ".$result['errors']);
            }
        }catch(\Exception $ex){
            session::put("error",$ex->getMessage());
        }
        return redirect()->route('usuario.userList');
    }
      /*
    Consulta los datos de usuario desde la lista de usuario al modal actualizar usuario 
    @return void */
    public function getUser($id){
        $user = User::where("id",$id)->first();
        $pais = Country::get();
        return view('usuarios.modal_actualizar_usuario',["user"=>$user,"pais"=>$pais]);
    }
      /*
    Elimina el usuario
    @return json */
    public function deleteUser($id){
        try{
            User::where("id",$id)->delete();
            $response = json_encode(array("msg"=>"Usuario eliminado exitosamente","status"=>201));
         }catch(\Exception $ex){
            $response = json_encode(array("msg"=>$ex->getMessage(),"status"=>200));
         }
         echo $response;
    }

   /* Actualiza un usuario
    @return void */
    public function updateUser(request $request){
        try{
           $data = $request->only('id','nombre','celular','codigo_ciudad','fecha_nacimiento','password','password_confirmation');
            $result = self::sendaUpdateUser($data);
            if ($result['success']) {
                session()->put("success","Usuario actualizado exitosamente");
            } else {
                session()->put("error","Usuario no pudo ser actualizado. ".$result['errors']);
            }
        }catch(\Exception $ex){
            session::put("error",$ex->getMessage());
        }
        return redirect()->route('usuario.userList');
    }
     /* realiza las validaciones y luego registra los datos
    @return void */
    private static function sendAddUser($data){
        $validator = Validator::make($data,modelUser::$validacion);
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }
        $mayor_edad = self::validarMayorEdad($data['fecha_nacimiento']);
        if($mayor_edad){                    
            $data['password'] = bcrypt($data['password']);
            $user = new User($data);
            $user->save();
            return [
                'success'=>true,
                'user'=> $user
            ];
        }else{
            return [
                'success'=>false,
                'errors'=> 'Para registrar el usuario debe ser mayor de edad'
            ];
        }
    }
      /* realiza las validaciones y luego actualiza el suuario
    @return void */
    private static function sendaUpdateUser($data){
        $validator = Validator::make($data,modelUser::$validacionActualizar);
        $mayor_edad = self::validarMayorEdad($data['fecha_nacimiento']);
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }
        if($mayor_edad){                    
            $data['password'] = bcrypt($data['password']);
            $user = User::find($data['id']);   
            if (!$user) {
                return [
                    'success' => false,
                    'errors' => 'El usuario no existe',
                ];
            }
            $user->fill($data);
            $user->save();
                return [
                    'success'=>true,
                    'user'=> $user
                ];
        }else{
            return [
                'success'=>false,
                'errors'=> 'Para registrar el usuario debe ser mayor de edad'
            ];
        }
    }
     /* validar mayor de edad
    @return void */
    private static function validarMayorEdad($fecha_nacimiento){
        $fecha_nacimiento = Carbon::createFromFormat('Y-m-d',$fecha_nacimiento);
        $edad = $fecha_nacimiento->diffInYears(carbon::now());
        return $edad>=18?true:false;
    }

}
