<form id="frmEditOffice" action="{{ route('offices.edit', $office->id) }}" method="POST" autocomplete="off">
    @csrf
	@method('PUT')
    <div class="row">
        <div class="col-md-12 form-group">
			<label for="name">Nombre*</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ $office->name }}">
		</div>
		<div class="col-md-12 form-group">
			<label for="area">Área*</label>
			<input type="text" class="form-control" id="area" name="area" value="{{ $office->area }}">
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Guardar datos</button>
    </div>
</form>
<script src="{{ asset('resources/offices/edit.js?x='.env('CACHE_DATE')) }}"></script>