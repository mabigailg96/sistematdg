@extends('layouts.app')
@section('javascript')
<script src="{{ asset('js/filtro_acuerdos_jd.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Acuerdos de Junta Directiva</div>
                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                        <br>
                        <br>
                        
                        @include('filtro_acuerdos_jd')

                        <br>
                        <table id="table-filtro-acuerdos" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Opcion</th>
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
