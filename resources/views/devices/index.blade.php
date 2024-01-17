<x-app-layout>
	@push('css')
		<link rel="stylesheet" href="{{ asset('plugins/print-js/print.min.css') }}">
	@endpush
    <div class="row">
        <div class="form-group col-md-4">
            <button class="btn bg-indigo btn- elevation-3" data-toggle="tooltip" data-placement="right" title="Agregar equipo" onclick="openModal('modal-lg', 'Agregar equipo', null, '{{ route('devices.insert') }}', 'GET')">
                <i class="fas fa-plus fa-lg"></i> Agregar equipo
            </button>
        </div>
        <div class="form-group col-md-4">
            <form method="GET" action="{{ route('devices.index') }}">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="search" name="search" class="form-control" placeholder="Información para búsqueda (Enter)" autofocus autocomplete="off" value="{{ $search }}">
                </div>
            </form>
        </div>
		<div class="form-group col-md-4 d-flex justify-content-end">
			<div class="btn-group">
				<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Imprimir" onclick="printData()">
					<i class="fas fa-print"></i>
				</button>
				<a href="{{ route('devices.exportpdf').'?=search='.$search }}" target="_blank" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Exportar pdf">
					<i class="fas fa-file-pdf text-red"></i>
				</a>
				<form action="{{ route('devices.exportcsv') }}" method="POST" style="display: none;" id="frmExportCsv">
					@csrf
					<input type="text" name="search" value="{{ $search }}">
				</form>
				<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Exportar csv" onclick="document.getElementById('frmExportCsv').submit()">
					<i class="fas fa-file-csv text-lightblue"></i>
				</button>
				<form action="{{ route('devices.exportexcel') }}" method="POST" style="display: none;" id="frmExportExcel">
					@csrf
					<input type="text" name="search" value="{{ $search }}">
				</form>
				<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Exportar excel" onclick="document.getElementById('frmExportExcel').submit()">
					<i class="fas fa-file-excel text-green"></i>
				</button>
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-slate-300">
                                <th width="13%">MAC</th>
                                <th width="13%">Marca</th>
                                <th width="13%">Modelo</th>
                                <th width="13%">Tipo</th>
                                <th width="13%">Encargado</th>
                                <th width="13%">Oficina</th>
                                <th width="13%">IP</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->mac }}</td>
                                    <td>{{ $item->brand }}</td>
									<td>{{ $item->model }}</td>
									<td>{{ $item->type }}</td>
									<td>{{ $item->staff->fullname }}</td>
									<td>{{ $item->office->name }}</td>
									<td>{{ $item->network->ip }}</td>
                                    <td align="right">
                                        <button class="btn bg-teal btn-sm px-1 py-0" data-toggle="tooltip" data-placement="right"
                                            title="Editar equipo"
											onclick="openModal('modal-md', 'Editar equipo', null, '{{ route('devices.edit', $item->id) }}', 'GET')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn bg-maroon btn-sm px-1 py-0" data-toggle="tooltip" data-placement="right"
                                            title="Eliminar equipo"
                                            onclick="confirmModal(()=> { $('#modalLoading').show();document.getElementById('delete{{ $item->id }}device').submit(); })">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete{{ $item->id }}device" action="{{ route('devices.delete', $item->id) }}" method="POST" hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-12 d-flex align-items-end">
			{{ $data->onEachSide(0)->links() }}
		</div>
	</div>
	@push('js')
		<script src="{{ asset('plugins/print-js/print.min.js') }}"></script>
		<script>
			var baseUrl='{{ url('') }}';
			function printData() {
				printJS({ printable: '{{ route("devices.exportpdf") }}?search={{ $search }}', type: 'pdf' });
			}
		</script>
	@endpush
</x-app-layout>
