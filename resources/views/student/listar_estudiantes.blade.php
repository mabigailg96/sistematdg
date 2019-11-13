@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/todos_estudiantes.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Estudiantes registrados. </div>
                    <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                        <a href="{{ route('student.ingresar') }}"  class=" btn btn-primary btn-color" role="button"><span class="oi oi-person"></span>Ingresar estudiantes</a>
                        <br>
                        <br>
                        @include('filtro_nombre_carnet_escuela')
                        <br>
                        <table id="table-filtro-nombres-carnet" class="table table-striped">
                                <thead>
                                    <tr>
                                            <th scope="col">Carnet </th>
                                            <th scope="col">Nombre </th>
                                            <th scope="col">Apellido </th>
                                            <th scope="col">Escuela </th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
            </div>

        </div>

    </div>

</div>
@endsection
