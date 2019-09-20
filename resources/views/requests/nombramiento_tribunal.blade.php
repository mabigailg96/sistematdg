@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_nombramiento_tribunal.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					Ingresar solicitud de nombramiento de tribunal.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
                    <div class="card-header">
                    <p id="tdg-id" class="oculto">{{$tdgs->id}}</p>
					{{$tdgs->nombre}}
				</div>
                <br>
                <br>
                    <!-- Espacio para buscar Docente -->
                    <h3>Agregar docente al tribunal calificador</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Buscar docente</span>
                                </div>
                                <input type="text" id="txt-buscar-docente" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-agregar-docente" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                    <br>

                    <br>
                    <h3>Listado de tribunal calificador:</h3>
                    <ul id="lista-tribunal" class="list-group">
                    </ul>

                    <!-- Botones para guardar o cancelar la asignacion de grupo de TDG -->
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <button type="button" id="btn-guardar" class="btn btn-primary btn-color">Envíar solicitud</button>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button type="button" id="btn-cancelar" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection