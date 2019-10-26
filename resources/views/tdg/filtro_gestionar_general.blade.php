@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/filtro_tdg_gestionar_general.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
					Ver detalles
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
					
                    <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                    <br>
                    <br>

                    @include('filtro_codigo_nombre_escuela_sinbuscar')

                    <br>
                    
                    @include('select_estado_estudiante_conbuscar')

                    <table id="table-filtro-tdgs" class="table table-striped">
                        <thead>
                            <tr>
                            <th  scope="col">Código</th>
                            <th  scope="col">Nombre</th>
                            <th  scope="col">Estado</th>
                            <th  scope="col">Seleccionar</th>
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