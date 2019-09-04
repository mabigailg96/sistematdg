@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_tdg.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
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
                                       {{ $errors->first('nombre') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
							<label for="perfil" class="textlabel col-md-3 offset-1 control-label required">Archivo de perfil</label>
                            <div class="urlinput col-md-6">
                                <input id="perfil" type="file" name="perfil" required>
                                @if ($errors->has('perfil'))
                                    <span class="help-block row">
                                        {{ $errors->first('perfil') }}
                                    </span>
                                @endif
                            </div>
						</div>

                        <div class="row form-group{{ $errors->has('ciclo_id') ? ' has-error' : '' }}">
                            <label class="textlabel col-md-3 offset-1 control-label required" for="ciclo_id">Ciclo</label>
                            <div class="urlinput col-md-6">
                                <select id="ciclo_id" name="ciclo_id" value="{{old('ciclo_id')}}"  class="form-control col-8" required>
                                    <option value="" selected disabled>Seleccione un ciclo:</option >
                                    @foreach ($ciclos as $ciclo)
                                        <option value="{{ $ciclo->id}}">{{ $ciclo->ciclo}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ciclo_id'))
                                    <span class="help-block">
                                        {{ $errors->first('ciclo_id') }}
                                    </span>
                                @endif
                            </div>
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
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection