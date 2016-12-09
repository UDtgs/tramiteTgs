<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculosController extends Controller
{
    /**
     * calcula la concurrencia de las entidades
     * @param $solicitante - numero de solicitantes
     * @param $numeroTramite - numero de tramites
     * @param $tipoTramite - numero de tipo de tramites
     * @param $mediaPasos - media de pasos por tramite
     * @param $numeroEntidades
     * @return - concurrencia de entidades
     */
    public function concurrenciaEntidad($solicitante,$numeroTramite,$tipoTramite,$mediaPasos,$numeroEntidades){
        return $solicitante*($numeroTramite/$tipoTramite)*($mediaPasos/$numeroEntidades);
    }

    /**
     * calcula la concurrencia de tramites
     * @param $solicitante - numero de solicitantes
     * @param $tipoTramite - numero de tipo de tramites
     * @param $mediaPasos - media de pasos por tramite
     * @return - concurrencia de pasos
     */
    public function concurrenciaTramite($solicitante,$tipoTramite,$mediaPasos){
        return $solicitante*($mediaPasos/$tipoTramite);
    }
    /**
     * calcula el aumento de los tramites en el sistema, esto es determinado por la cantidad de tramites mas
     * la concurrencia de los tramites dividido en la media de pasos por los solicitantes
     * @param $solicitante - numero de solicitantes
     * @param $tipoTramite - numero de tipo de tramites
     * @param $mediaPasos - media de pasos por tramite
     * @return - numero de tramites recalculado
    */
    public function recalcularTramites($numeroTramites,$concluidos,$mediaPasos){
        $aux=$mediaPasos;

        return $numeroTramites+($aux<=0?1:$aux)-($concluidos/2);//-$concurrenciaTramites;
    }

    /**
     * calcula los tramites concluidos e inconclusos con respecto al tiempo
     * @param $numeroTramites- numero de tramites
     * @param $tiempoTotal - tiempo total ingresado
     * @param $tiempoPaso - tiempo promedio por paso
     * @param $mediaPasos - media de pasos por tramite
     * @return array - [tramites concluidos, tramites inconclusos]
     */
    public function calcularTramitesConcluidos($numeroTramites,$numeroEntidades){
        $porcentage=$numeroEntidades/$numeroTramites;
        $concluidos=$numeroTramites*$porcentage;
        if($concluidos>=$numeroTramites):
            $concluidos=$numeroTramites;
            $inconclusos=0;
        else:
            $inconclusos=$numeroTramites-$concluidos;
        endif;
        //dd(['concluidos'=>$concluidos,'inconclusos'=>$inconclusos,'tramites'=>$numeroTramites,'entidades'=>$numeroEntidades]);
        return ['concluidos'=>$concluidos,'inconclusos'=>$inconclusos];
    }

}
