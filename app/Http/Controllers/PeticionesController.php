<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeticionesController extends Controller
{
    public function index(){
        $data=['title'=>'SimuladorTGS tramites'];
        return view('index')->with($data);
    }

    public function formulario1(){
        $data=['title'=>'Formulario de contacto'];
        return view('formulario1')->with($data);
    }

    public function procesarFormulario1(Request $request){
        $this->validate($request,[
            'tramiteProceso'=>'required|numeric',
            'tramiteAbandonados'=>'required|numeric',
            'tramiteConcluidos'=>'required|numeric',
        ]);/**validaciones de los campos*/
        $data=['title'=>'Grafica'];
        return view('grafica')->with($data);
    }
}
