@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ingresar_ciclo.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-ver-ciclos-tab" data-toggle="tab" href="#nav-ver-ciclos" role="tab" aria-controls="nav-ver-ciclos" aria-selected="true">Ver ciclos</a>
                            <a class="nav-item nav-link" id="nav-ingresar-ciclo-tab" data-toggle="tab" href="#nav-ingresar-ciclo" role="tab" aria-controls="nav-ingresar-ciclo" aria-selected="false">Ingresar ciclo</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <!-- Parte de tabla de listar ciclos -->
                        <div class="tab-pane fade show active" id="nav-ver-ciclos" role="tabpanel" aria-labelledby="nav-ver-ciclos-tab">
                            <br>
                            <table id="table-semesters" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col-6">Ciclo</th>
                                        <th scope="col-6">Fecha de inicio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{$semester->ciclo}}</td>
                                        <td>{{$semester->fechaInicio}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>

                        </div>
                        <!-- Parte del formulario de ingresar ciclo -->
                        <div class="tab-pane fade" id="nav-ingresar-ciclo" role="tabpanel" aria-labelledby="nav-ingresar-ciclo-tab">

                            <br>
                            <div class="card">
                                <div class="card-header">
                                    Ingresar inicio del ciclo
                                </div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" method="POST" action="{{ route('semester.guardar') }}" enctype="multipart/form-data">
                                    @csrf

                                        <div class="row form-group{{ $errors->has('ciclo') ? ' has-error' : '' }}">
                                            <label for="ciclo" class="textlabel col-md-2 control-label offset-2 required">Ciclo</label>
                                            <div class="col-md-6">
                                
                                            <select id="ciclo" name="ciclo" value="{{old('ciclo')}}"  class="form-control" required>
                                                <option selected disabled>Seleccione un ciclo:</option >
                                                <option value="I" >I</option>
                                                <option value="II" >II</option>
                                            </select>

                                                @if ($errors->has('ciclo'))
                                                    <span class="help-block">
                                                        {{ $errors->first('ciclo') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row form-group{{ $errors->has('fechaInicio') ? ' has-error' : '' }}">
                                            <label for="fechaInicio" class="textlabel col-md-3 control-label offset-1 required">Fecha de inicio</label>
                                            <div class="col-md-6">
                                                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                                                @if ($errors->has('fechaInicio'))
                                                    <span class="help-block"    >
                                                        {{ $errors->first('fechaInicio') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="form-group"></div>

                                        <div class="row form-group">
                                            <div class="col-md-2 offset-4">
                                                <button type="submit" class="btn btn-primary btn-color">
                                                    Guardar ciclo
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                                <div class="card-footer text-muted">
                                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
