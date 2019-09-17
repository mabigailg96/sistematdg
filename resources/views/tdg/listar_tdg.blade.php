@extends('layouts.app')
@section('javascript')
<script src="{{ asset('js/filtro_tdg_ratificacion.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Busqueda de TDG para ratificacion</div>
                <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    @include('filtro_tdg_ratificacion')
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-outline-dark">Limpiar Búsqueda</button>
                        </div>
                    </div>
                <br>
                <table id="table-filtro-tdg-ratificacion" class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre de Tdg</th>
                            <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
