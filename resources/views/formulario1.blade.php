@extends('template.main')
@section('title',$title)

@section('content')
    <section class="formulario" id="formulario">
        <h2 style="text-align: center">Formulario inicial</h2>
        @include('template.alert')
        <form action="{{route('formulario.procesar')}}" method="post">
            {{csrf_field()}}
            <label for="numeroSolicitantes">Número Solicitantes:</label><br/>
            <input id="numeroSolicitantes" type="number" name="numeroSolicitantes" placeholder="0" required="" /><br/><br/>
            <label for="entidadesDisponibles">Entidades Disponibles:</label><br/>
            <input id="entidadesDisponibles" type="number" name="entidadesDisponibles" placeholder="0" required="" /><br/><br/>
            <label for="numeroTramites">Numero Tramites:</label><br/>
            <input id="numeroTramites" type="number" name="numeroTramites" placeholder="0" required="" /><br/><br/>
            <label for="tiempoTotal">Tiempo Total (horas):</label><br/>
            <input id="tiempoTotal" type="number" name="tiempoTotal" placeholder="0" required="" /><br/><br/>
            <input id="submit" type="submit" name="submit" value="Enviar" />
        </form>
    </section>


@endsection

@section('script')
@endsection
