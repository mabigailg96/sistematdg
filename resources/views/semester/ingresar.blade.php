@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_ciclo.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <span id="token" style="display:none">{{ csrf_token() }}</span>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ingresar inicio del ciclo
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('semester.guardar') }}" enctype="multipart/form-data">
                       {{ csrf_field() }}

                        <div class="row form-group{{ $errors->has('ciclo') ? ' has-error' : '' }}">
                            <label for="ciclo" class="textlabel col-md-2 control-label offset-2 required">Ciclo</label>
                            <div class="col-md-6">
                
                            <select id="ciclo" name="ciclo" value="{{old('ciclo')}}"  class="form-control" required>
                                <option selected disabled>Seleccione un ciclo:</option >
                                <option value="I" >I</option>
                                <option value="II" >II</option>
                            </select>

                                @if ($errors->has('ciclo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ciclo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row form-group{{ $errors->has('fechaInicio') ? ' has-error' : '' }}">
                            <label for="fechaInicio" class="textlabel col-md-3 control-label offset-1 required">Fecha de inicio</label>
                            <div class="col-md-6">
                                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                                @if ($errors->has('fechaInicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fechaInicio') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block">
                                    <strong id="mensaje_fecha" class="oculto">xD</strong>
                                </span>
                            </div>
                        </div>
                      
                        <br>
                        <div class="row form-group">
                            <div class="col-md-2 offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar ciclo
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
