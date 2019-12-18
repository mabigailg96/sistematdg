@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_professor.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">

                <div class="card-header">
                    Importación de docentes.
                   
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif

                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <a class="btn  btn-primary btn-color" href="{{ route('professor.index') }}" role="button"><span class="oi oi-arrow-circle-left"></span> Regresar</a>
                            
                           
                        </div>
                    </div>


                    <br>
                    <div class="row justify-content-center">
                        <button type="button" id="btn-formulario-excel" class="btn btn-primary btn-color">Importar docentes archivo excel</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="btn-formulario-individual" class="btn btn-primary btn-color">Registrar individualmente</button>
                    </div>
                    <br>
                    <br>
                    <!-- Formulario para registro con excel -->
                    <div id="formulario-excel" class="card collapse">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('professor.guardarexcel') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row form-group{{ $errors->has('file') ? ' has-error' : '' }}">                                        <label for="file" class="textlabel col-md-3 offset-1 control-label required">Elegir el archivo a importar</label>
                                    <div class="urlinput col-md-6">
                                        <input id="file" class="form-control-file" type="file" name="file" accept=".xlsx, .xls, .xlsm, .xlsb, .xltx, .xltm, .xlt, .xml, .xlam, .xla, .xlw" required>
                                        @if ($errors->has('file'))
                                            <span class="help-block row">
                                                {{ $errors->first('file') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-2 offset-4">
                                        <button id="btn-formulario-excel" type="submit" class="btn btn-primary btn-color">
                                            Guardar docentes
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Formulario para registro de docentes de forma individual -->
                    <div id="formulario-individual" class="card collapse">
                        <div class="card-body">
                              <form class="form-horizontal" method="POST" action="{{ route('professor.guardar') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="codigo" class="textlabel col-md-3 offset-1 control-label required">Código</label>
                                    <div class="col-md-6">
                                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{old('codigo')}}" required>
                                        @if ($errors->has('codigo'))
                                            <span class="help-block">
                                            {{ $errors->first('codigo') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label for="nombre" class="textlabel col-md-3 offset-1 control-label required">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{old('nombre')}}" required>
                                        @if ($errors->has('nombre'))
                                            <span class="help-block">
                                            {{ $errors->first('nombre') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                    <label for="apellido" class="textlabel col-md-3 offset-1 control-label required">Apellido</label>
                                    <div class="col-md-6">
                                        <input id="apellido" type="text" class="form-control" name="apellido" value="{{old('apellido')}}" required>
                                        @if ($errors->has('apellido'))
                                            <span class="help-block">
                                            {{ $errors->first('apellido') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-2 offset-4">
                                        <button type="submit" class="btn btn-primary btn-color">
                                            Guardar docente
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.

                </div>

              </div>
          </div>
    </div>
</div>




@endsection
