<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeticionesController extends Controller
{
    /**
     * catga la vista principal
    */
    public function index(){
        $data=['title'=>'Simulador Trámites de Solicitud '];
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
        $concurrenciaEntidad="";/**Cantidad de entidades que reciben solicitudes de tramites*/
        $concurrenciaTramite="";/**Establece la cantidad de los diferentes tramites que estan siendo solicitados*/
        $tramitesConcluidos="";/**Cantidad de tramites que se conclulleron dentro del sistema*/
        $tramitesInconclusos="";/**Cantidad de tramites que no se conclulleron en el sistema*/
        $mediasPasosTramites="";/**media de pasos por tramites en un instante de tiempo*/
        $totalTamites=$request->numeroTramites;
        /** calcula la media de los pasos de los tramites*/
        $mediaPasos=$totalTamites/(rand(1,$totalTamites/2));
        /** calcula la cantidad de tramites disponibles durante un periodo n */
        $tipoTramite=$mediaPasos-rand(0,$totalTamites);
        $tipoTramite=$tipoTramite<=0?($tipoTramite=0?$request->entidadesDisponibles*$mediaPasos/$totalTamites:$tipoTramite*-1):$tipoTramite;
        /**Tiempo promedio por tramite*/
        $numeroSolicitantes=rand(0,$request->numeroSolicitantes);
        $periodos="";
        $concluidos=0;
        $Calculos=new CalculosController();
        for($i=0;$i<$request->tiempoTotal;$i++):
            /**separador de comas para el arreglo q se le pasa a la grafica en javascrip*/
            $separador=$i<$request->tiempoTotal?',':'';
            /**calcula concurrencias en el tiempo determinado*/
            $concurrenciaEntidad.=$Calculos->concurrenciaEntidad($numeroSolicitantes,$totalTamites,$tipoTramite,$mediaPasos,$request->entidadesDisponibles).$separador;
            $concurrenTramite=$Calculos->concurrenciaTramite($numeroSolicitantes,$tipoTramite,$mediaPasos);
            $concurrenciaTramite.=$concurrenTramite.$separador;
            /***/
            $consultar=$Calculos->calcularTramitesConcluidos($totalTamites,$request->entidadesDisponibles);
            $tramitesConcluidos.=$consultar['concluidos'].$separador;
            $concluidos=$consultar['concluidos'];
            $tramitesInconclusos.=$consultar['inconclusos'].$separador;
            /**Recalcula el total de tramites existentes en el sistema*/
            $totalTamites=$Calculos->recalcularTramites($totalTamites,$concluidos,$mediaPasos);
            /***/
            $mediasPasosTramites.=$mediaPasos.$separador;
            /**Toma el periodo del tiempo en el que se realiza el calculo*/
            $periodos.=($i+1).$separador;
            /** calcula la media de los pasos de los tramites*/
            $mediaPasos=(rand(1,$totalTamites/2))/$totalTamites*$request->entidadesDisponibles;
            /** determina la cantidad de solicitantes en el periodo de  tiempo */
            $numeroSolicitantes=rand(0,$request->numeroSolicitantes);
        endfor;
        /**crea el conjunto de datos que se le enviara a la vista*/
        $data=[
            'title'=>'Grafica',
            'concurrenciaEntidad'=>$concurrenciaEntidad,
            'concurrenciaTramite'=>$concurrenciaTramite,
            'tramitesConcluidos'=>$tramitesConcluidos,
            'tramitesInconclusos'=>$tramitesInconclusos,
            'mediasPasosTramites'=>$mediasPasosTramites,
            'periodos'=>$periodos,
            'tipoTramite'=>$tipoTramite,
            'numeroTramites'=>$request->numeroTramites,
            'entidadesDisponibles'=>$request->entidadesDisponibles,
            'numeroSolicitantes'=>$request->numeroSolicitantes,
            'tiempoTotal'=>$request->tiempoTotal,
        ];
        session(['data'=>$data]);
        return view('grafica')->with($data);
    }
    /**
     * carga una grafica en espesifico
     */
    public function cargarGrafica($grafica){
        $data=session()->get('data');
        $vista="";
        switch ($grafica){
            case 'polar':
                $vista='graficaPolar';
                break;
            case 'columnas':
                $vista='graficaColumn';
                break;
            default:
                $vista='grafica';
                break;
        }
        return view($vista)->with($data);
    }
}
