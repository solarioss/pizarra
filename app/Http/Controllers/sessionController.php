<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Cuadro;


class sessionController extends Controller
{
    public function createSession(Request $request){
        $datos=[
            'nombre'=> $request->nombre,
            'creador'=> $request->creador,
            'codigo'=> $request->codigo,
            'password'=>$request->password,
            'numero'=>0,
            'cantidad'=>0,
        ];
        $session=Session::create($datos); 
        return response()->json($session,200);
    }

    public function SessionSored(Request $request){
        $usuario= $request->usuario;

        $sesiones= Session::where('creador',$usuario)->orderBy('created_at','desc')->get();
        return response()->json($sesiones,200);
    }

    public function SessionJoin(Request $request){
        $codigo= $request->codigo;
        $password= $request->password;

      
        $sesion= Session::where('codigo',$codigo)->get();       

        if(Session::where('codigo',$codigo)->count()==0){
            return response()->json('codigo incorrecto',500);
        }
        else if( $sesion[0]['password']!=$password){
            return response()->json('password incorrecto',500);
        }
        else{
        return response()->json($sesion,200);
        }
    }

    public function SessionSearch(Request $request){
        $session= Session::where('codigo',$request->codigo)->first();
        return response()->json($session,200);
    }

    public function SessionGuardarSesion(Request $request){

        $cambio= ['numero'=>$request->numero,'cantidad'=>$request->cantidad];

        
        $session= Session::where('codigo',$request->codigo)->update($cambio);
        return response()->json($session,200);
    }

    public function BorrarAntiguo(Request $request){

        Cuadro::where('sesion',$request->codigo)->delete();
       
        return response()->json('borrado',200);
    }

    public function AgregarCuadro(Request $request){
        $datos= [
        'sesion'=>$request->sesion,
        'x'=>$request->x,
        'y'=>$request->y,
        'nombre'=>$request->nombre,
        'tipo'=>$request->tipo,
        'padre'=>$request->padre,
        'hijo1'=>$request->hijo1,
        'hijo2'=>$request->hijo2,
        'hijo3'=>$request->hijo3,
        'codificacion'=>$request->codificacion,
        'instruccion'=>$request->instruccion
        ];

        $nuevo= Cuadro::create($datos);
        return response()->json($nuevo,200);    
    }


    public function RestaurarCuadros(Request $request){
        
        $respuesta= Cuadro::join('session', 'session.codigo', 'cuadro.sesion')->select('cuadro.nombre','x','y','tipo','hijo1','hijo2','hijo3','instruccion','sesion','cantidad','numero','padre')->where('sesion',$request->codigo)->get();
        return response()->json($respuesta,200);  
    }
}
