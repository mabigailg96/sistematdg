@extends('layouts.app')

@section('javascript')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Modificacion de prórroga.
                  </div>
                  <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form  class="form-horizontal" action="{{ route('month.update', $month->id) }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="row form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                                <label for="tipo" class="textlabel col-md-3 offset-1 control-label required">Tipo</label>
                                    <div class="col-md-6">
                                        <input id="tipo" type="text" class="form-control" name="tipo" value="{{ $month->tipo }}" required>
                                        @if ($errors->has('tipo'))
                                            <span class="help-block">
                                            {{ $errors->first('tipo') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group{{ $errors->has('meses') ? ' has-error' : '' }}">
                                        <label for="meses" class="textlabel col-md-3 offset-1 control-label required">Meses</label>
                                            <div class="col-md-6">
                                                <input id="meses" type="text" class="form-control" name="meses" value="{{ $month->meses }}" required>
                                                @if ($errors->has('meses'))
                                                    <span class="help-block">
                                                    {{ $errors->first('meses') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        
                                                                <div class="row form-group">
                                                                        <div class="col-md-2 offset-4">
                                                                            <button type="submit" class="btn btn-primary btn-color" id="guardar">
                                                                                Actualizar prórroga
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