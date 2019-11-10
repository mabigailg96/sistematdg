@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/todos_usuario.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection
@section('content')
<div class="container">
    <div class=" row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div  class="card-header">Usuarios del sistema</div>
                    <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                        <a href="{{ route('ingresar.usuario') }}"  class=" btn btn-primary btn-color" role="button"><span class="oi oi-person"></span>Ingresar nuevo usuario</a>
                        <br>
                        <br>
                        @include('filtro_nombre_usuarios')

                        <br>
                        <table id="table-filtro-nombres" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id </th>
                                    <th scope="col">Nombre </th>
                                    <th scope="col">Usuario </th>
                                    <th scope="col">Opciones </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
            </div>

        </div>

    </div>

</div>

@endsection
