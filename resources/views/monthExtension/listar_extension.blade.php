@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/listar_prorroga.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="panel panel-default">
                        <div class="card-header">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-8">
                                                Listado de parámetros prórroga
                                            </div>
                                        
                                    </div>
                                </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                    <thead>
                                            <tr>
                                               
                                                <th>Tipo</th>
                                                <th>Meses</th>
                                                <th>Opciones</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($months as $month)
                                            <tr>
                                           
                                                <td>{{ $month->tipo }}</td>
                                                <td>{{ $month->meses }}</td>
                                                <td>
                                                        <a href="{{ route('month.edit', $month->id) }}"  class=" btn btn-primary btn-past btn-color btn-sm" role="button"><span class="oi oi-pencil"></span>  Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            {{ $months->render() }}
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection