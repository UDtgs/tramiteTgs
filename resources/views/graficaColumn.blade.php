@extends('template.main')
@section('title',$title)

@section('head')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
        ${demo.css}
    </style>
@endsection

@section('content')
    <div id="btn">
        <a href="{{route('grafica','lineas')}}">Grafica lineas</a>
        <a href="{{route('grafica','polar')}}">Grafica polar</a>
    </div>
    <div id="container" style="min-width: 310px; max-width: 400px; height: 400px; margin: 0 auto"></div>
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
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tramites'
                },
                subtitle: {
                    text: 'Medición con respecto al tiempo'
                },
                xAxis: {
                    categories: [{{$periodos}}],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Medición'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
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