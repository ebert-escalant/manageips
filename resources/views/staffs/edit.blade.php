<form id="frmEditStaff" action="{{ route('staffs.edit', $staff->id) }}" method="POST" autocomplete="off">
    @csrf
	@method('PUT')
    <div class="col-md-12 form-group">
		<label for="dni">DNI*</label>
		<input type="text" class="form-control" id="dni" name="dni" value="{{ $staff->dni }}">
	</div>
	<div class="col-md-12 form-group">
		<label for="fullname">Nombre*</label>
		<input type="text" class="form-control" id="fullname" name="fullname" value="{{ $staff->fullname }}">
	</div>
	<div class="col-md-12 form-group">
		<label for="charge">Cargo*</label>
		<input type="text" class="form-control" id="charge" name="charge" value="{{ $staff->charge }}">
	</div>
	<div class="col-md-12 form-group">
		<label for="officeId">Oficina*</label>
		<select name="officeId" id="officeId" class="form-control select2" style="width: 100%;">
			<option></option>
			@foreach ($offices as $item)
				<option value="{{ $item->id }}" {{ $staff->office->id==$item->id ? 'selected' : '' }}>{{ $item->name }}</option>
			@endforeach
		</select>
	</div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="submit" class="btn bg-lightblue">Guardar datos</button>
    </div>
</form>
<script src="{{ asset('resources/staffs/edit.js?x='.env('CACHE_DATE')) }}"></script>