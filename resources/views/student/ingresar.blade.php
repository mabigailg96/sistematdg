@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_student.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
					Importación de alumnos.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
						
                    <form class="form-horizontal" method="POST" action="{{ route('student.guardar') }}" enctype="multipart/form-data">
                        @csrf
                    <br>
                        <div class="row form-group{{ $errors->has('file') ? ' has-error' : '' }}">
							<label for="file" class="textlabel col-md-3 offset-1 control-label required">Elegir el archivo a importar</label>
                            <div class="urlinput col-md-6">
                                <input id="file" class="form-control-file" type="file" name="file" required>
                                @if ($errors->has('file'))
                                    <span class="help-block row">
                                        {{ $errors->first('file') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('escuela_id') ? ' has-error' : '' }}">
                            <label class="textlabel col-md-3 offset-1 control-label required" for="escuela_id">Seleccione la escuela</label>
                            <div class="urlinput col-md-6">
                                <select id="escuela_id" class="form-control" name="escuela_id" value="{{ old('escuela_id' )}}"  class="form-control col-8" required>
                                    <option value="" selected disabled>Seleccione la escuela:</option >
                                    
                                </select>
                                @if ($errors->has('escuela_id'))
                                    <span class="help-block">
                                        {{ $errors->first('escuela_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar alumnos
                                </button>
                            </div>
						</div>
						
                    </form>
                    <br>
                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
