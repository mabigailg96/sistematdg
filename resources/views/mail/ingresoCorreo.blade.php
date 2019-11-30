@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/mail.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Envio de correo</div>
                <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('mail.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                                <div class="col-md-10">
                                        <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text">Destinatario</label>
                                                </div>
                                                <select id="destinatario" name="destinatario" class="form-control" class="custom-select" required>
                                                    <option value="" selected disabled required>Seleccione el usuario que desee:</option>
                                                    @foreach ($correos as $correo)
                                                    <option value="{{ $correo->email }}" >{{ $correo->nombre }}</option>


                                                    @endforeach
                                                </select>
                                            </div>
                                <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Asunto</span>
                                        </div>
                                        <input type="text" id="asunto" name="asunto" class="form-control @error('asunto') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                        @error('asunto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Mensaje</span>
                                            </div>
                                            <textarea  id="contenido" name="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="15" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required></textarea>
                                            @error('contenido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                </div>




                            </div>

                            <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-color" id="enviar">
                                        Enviar correo
                                    </button>
                                </div>
                        </form>


                </div>

            </div>

        </div>

    </div>

</div>
@endsection
