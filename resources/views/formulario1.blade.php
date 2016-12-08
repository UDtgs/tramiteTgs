@extends('template.main')
@section('title',$title)

@section('content')
    <section class="formulario">
        @include('template.alert')
        <form action="{{route('formulario.procesar')}}" method="post">
            {{csrf_field()}}
            <label for="tramiteProceso">Tramites en Proceso:</label>
            <input id="tramiteProceso" type="number" name="tramiteProceso" placeholder="0" required="" />
            <label for="tramiteAbandonados">Tramite Abandonados:</label>
            <input id="tramiteAbandonados" type="number" name="tramiteAbandonados" placeholder="0" required="" />
            <label for="tramiteConcluidos">Tramite Concluidos:</label>
            <input id="tramiteConcluidos" type="number" name="tramiteConcluidos" placeholder="0" required="" />
            <input id="submit" type="submit" name="submit" value="Enviar" />
        </form>
    </section>
@endsection

@section('script')
@endsection
