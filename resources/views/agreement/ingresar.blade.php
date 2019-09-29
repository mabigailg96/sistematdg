@extends('layouts.app')

@section('javascript')
<script src="{{ asset('') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ingresar acuerdo. 
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('agreement.guardar') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="textlabel col-md-2 control-label offset-2 required">Nombre</label>
                            <div class="col-md-6">
                            <input id="nombre" name="nombre" type="text" class="form-control required" value="{{old('nombre')}}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        {{ $errors->first('nombre') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label for="fecha" class="textlabel col-md-3 control-label offset-1 required">Fecha de acuerdo</label>
                            <div class="col-md-6">
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha')}}" required>
                                @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        {{ $errors->first('fecha') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="textlabel col-md-3 control-label offset-1 required">Archivo de acuerdo</label>

                            <div class="urlinput col-md-6">
                                <input id="url" type="file" class="form-control-file" name="url" required>

                                @if ($errors->has('url'))
                                    <span class="help-block row">
                                        {{ $errors->first('url') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                 <div class="row form-group col-md-12 offset-2">
                        <label for="url" class="textlabel control-label required">Resolución</label>
                
                        <div class="form-check form-check-inline offset-1" >
                            <input class="form-check-input" type="radio" name="aprobado" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Aceptar</label>
                          </div>
                      
                          <div class="form-check form-check-inline offset-1">
                            <input class="form-check-input" type="radio" name="aprobado" id="inlineRadio1" value="0" required>
                            <label class="form-check-label" for="inlineRadio1">Rechazar</label>
                          </div>
                        </div>


                        <div class="form-group{{ $errors->has('tipo_solicitud') ? ' has-error' : '' }}">
                            <input type="hidden" name="tipo_solicitud" value="{{$tipo_solicitud}}">
                        </div>

                        <div class="form-group{{ $errors->has('id_tdg') ? ' has-error' : '' }}">
                            <input type="hidden" name="id_tdg" value="{{$id}}">
                        </div>

                        <div class="form-group"></div>
                        <br>
                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar acuerdo
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
