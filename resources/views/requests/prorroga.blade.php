@extends('layouts.app')

@section('javascript')
<script src="{{ asset('') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ingresar solicitud de prórroga
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('request_extension.guardar') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body bg-light">
                                {{$tdgs->nombre}}
                            </div>
                        </div>
                        <br>

                        <div class="row form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                            <label for="fecha_inicio" class="textlabel col-md-4 offset-1 control-label">Fecha de
                                inicio</label>
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="textlabel control-label"
                                    value="{{old('fecha_inicio')}}">{{$fechaInicio}} </label>
                                <input type="hidden" name="fecha_inicio" value="{{$fechaInicio}}">
                                @if ($errors->has('fecha_inicio'))
                                <span class="help-block">
                                    {{ $errors->first('fecha_inicio') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                            <label for="fecha_fin" class="textlabel col-md-4 offset-1 control-label">Fecha de
                                finalización</label>
                            <div class="col-md-6">
                                <label for="fecha_fin" class="textlabel control-label"
                                    value="{{old('fecha_fin')}}">{{$fechaFin}}</label>
                                <input type="hidden" name="fecha_fin" value="{{$fechaFin}}">

                                @if ($errors->has('fecha_fin'))
                                <span class="help-block">
                                    {{ $errors->first('fecha_fin') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('justificacion') ? ' has-error' : '' }}">
                            <label for="justificacion"
                                class="textlabel col-md-4 offset-1 control-label required">Justificación</label>
                            <div class="col-md-6">
                                <textarea id="justificacion" type="text" class="textarea form-control"
                                    name="justificacion" value="{{old('justificacion')}}" rows="10" cols="50" required
                                    autofocus></textarea>
                                @if ($errors->has('justificacion'))
                                <span class="help-block">
                                    {{ $errors->first('justificacion') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tdg_id') ? ' has-error' : '' }}">
                            <input type="hidden" name="tdg_id" value="{{$tdgs->id}}">
                        </div>
                        <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <input type="hidden" name="tipo" value="{{$tipo}}">
                        </div>


                        <div class="row form-group">
                            <div class="col-2 offset-4">
                                <a class="btn btn-danger" href="{{ route('solicitudes.listar') }}" role="button">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar solicitud
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser
                    llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection