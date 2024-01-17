<form id="frmInsertDevice" action="{{ route('devices.insert') }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
			<label for="mac">MAC*</label>
			<input type="text" class="form-control" id="mac" name="mac">
		</div>
		<div class="col-md-6 form-group">
			<label for="brand">Marca*</label>
			<input type="text" class="form-control" id="brand" name="brand">
        </div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group">
			<label for="model">Modelo</label>
			<input type="text" class="form-control" id="model" name="model">
        </div>
		<div class="col-md-6 form-group">
			<label for="type">Tipo</label>
			<input type="text" class="form-control" id="type" name="type">
        </div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="staffId">Encargado*</label>
			<select name="staffId" id="staffId" class="form-control select2" style="width: 100%;">
				<option></option>
				@foreach ($staffs as $item)
					<option value="{{ $item->id }}">{{ $item->fullname }}</option>
				@endforeach
			</select>
        </div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group">
			<label for="officeId">Oficina*</label>
			<select name="officeId" id="officeId" class="form-control select2" style="width: 100%;">
				<option></option>
				@foreach ($offices as $item)
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endforeach
			</select>
        </div>
		<div class="col-md-6 form-group">
			<label for="networkId">IP*</label>
			<select name="networkId" id="networkId" class="form-control select2" style="width: 100%;">
				<option></option>
				@foreach ($networks as $item)
					<option value="{{ $item->id }}">{{ $item->ip }}</option>
				@endforeach
			</select>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="description">Descripción</label>
			<textarea name="description" id="description" rows="3" style="resize: none;" class="form-control"></textarea>
        </div>
	</div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Registrar datos</button>
    </div>
</form>
<script src="{{ asset('resources/devices/insert.js?x='.env('CACHE_DATE')) }}"></script>