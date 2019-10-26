@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/editar_usuario.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Modificacion de usuario.
                  
                        <a href="{{ route('user.index') }}" align="right" class="btn btn-primary btn-color offset-6" role="button">Regresar</a>
                  
                  </div>
                  <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form  class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="textlabel col-md-3 offset-1 control-label required">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" required>
                                        @if ($errors->has('nombre'))
                                            <span class="help-block">
                                            {{ $errors->first('nombre') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="username" class="textlabel col-md-3 offset-1 control-label required">Nombre de usuario</label>
                                            <div class="col-md-6">
                                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                    {{ $errors->first('username') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                            <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email" class="textlabel col-md-3 offset-1 control-label required">Correo Electronico</label>
                                                        <div class="col-md-6">
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                {{ $errors->first('email') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                            <label for="password" class="textlabel col-md-3 offset-1 control-label required">Contraseña</label>
                                                                <div class="col-md-6">
                                                                    <input id="password" type="password" class="form-control" name="password" value="" >
                                                                    @if ($errors->has('password'))
                                                                        <span class="help-block">
                                                                        {{ $errors->first('password') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                                <div class="row form-group">
                                                                        <div class="col-md-2 offset-4">
                                                                            <button type="submit" class="btn btn-primary btn-color" id="guardar">
                                                                                Guardar usuario
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
