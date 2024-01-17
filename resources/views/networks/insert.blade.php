<form id="frmInsertNetwork" action="{{ route('networks.insert') }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-12 form-group">
			<label for="ip">IP*</label>
			<input type="text" class="form-control" id="ip" name="ip">
		</div>
		<div class="col-md-12 form-group">
			<label for="mask">Máscara*</label>
			<input type="text" class="form-control" id="mask" name="mask">
        </div>
		<div class="col-md-12 form-group">
			<label for="gateway">Puerta de enlace*</label>
			<input type="text" class="form-control" id="gateway" name="gateway">
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Registrar datos</button>
    </div>
</form>
<script src="{{ asset('resources/networks/insert.js?x='.env('CACHE_DATE')) }}"></script>