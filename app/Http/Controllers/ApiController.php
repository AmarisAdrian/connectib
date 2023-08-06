<?php 
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use stdClass;

class ApiController extends Controller{
 
    public static $url;
    public function __construct()
    {
        self::$url = new stdClass();
        self::$url->endpoint_post = 'https://jsonplaceholder.typicode.com/posts/?userId=';
        self::$url->endpoint_user = 'https://jsonplaceholder.typicode.com/users/';
    }
     
    public function listPost(Request $request){
        $data= "";
        $flag = false;
        try{         
            if(!empty($request->get('search'))){
                $search = $request->get('search');
                $userData = $this->getApi(self::$url->endpoint_user.$search);
                $postData = $this->getApi(self::$url->endpoint_post.$search);
                if($userData && $postData){
                    $flag=true;
                    $data= ["userData"=>$userData,"postData"=>$postData];
                }else{
                    $data= response()->json(['error' => 'Fallo al conectarse a la api']);
                }             
            }
        }catch(\Exception $e){
            Session::put('error', 'Ha ocurrido una excepcion: '.$e->getMessage());   
        }
        return view('api.post',['data'=>(object)$data,'flag'=>$flag]);
    }
    private function getApi($endpoint){
        $response = Http::get($endpoint);
        if($response->successful()){
            return $response->json();
        }
        return null;
    }
}