<div class="row">
        <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nombre</span>
                    </div>
                    <input type="text" id="txt-filtro-nombre-tdg" name="txt-filtro-nombre-tdg" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Codigo</span>
                    </div>
                    <input type="text" id="txt-filtro-codigo-tdg" name="txt-filtro-codigo-tdg" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>


    <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Escuela</span>
                     </div>

                    <select id="txt-filtro-escuela" class="form-control" name="txt-filtro-escuela" value="{{ old('escuela_id' )}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                        <option value="" selected disabled>Seleccione la escuela</option >

                    </select>
                    @if ($errors->has('escuela_id'))
                        <span class="help-block">
                            {{ $errors->first('escuela_id') }}
                        </span>
                    @endif

                </div>
            </div>

            <div class="col-md-1">
                <button type="button" id="btn-filtro-buscar" class="btn btn-primary btn-color"><span class="oi oi-magnifying-glass"></span>&nbsp;Buscar</button>
            </div>
</div>


