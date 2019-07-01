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
					Ingresar el perfil de trabajo del graduación.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
						
                    <form class="form-horizontal" method="POST" action="{{ route('tdg.guardar') }}" enctype="multipart/form-data">
                       {{ csrf_field() }}

                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="textlabel col-md-2 offset-2 control-label">Nombre</label>
                            <div class="col-md-6">
								<textarea id="nombre" class="textarea form-control" rows="10" cols="50" required autofocus></textarea>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
							<label for="perfil" class="textlabel col-md-3 offset-1 control-label">Archivo Acuerdo</label>
                            <div class="urlinput col-md-6">
                                <input id="perfil" type="file" name="perfil">

                                @if ($errors->has('perfil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perfil') }}</strong>
                                    </span>
                                @endif
                            </div>
						</div>
						
                        <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                            <input type="hidden" name="college_id" value="{{auth()->user()->college_id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-login">
                                    Guardar Perfil
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