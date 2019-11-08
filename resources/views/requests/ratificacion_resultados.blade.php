@extends('layouts.app')

@section('javascript')

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Ingresar solicitud de ratificación de resultados
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('request_result.guardar') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body bg-light">
                                {{$tdgs->nombre}}
                            </div>
                        </div>
                        <br>

                        <table class="table form-group">
                            <thead>
                                <tr class="text d-flex row">

                                    <th class="d-inline-block col-5" scope="col">Apellidos</th>
                                    <th class="d-inline-block col-5" scope="col">Nombres</th>
                                    <th class="d-inline-block col-2 required text-center" scope="col">Nota</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                <tr class="d-flex row">
                                    <td class="d-inline-block col-5 ">{{$student->apellidos}}</td>
                                    <td class="d-inline-block col-5 ">{{$student->nombres}}</td>
                                    <td class="d-inline-block col-2">
                                        <div class="form-group row justify-content-center">
                                            <div class="col-6">
                                                <input type="number" id="nota[]" name="nota[]" min="0" max="10"
                                                    step="0.001" class="form-control nota" align="center" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="student[]" id="student[]"
                                                    value="{{$student->id}}">
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group{{ $errors->has('tdg_id') ? ' has-error' : '' }}">
                            <input type="hidden" name="tdg_id" value="{{$tdgs->id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col-2 offset-4">
                                <a class="btn btn-danger" href="{{ route('solicitudes.listar') }}" role="button">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Guardar resultados
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser
                    llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection