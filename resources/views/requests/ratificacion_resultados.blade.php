@extends('layouts.app')

@section('javascript')
<script src="" defer></script>
<link rel="stylesheet" type = "text/css" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					Ingresar solicitud de ratificación de resultados.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
						
                    <form class="form-horizontal" method="POST" action="{{ route('request_result.guardar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
					{{$tdgs->nombre}}
				</div>
               

                <div class="card">
                    <h6 class="card-header">Agrege las calificaciones finales a los alumnos.</h6>
                    <div class="card-body">
                    <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="textlabel col-md-2 control-label offset-2 required">Profesor:</label>
                            <div class="col-md-6">
                            <input id="nombre" name="nombre" type="text" class="form-control required" value="{{old('nombre')}}" required autofocus>
                            <button type="submit" class="btn btn-primary btn-color">
                                   Agregar profesor.
                                </button>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        {{ $errors->first('nombre') }}
                                    </span>
                                @endif
                            </div>
                </div>
                        
                    </div>
                </div>


                <ul class="list-group">
  <li class="list-group-item">Profesor 1</li>
  <li class="list-group-item">Profesor 2</li>
  <li class="list-group-item">Profesor 3</li>
</ul>

                        

                        
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