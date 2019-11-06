@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/editarTdg.js') }}" defer></script>
<script src="{{ asset('js/filtro_tdg_editar.js') }}" defer></script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
					Enviar solicitud
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
                    <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                    <br>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Escoja la opción que desee:</label>
                        </div>
                        <div>
                        <select id="select-filter-accion" class="form-control" class="custom-select">
                            <option value="0" selected disabled>Seleccione la accion:</option>
                            <option value="deshabilitar">Deshabilitar perfiles</option>
                            <option value="editar_grupo">Editar asignacion de grupo</option>
                            <option value="editar_nombre">Editar nombre</option>
                        </select>
                        </div>
                    </div>
                    
                    @include('filtro_codigo_nombre_escuela')

                    <table id="table-filtro-tdgs" class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ciclo</th>
                            <th scope="col">Escuela</th>
                            <th scope="col">Acción</th>
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