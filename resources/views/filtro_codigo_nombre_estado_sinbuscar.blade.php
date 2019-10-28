<div class="row">
    <div class="col-md-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Código</span>
            </div>
            <input type="text" id="txt-filtro-codigo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Nombre</span>
            </div>
            <input type="text" id="txt-filtro-nombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>
    <div class="col-md-3">
        @include('select_estado')
    </div>
    <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
        <input id="filtro-escuela_id" type="hidden" name="college_id" value="{{auth()->user()->college_id}}">
    </div>
</div>