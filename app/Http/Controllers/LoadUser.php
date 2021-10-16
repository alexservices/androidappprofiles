<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Puesto_Laboral;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LoadUser extends Controller
{
    
    public function load_data(Request $request){
        $response = array();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> ['required', 'unique:users'],
            'password'=>'required',
            'universidad'=> 'required',
            'sede'=> 'required',
            'edad'=> 'required',
            'sexo'=> 'required',
            'direccion'=> 'required',
            'telefono_celular'=> 'required',
            'works'=>'required'
        ]);

        if($validator->fails()){
            $response['errors'] = $validator->errors();
            $response['result'] = false;
        }
        
        else{
            $user = new User;

            if ($request->hasFile('imagen')) {
                
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
                    $user->imagen=$filename; 
                    
                }
            }


            $response['records'] = $request;
            
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=\Hash::make($request->password);
            $user->universidad=$request->universidad;
            $user->sede=$request->sede;
            $user->edad=$request->edad;
            $user->sexo=$request->sexo;
            $user->direccion=$request->direccion;
            $user->telefono_casa=$request->telefono_casa;
            $user->telefono_celular=$request->telefono_celular;
            
            $user->save();

            $recorrer=json_decode($request->works,true);
            $array_works = array();
            foreach( $recorrer as $key => $value){
                $puesto_laboral=new Puesto_Laboral;
                $puesto_laboral->titulo=$value['titulo'];
                $puesto_laboral->empresa=$value['empresa'];
                $puesto_laboral->tiempo=$value['tiempo'];
                $puesto_laboral->tipo=$value['tipo'];
                $puesto_laboral->user_id=$user->id;
                $puesto_laboral->save();    
                array_push($array_works,$puesto_laboral);
            } 
            $user->works=$array_works;    
            $response['records'] = $user;
            $response['result'] =true;
          
        }
        return $response;

    }

    

}
