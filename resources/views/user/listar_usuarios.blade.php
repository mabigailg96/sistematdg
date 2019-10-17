@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/todos_usuario.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="panel panel-default">
                            <div class="card-header">
                                    <div class="panel-heading">
                                          Usuarios del sistema de gestion de trabajos de graduacion. &nbsp; &nbsp; &nbsp; &nbsp;

                                          <a href="{{ route('ingresar.usuario') }}"  class=" btn btn-primary btn-color" role="button"><span class="oi oi-person"></span> &nbsp; &nbsp;Ingresar nuevo usuario</a>
                                    </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                        <thead>
                                                <tr>
                                                    <th width="10px" >Id</th>
                                                    <th>Nombre</th>
                                                    <th>Usuario</th>
                                                    <th>Opciones</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->nombre }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>
                                                            <a href="{{ route('user.edit', $user->id) }}"  class=" btn btn-primary btn-past btn-color btn-sm" role="button"><span class="oi oi-pencil"></span>  Editar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                                {{ $users->render() }}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
