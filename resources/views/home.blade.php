@extends('layouts.app')

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
@endsection
