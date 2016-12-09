@extends('template.main')
@section('title',$title)

@section('head')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
@endsection

@section('content')
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">

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
                    text: 'Tramites',
                    x: -20
                },
                xAxis: {
                    categories: [{{$periodos}}]
                },
                yAxis: {
                    title: {
                        text: '' +
                        '' +
                        'Tiempo'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '°C'
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
                    name: 'Entidades',
                    data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
                }, {
                    name: 'Tramites abandonados',
                    data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                }]
            });
        });
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
@endsection
