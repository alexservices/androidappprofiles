<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Puesto_Laboral;

class UserController extends Controller
{

    public function login(Request $request)
    {

        $response = array();
    
        $user = User::where('email', $request->email)
            ->first();
        if($user){
            if(\Hash::check($request->password,$user->password)){
                $puesto_laborales=Puesto_Laboral::where('user_id',$user->id)
                    ->get();
                $user->works=$puesto_laborales;
                $response['result'] = true;
                $response['records'] = $user;
                return $response;
            }
            
            else {

                $response['result'] = false;
                $response['message'] = "Password no coincide";
                return $response;
            }
        }

        else {

            $response['result'] = false;
            $response['message'] = "Usuario no registrado";
            return $response;
        }
                
    }


    public function listar_usuarios(){
        $response = array();    
        $users=User::all();
        $response['result']=true;
        $response['records']=$users;
        return $response;  
    }

    public function consultar_usuario(Request $request){
        $response = array();    
        $users=User::where('id',$request->id)
            ->first();
        if($users){
            $puesto_laborales=Puesto_Laboral::where('user_id',$users->id)
                ->get();
            $users->works=$puesto_laborales;
            $response['result']=true;
            $response['records']=$users;
        }
        else{
            $response['result']=false;
            $response['message']="Usuario no encontrado";
        }
        return $response;  
    }

   
}
