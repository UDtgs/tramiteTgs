@extends('template.main')
@section('title',$title)

@section('head')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
@endsection

@section('content')
    <div id="btn">
        <a href="{{route('grafica','lineas')}}">Grafica lineas</a>
        <a href="{{route('grafica','columnas')}}">Grafica Columnas</a>
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
                    polar: true
                },

                title: {
                    text: 'Tramites'
                },

                pane: {
                    startAngle: 0,
                    endAngle: 360
                },

                xAxis: {
                    tickInterval: 45,
                    min: 0,
                    max: 360,
                    labels: {
                        formatter: function () {
                            return this.value + ' t (horas)';
                        }
                    }
                },

                yAxis: {
                    min: 0
                },

                plotOptions: {
                    series: {
                        pointStart: 0,
                        pointInterval: 45
                    },
                    column: {
                        pointPadding: 0,
                        groupPadding: 0
                    }
                },

                series: [{
                    type: 'column',
                    name: 'Concurrencia Tramites',
                    data: [{{$concurrenciaTramite}}],
                    pointPlacement: 'between'
                }, {
                    type: 'line',
                    name: 'Concurrencia Entidades',
                    data: [{{$concurrenciaEntidad}}]
                }, {
                    type: 'area',
                    name: 'Tramites Concluidos',
                    data: [{{$tramitesConcluidos}}]
                }, {
                    type: 'area',
                    name: 'Tramites No Concluidos',
                    data: [{{$tramitesInconclusos}}]
                }, {
                    type: 'area',
                    name: 'Media de Pasos Tramites',
                    data: [{{$mediasPasosTramites}}]
                }]
            });
        });
    </script>
    </head>
    <body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
@endsection