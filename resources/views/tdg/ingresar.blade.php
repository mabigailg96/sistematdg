@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_tdg.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <span id="token" style="display:none">{{ csrf_token() }}</span>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingresar Trabajo de Graduación</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('tdg.guardar') }}" enctype="multipart/form-data">
                       {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="nombre" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                            <label for="perfil" class="col-md-4 control-label">Archivo Acuerdo</label>

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




                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
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