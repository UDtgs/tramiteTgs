@extends('template.main')
@section('title',$title)

@section('head')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
@endsection

@section('content')
    <div id="btn">
        <a href="{{route('grafica','polar')}}">Grafica polar</a>
        <a href="{{route('grafica','columnas')}}">Grafica Columnas</a>
    </div>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
    </div>
    <div>
        <strong>Cantidad de Tipo de Tramites: </strong>{{number_format($tipoTramite,0,',','.')}}<br>
        <strong>Numero Inicial de Tramite: </strong>{{$numeroTramites}}<br>
        <strong>Cantidad de Entidades Disponibles: </strong>{{$entidadesDisponibles}}<br>
        <strong>Numero de ciudadanos Solicitantes: </strong>{{$numeroSolicitantes}}<br>
        <strong>Tiempo Total de simulación: </strong>{{$tiempoTotal}}<br>
    </div>
@endsection

@section('script')



    <script type="text/javascript">
        $(function () {
            $('#container').highcharts({
                title: {
                    text: 'Line de tiempo de los tramites',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Medición con respecto al tiempo',
                    x: -20
                },
                xAxis: {
                    categories: [{{$periodos}}],
                    title:{
                        text: 'Periodo Tiempo en Horas',
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                yAxis: {
                    title: {
                        text: '' +
                        '' +
                        'Medición'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' - Unidades'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Concurrencia Tramites',
                    data: [{{$concurrenciaTramite}}]
                }, {
                    name: 'Concurrencia Entidades',
                    data: [{{$concurrenciaEntidad}}]
                }, {
                    name: 'Tramites Concluidos',
                    data: [{{$tramitesConcluidos}}]
                }, {
                    name: 'Tramites No Concluidos',
                    data: [{{$tramitesInconclusos}}]
                }, {
                    name: 'Media de Pasos Tramites',
                    data: [{{$mediasPasosTramites}}]
                }]
            });
        });
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

@endsection
