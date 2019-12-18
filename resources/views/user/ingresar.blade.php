@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_usuario.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ingreso de nuevo usuario.
                  </div>
                  <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form  class="form-horizontal" action="{{ route('user.guardar') }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="textlabel col-md-3 offset-1 control-label required">Nombre</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{old('nombre')}}" required>
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
                                <input id="username" type="text" class="form-control" name="username" value="{{old('username')}}" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                    {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('escuela_id') ? ' has-error' : '' }}">
                            <label class="textlabel col-md-3 offset-1 control-label required " for="escuela_id">Seleccione la escuela</label>
                            <div class="urlinput col-md-6">
                                <select id="escuela_id" class="form-control" name="escuela_id" value=" "  class="form-control col-8 required" required>
                                    <option value="" selected disabled>Seleccione la escuela:</option >

                                </select>
                                @if ($errors->has('escuela_id'))
                                    <span class="help-block">
                                        {{ $errors->first('escuela_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="textlabel col-md-3 offset-1 control-label required">Correo electrónico</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}" required>
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
                                <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label class="textlabel col-md-3 offset-1 control-label required" for="role_id">Seleccione el rol del usuario</label>
                            <div class="urlinput col-md-6">
                                <select id="role_id" class="form-control" name="role_id" value=" "  class="form-control col-8" required>
                                    <option value="" selected disabled>Seleccione el rol del usuario:</option >
                                        @foreach ($roles as $rol)
                                        <option value={{$rol->id}}>{{ $rol->name }}</option >
                                        @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                        {{ $errors->first('role_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-2 offset-4">
                                <a href="{{ route('user.index') }}"  class=" btn btn-danger" role="button">Cancelar</a>
                            </div>
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar usuario
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
