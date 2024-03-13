<form method="POST" action="{{ route('oficios.titulacion.enviar') }}" class="d-flex justify-content-center flex-column">
    @csrf
    <input type="text" class="d-none" name="id" readonly value="" id="id">

    <div class="mb-3 row">
        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" name="nombre" readonly class="form-control-plaintext" id="nombre" value="">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="codigo" class="col-sm-2 col-form-label">Codigo</label>
        <div class="col-sm-10">
            <input type="text" name="codigo" readonly class="form-control-plaintext" id="codigo" value="">
        </div>
    </div>


    <div class="mb-3 row">
        <label for="carrera" class="col-sm-2 col-form-label">Carrera</label>
        <div class="col-sm-10">
            <input type="text" name="carrera" readonly class="form-control-plaintext" id="carrera" value="">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" readonly class="form-control-plaintext" id="email" value="">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="estatus" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" name="estatus" readonly class="form-control-plaintext" id="estatus" value="">
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-sm btn-danger mt-3" type="submit">Enviar</button>
    </div>

</form>
