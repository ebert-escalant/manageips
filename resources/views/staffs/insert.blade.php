<form id="frmInsertStaff" action="{{ route('staffs.insert') }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-12 form-group">
			<label for="dni">DNI*</label>
			<input type="text" class="form-control" id="dni" name="dni">
		</div>
		<div class="col-md-12 form-group">
			<label for="fullname">Nombre*</label>
			<input type="text" class="form-control" id="fullname" name="fullname">
        </div>
		<div class="col-md-12 form-group">
			<label for="charge">Cargo*</label>
			<input type="text" class="form-control" id="charge" name="charge">
        </div>
		<div class="col-md-12 form-group">
			<label for="officeId">Oficina*</label>
			<select name="officeId" id="officeId" class="form-control select2" style="width: 100%;">
				<option></option>
				@foreach ($offices as $item)
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endforeach
			</select>
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Registrar datos</button>
    </div>
</form>
<script src="{{ asset('resources/staffs/insert.js?x='.env('CACHE_DATE')) }}"></script>