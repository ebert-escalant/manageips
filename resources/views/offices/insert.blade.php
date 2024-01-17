<form id="frmInsertOffice" action="{{ route('offices.insert') }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-12 form-group">
			<label for="name">Nombre*</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<div class="col-md-12 form-group">
			<label for="area">Área*</label>
			<input type="text" class="form-control" id="area" name="area">
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Registrar datos</button>
    </div>
</form>
<script src="{{ asset('resources/offices/insert.js?x='.env('CACHE_DATE')) }}"></script>