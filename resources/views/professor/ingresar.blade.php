@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_professor.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header"> Ingreso de profesores.</div>
                  <div class="card-body">
                       <div class=" justify-content-center">
                           <div class="row justify-content-center">
                            <p>
                                <button type="button" class="btn btn-primary btn-color" data-toggle="collapse" data-target="#excelInput">Registrar por Excel</button>
                                <button type="button" class="btn btn-primary btn-color" data-toggle="collapse" data-target="#registroIndividual">Registrar Individualmente</button>
                               </p>
                           </div>


                            <div id="excelInput" class="collapse card-body border">

                                    <form action="{{ route('professor.guardarexcel') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="file" class="textlabel col-md-4 control-label offset-1 required">Archivo de profesores</label>

                                        <input  id="file" type="file" name="file" required >

                                        <div class="col-md-4 offset-5">
                                            <button class="btn btn-primary btn-color" id="btnCargar" name="btnCargar" >Guardar profesores</button>
                                        </div>
                                        <div class="row offset-5">
                                            <span style="color:red; margin-left:10px">*</span> Campos requeridos.
                                        </div>
                                    </form>
                            </div>

                            <div id="registroIndividual" class="collapse card-body border">
                                <form class="form-horizontal" method="POST" action="{{ route('professor.guardar') }}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="row form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
                                        <label for="codigo" class="textlabel col-md-3 offset-1 control-label required "> Codigo </label>
                                        <div class="col-md-6">
                                            <input type="text" name="codigo" id="codigo"  class="textarea form-control" required>
                                                @if ($errors->has('codigo'))
                                                    <span class="help-block">
                                                        {{ $errors->first('codigo') }}
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                            <label for="nombre" class="textlabel col-md-3 offset-1 control-label required "> Nombres </label>
                                            <div class="col-md-6">
                                                <input type="text" name="nombre" id="nombre"  class="textarea form-control" required>
                                                    @if ($errors->has('nombre'))
                                                        <span class="help-block">
                                                            {{ $errors->first('nombre') }}
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                                <label for="apellido" class="textlabel col-md-3 offset-1 control-label required "> Apellidos </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="apellido" id="apellido"  class="textarea form-control" required>
                                                        @if ($errors->has('apellido'))
                                                            <span class="help-block">
                                                                {{ $errors->first('apellido') }}
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                    <div class="col-md-2 offset-4">
                                                        <button type="submit" class="btn btn-primary btn-color">
                                                            Guardar profesor
                                                        </button>
                                                    </div>
                                                </div>
                                 </form>

                           </div>
                       </div>

                  </div>

              </div>

          </div>

    </div>
</div>


@endsection
