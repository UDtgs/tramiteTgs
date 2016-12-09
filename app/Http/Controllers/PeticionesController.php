<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeticionesController extends Controller
{
    /**
     * catga la vista principal
    */
    public function index(){
        $data=['title'=>'SimuladorTGS tramites'];
        return view('index')->with($data);
    }
    /**
     * carga el formulario 1
    */
    public function formulario1(){
        $data=['title'=>'Formulario de contacto'];
        return view('formulario1')->with($data);
    }
    /**
     * procesa los datos enviados por el formulario 1 y carga la grafica generados por el proceso de estos
    */
    public function procesarFormulario1(Request $request){
        $this->validate($request,[
            'numeroSolicitantes'=>'required|numeric',
            'entidadesDisponibles'=>'required|numeric',
            'numeroTramites'=>'required|numeric',
            'tiempoTotal'=>'required|numeric',
        ]);/**validaciones de los campos*/
        $graficas=array();
        $concurrenciaEntidad="";/**Cantidad de entidades que reciben solicitudes de tramites*/
        $concurrenciaTramite="";/**Establece la cantidad de los diferentes tramites que estan siendo solicitados*/
        $tramitesConcluidos="";/**Cantidad de tramites que se conclulleron dentro del sistema*/
        $tramitesInconclusos="";/**Cantidad de tramites que no se conclulleron en el sistema*/
        $totalTamites=$request->numeroTramites;
        /** calcula la media de los pasos de los tramites*/
        $mediaPasos=$totalTamites/(rand(1,$totalTamites/2));
        /** calcula la cantidad de tramites disponibles durante un periodo n */
        $tipoTramite=$mediaPasos-rand(0,$totalTamites);
        $totalTamites=$tipoTramite<=0?($tipoTramite=0?$request->entidadesDisponibles*$mediaPasos/$totalTamites:$tipoTramite*-1):$tipoTramite;
        $periodos="";
        $Calculos=new CalculosController();
        for($i=0;$i<$request->tiempoTotal;$i++):
            /**separador de comas para el arreglo q se le pasa a la grafica en javascrip*/
            $separador=$i<$request->tiempoTotal?',':'';
            /**calcula concurrencias en el tiempo determinado*/
            $concurrenciaEntidad.=$Calculos->concurrenciaEntidad($request->numeroSolicitantes,$totalTamites,$tipoTramite,$mediaPasos,$request->entidadesDisponibles).$separador;
            $concurrenciaTramite.=$Calculos->concurrenciaTramite($request->numeroSolicitantes,$tipoTramite,$mediaPasos).$separador;
            /**Recalcula el total de tramites existentes en el sistema*/
            $totalTamites=$Calculos->recalcularTramites($totalTamites,$request->numeroSolicitantes,$concurrenciaTramite,$mediaPasos).$separador;
            /**Toma el periodo del tiempo en el que se realiza el calculo*/
            $periodos.=($i+1).$separador;
            /** calcula la media de los pasos de los tramites*/
            $mediaPasos=$totalTamites/(rand(1,$totalTamites/2));
        endfor;
        /**crea el conjunto de datos que se le enviara a la vista*/
        $data=[
            'title'=>'Grafica',
            'concurrenciaEntidad'=>$concurrenciaEntidad,
            'concurrenciaTramite'=>$concurrenciaTramite,
            'periodos'=>$periodos,
            'tipoTramite'=>$tipoTramite
        ];
        return view('grafica')->with($data);
    }
}
