@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/script.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido al sistema.</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Ha ingresado al sistema de gestión de trabajos de graduación.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <img src="css/home.png" class="img-fluid" alt="Responsive image">
</div>
<br>
<br>
<center><button type="button" class="btn btn-info" id="btn-prueba">Prueba Sweet Alert 2</button></center>
@endsection
