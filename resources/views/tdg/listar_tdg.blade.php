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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Escoga la solicitud que desea</label>
                                </div>
                                <select id="select-filtro-solicitud" class="custom-select">
                                    <option value="0" selected >Seleccionar solicitud de:</option>
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
                            <button type="button" id="btn-filtro-limpiar-busqueda" class="btn btn-outline-dark">Limpiar Búsqueda</button>
                        </div>
                    </div>
                    @include('filtro_codigo_nombre_escuela')

                    <table id="table-filtro-tdgs" class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Solicitar</th>
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
