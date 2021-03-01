<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class userController extends Controller
{ 
    public function singup(Request $request){

        $validator = Validator::make($request->all(),
        ['nombre'=>'required|string',
        'email'=>'email|required|string',   
        'password'=>'required|string']);

        if ($validator->fails()) {
            return response()->json('Datos invalidos',500);
        }

        $existe= Usuario::where('email',$request->email)->first();
        if(!is_null($existe)){
            return response()->json('este email ya esta registrado',500);
        }

        $datos=[        
            'nombre'=>$request->nombre,
            'email'=>$request->email,        
            'password'=>Hash::make($request->password),            
        ];

        $usuario=Usuario::create($datos);    
            
        return response()->json($usuario,200);    
    
    }

    public function login(Request $request){
        
        
        $validator = Validator::make($request->all(),
        ['email'=>'email|required|string',
        'password'=>'required|string']        
         );

        if ($validator->fails()) {
            return response()->json('Datos invalidos',500);
        }
        $credentials=$this->validate(request(),
        ['email'=>'email|required|string',
        'password'=>'required|string']);

        $usuario=Usuario::select('id','nombre','email','password')->where('email',$request->email)->first();
        
        if (Auth::guard('usuario')->attempt($credentials)){ 
            return response()->json($usuario,200);
        }        
        return response()->json('incorrecto',500);

    }
    public function logout(){
        Auth::guard('usuario')->logout();
        return response()->json('deslogeado',200);
      }

    
}
