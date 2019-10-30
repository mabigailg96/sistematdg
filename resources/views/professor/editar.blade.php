@extends('layouts.app')

@section('javascript')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Modificacion de datos del  Profesor
                    <a href="{{ route('professor.index') }}" align="right" class="btn btn-primary btn-color offset-5" role="button">Regresar</a>
                </div>
                <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form  class="form-horizontal" action="{{ route('professor.update', $professor->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label for="nombre" class="textlabel col-md-3 offset-1 control-label required">Nombres: </label>
                                        <div class="col-md-6">
                                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $professor->nombre }}" required>
                                            @if ($errors->has('nombre'))
                                                <span class="help-block">
                                                {{ $errors->first('nombre') }}
                                                </span>
                                            @endif
                                        </div>
                             </div>
                             <div class="row form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                    <label for="apellido" class="textlabel col-md-3 offset-1 control-label required">Apellidos: </label>
                                        <div class="col-md-6">
                                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $professor->apellido }}" required>
                                            @if ($errors->has('apellido'))
                                                <span class="help-block">
                                                {{ $errors->first('apellido') }}
                                                </span>
                                            @endif
                                        </div>
                             </div>
                             <div class="row form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
                                    <label for="codigo" class="textlabel col-md-3 offset-1 control-label required">Codigo: </label>
                                        <div class="col-md-6">
                                            <input id="codigo" type="text" class="form-control" name="codigo" value="{{ $professor->codigo }}" required>
                                            @if ($errors->has('codigo'))
                                                <span class="help-block">
                                                {{ $errors->first('codigo') }}
                                                </span>
                                            @endif
                                        </div>
                             </div>

                             <div class="row form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                    <label class="textlabel col-md-3 offset-1 control-label required" for="estado">Estado del profesor</label>
                                    <div class="urlinput col-md-6">
                                        <select id="estado" class="form-control" name="estado" value="{{ old('estado' )}}"  class="form-control col-8" required>


                                         @if ($professor->estado == 1)
                                         <option value="{{ $professor->estado }}" selected>Activo</option >
                                            <option value="0" >Inactivo </option >
                                         @else
                                         <option value="{{ $professor->estado }}" selected>Inactivo</option >
                                            <option value="1" >Activo </option >
                                         @endif



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
                                            <button type="submit" class="btn btn-primary btn-color" id="guardar">
                                                Guardar Profesor
                                            </button>
                                        </div>
                                    </div>
                    </form>
                    <br>
                </div>
                <div class="card-footer text-muted">

                        Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                        &nbsp;
                        &nbsp;
                        &nbsp;



                    </div>
            </div>

        </div>

    </div>

</div>
@endsection
