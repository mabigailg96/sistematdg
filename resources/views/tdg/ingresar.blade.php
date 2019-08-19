@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_tdg.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <span id="token" style="display:none">{{ csrf_token() }}</span>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					Ingresar el perfil del trabajo de graduación.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
						
                    <form class="form-horizontal" method="POST" action="{{ route('tdg.guardar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="textlabel col-md-3 offset-1 control-label required">Nombre</label>
                            <div class="col-md-6">
								<textarea id="nombre" type="nombre" class="textarea form-control" name="nombre" value="{{old('nombre')}}" rows="10" cols="50" required autofocus></textarea>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
							<label for="perfil" class="textlabel col-md-3 offset-1 control-label required">Archivo perfil</label>
                            <div class="urlinput col-md-6">
                                <input id="perfil" type="file" name="perfil" required>

                                @if ($errors->has('perfil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perfil') }}</strong>
                                    </span>
                                @endif
                            </div>
						</div>

                        <div class="row form-group{{ $errors->has('ciclo') ? ' has-error' : '' }}">
                            <label class="textlabel col-md-3 offset-1 control-label required" for="ciclo">Ciclo</label>
                            <select id="ciclo" name="ciclo" value="{{old('ciclo')}}"  class="form-control col-4"  required>
                                <option value="" selected>Seleccione un ciclo...</option >
                                <option value="01">I</option>
                                <option value="02">II</option>
                            </select>
                            @if ($errors->has('ciclo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ciclo') }}</strong>
                                </span>
                            @endif
                        </div>
 
                        <div class="row form-group{{ $errors->has('anio') ? ' has-error' : '' }}" style="margin-top:10px">
                            <label class="textlabel col-md-3 offset-1 control-label required" for="anio">Año</label>
                            <select id="anio" name="anio" value="{{old('anio')}}" class="form-control col-4" required>
                                <option value="" selected>Seleccione el año </option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                            @if ($errors->has('anio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('anio') }}</strong>
                                </span>
                            @endif
                        </div>
						
                        <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                            <input type="hidden" name="college_id" value="{{auth()->user()->college_id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar perfil
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