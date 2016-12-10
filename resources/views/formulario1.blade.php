@extends('template.main')
@section('title',$title)

@section('content')
    <section class="formulario">
        <h2 style="text-align: center">Formulario inicial</h2>
        @include('template.alert')
        <form action="{{route('formulario.procesar')}}" method="post">
            {{csrf_field()}}

            <section class="izq">
                <label for="numeroSolicitantes">Número Solicitantes:</label><br/>
                <input min="10" max="500000" id="numeroSolicitantes" type="number" name="numeroSolicitantes" placeholder="0" required="" /><br/><br/>
                <label for="entidadesDisponibles">Entidades Disponibles:</label><br/>
                <input min="2" max="500000" maxlength="5" id="entidadesDisponibles" type="number" name="entidadesDisponibles" placeholder="0" required="" /><br/><br/>

            </section>
            <section class="der">
                <label for="numeroTramites">Numero Tramites Iniciales:</label><br/>
                <input min="2" max="500000" id="numeroTramites" type="number" name="numeroTramites" placeholder="0" required="" /><br/><br/>
                <label for="tiempoTotal">Tiempo Total (horas):</label><br/>
                <input min="10" max="5000" id="tiempoTotal" type="number" name="tiempoTotal" placeholder="0" required="" /><br/><br/>

            </section>

            <section class="cen">
                <input id="submit" type="submit" name="submit" value="Calcular" />
            </section>


        </form>
    </section>


@endsection

@section('script')
@endsection
