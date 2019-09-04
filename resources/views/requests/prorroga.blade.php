@extends('layouts.app')

@section('javascript')
<script src="" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					Ingresar solicitud de prórroga.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
						
                    <form class="form-horizontal" method="POST" action="{{ route('request_extension.guardar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row from-group col-md-8">
                    <label class="textlabel control-label"> {{$tdgs->nombre}}</label>
                </div>
                <br>
                <br>
                        <div class="row form-group{{ $errors->has('nombre_nuevo') ? ' has-error' : '' }}">
                            <label for="nombre_nuevo" class="textlabel col-md-3 offset-1 control-label required">Nombre propuesto</label>
                            <div class="col-md-6">
								<textarea id="nombre_nuevo" type="nombre_nuevo" class="textarea form-control" name="nombre_nuevo" value="{{old('nombre_nuevo')}}" rows="10" cols="50" required autofocus></textarea>
                                @if ($errors->has('nombre_nuevo'))
                                    <span class="help-block">
                                       {{ $errors->first('nombre_nuevo') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('justificacion') ? ' has-error' : '' }}">
                            <label for="justificacion" class="textlabel col-md-3 offset-1 control-label required">Justificación</label>
                            <div class="col-md-6">
								<textarea id="justificacion" type="justificacion" class="textarea form-control" name="justificacion" value="{{old('justificacion')}}" rows="10" cols="50" required autofocus></textarea>
                                @if ($errors->has('justificacion'))
                                    <span class="help-block">
                                       {{ $errors->first('justificacion') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="row offset-4">
                            <span style="color:red; margin-left:10px">*</span> Campos requeridos.
                        </div>
						
                        <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                            <input type="hidden" name="college_id" value="{{auth()->user()->college_id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar solicitud
                                </button>
                            </div>
						</div>
						
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection