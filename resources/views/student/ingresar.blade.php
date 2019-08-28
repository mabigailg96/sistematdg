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

                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Guardar estudiantes</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
