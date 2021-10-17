<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Puesto_Laboral;
use Illuminate\Support\Facades\Validator;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use DB;

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
      
        $users= DB::table('puesto__laborals')
			->join('users','users.id','=','puesto__laborals.user_id')
			->select('users.imagen','users.name','users.id', 'puesto__laborals.titulo','puesto__laborals.tiempo')
            ->where('tipo', '0')
			->get();

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

    public function show($id)
    {
        $user= User::find($id);
        $puestos= $user->puesto_laboral()->get();
        return view( 'profiles.resume',['user'=>$user,'puestos'=>$puestos]);
    }

    public function edit(Request $request){

        $response = array();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required',
            'universidad'=> 'required',
            'sede'=> 'required',
            'edad'=> 'required',
            'sexo'=> 'required',
            'direccion'=> 'required',
            'telefono_celular'=> 'required',
            'id'=>'required'
        ]);
        
        if($validator->fails()){
            $response['errors'] = $validator->errors();
            $response['result'] = false;
        }
        else {

            $user=User::where('id',$request->id)
            ->first();
            if($user){
            $user->name=$request->name;
            $user->email=$request->email;
            if(isset($request->password) && Str::length($user->password)>0)
            {
            $user->password=\Hash::make($request->password);
            }
            $user->universidad=$request->universidad;
            $user->sede=$request->sede;
            $user->edad=$request->edad;
            $user->sexo=$request->sexo;
            $user->direccion=$request->direccion;
            $user->telefono_casa=$request->telefono_casa;
            $user->telefono_celular=$request->telefono_celular;
            $user->save();
            $puesto_laborales=Puesto_Laboral::where('user_id',$user->id)
                ->get();   
            $user->works=$puesto_laborales;
            $response['records']=$user;
            $response['result']=true;
            }
            else{
                $response['result']=false;
                $response['message']="Usuario no encontrado";
            }

        }

        return $response;
       

    }

    public function load_image(Request $request){
        $response = array();    
        $users=User::where('id',$request->id)
            ->first();
          
        if($users){ 
            if ($request->file('imagen')!=null) {
                if ($request->file('imagen')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:40',
                        'imagen' => 'mimes:jpeg,png,gif,tif,bmp|max:1014',
                    ]);
                    $extension = $request->imagen->extension();
                    $filename= Carbon::now()."_". $validated['name'].".".$extension;
                    $request->imagen->storeAs('/', $filename);
                    $url = $validated['name'].".".$extension;
                    $users->imagen=$filename; 
                    $users->save();

                    $puesto_laborales=Puesto_Laboral::where('user_id',$users->id)
                         ->get();
                    $users->works=$puesto_laborales;
                    $response['result']=true;
                    $response['records']=$users;

                    return $response;
                }

            }
            
        }
        else{
            $response['result']=false;
            $response['message']="Usuario no encontrado";
        }
        return $response;  
    }
   
   
}
