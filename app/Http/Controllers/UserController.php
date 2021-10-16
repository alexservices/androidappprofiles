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
            'telefono_casa'=> 'required',
            'telefono_celular'=> 'required',
            'works'=>'required',
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
            if(isset($request->password))
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

            if ($request->hasFile('imagen')) {
                //  Let's do everything here
                if ($request->file('imagen')->isValid()) {
                    //
                    $validated = $request->validate([
                        'name' => 'string|max:40',
                        'imagen' => 'mimes:jpeg,png,gif,tif,bmp|max:1014',
                    ]);
                    $extension = $request->imagen->extension();
                    $request->imagen->storeAs('/public', $validated['name'].".".$extension);
                    $url = Storage::url($validated['name'].".".$extension);
                    $user->imagen=$url; 
                }
            }
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


       

    }

   
   
}
