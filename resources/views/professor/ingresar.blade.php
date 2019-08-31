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
                       <div class="row justify-content-center">
                           <p>
                            <button type="button" class="btn btn-primary btn-color" data-toggle="collapse" data-target="#excelInput">Registrar por Excel</button>
                            <button type="button" class="btn btn-primary btn-color" data-toggle="collapse" data-target="#demo">Registrar Individualmente</button>
                           </p>

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
                       </div>

                  </div>

              </div>

          </div>

    </div>
</div>


@endsection
