<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
class UserController extends Controller{

    /*
     Retorna la lista de usuarios ,incluso si realizan una consulta 
    @return list */
    public function userList(request $request){
        $flag = false;
        $data = null;
        $paginacion =  !is_null($request->get('paginacion'))?$request->get('paginacion'):10;
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
        return view('usuarios.usuarios',['flag'=>$flag ,'data'=>$data]);
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
}