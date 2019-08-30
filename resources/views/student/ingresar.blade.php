@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_student.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					Ingresar estudiantes.
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif

                    <form action="{{ route('student.guardar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="textlabel col-md-4 control-label offset-1 required">Archivo de estudiantes</label>

                        <input  id="file" type="file" name="file" required >
                        <br>

                        <div class="col-md-4 offset-5">
                            <button class="btn btn-primary btn-color" id="btnCargar" name="btnCargar" >Guardar estudiantes</button>
                        </div>
                        <div class="row offset-5">
                            <span style="color:red; margin-left:10px">*</span> Campos requeridos.
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
