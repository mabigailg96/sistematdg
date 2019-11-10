@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/filtro_ver_solicitudes_escuela.js') }}" defer></script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
					Ver solicitudes de de Trabajos de Graduación.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
                    <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-primary btn-color float-right"><span class="oi oi-loop-circular"></span>&nbsp;Limpiar</button>
                    <br>

                    @include('filtro_codigo_nombre_sinbuscar')
                    
                    <br>

                    <div class="row">
                        <div class="col-md-5">
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Tipo de solicitud</label>
                                </div>
                                <select id="select-filtro-solicitud" class="custom-select">
                                    <option value="0" selected disabled>Seleccionar solicitud de:</option>
                                    <option value="aprobado">Aprobado</option>
                                    <option value="oficializacion">Oficialización</option>
                                    <option value="cambio_de_nombre">Cambio de nombre</option>
                                    <option value="prorroga">Prórroga</option>
                                    <option value="extension_de_prorroga">Extensión de prórroga</option>
                                    <option value="prorroga_especial">Prórroga especial</option>
                                    <option value="nombramiento_de_tribunal">Nombramiento de tribunal</option>
                                    <option value="ratificacion_de_resultados">Ratificación de resultados</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-filtro-buscar" class="btn btn-primary btn-color"><span class="oi oi-magnifying-glass"></span>&nbsp;Buscar</button>
                        </div>    
                    </div>

                    <table id="table-filtro-tdgs" class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo de solicitud</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Ver</th>
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