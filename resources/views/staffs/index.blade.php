<x-app-layout>
    <div class="row">
        <div class="form-group col-md-4">
            <button class="btn bg-indigo btn- elevation-3" data-toggle="tooltip" data-placement="right" title="Agregar personal" onclick="openModal('modal-md', 'Agregar personal', null, '{{ route('staffs.insert') }}', 'GET')">
                <i class="fas fa-plus fa-lg"></i> Agregar personal
            </button>
        </div>
        <div class="form-group col-md-8">
            <form method="GET" action="{{ route('staffs.index') }}">
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-lg table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
							<tr class="bg-slate-300">
								<th width="10%">DNI</th>
								<th width="30%">Nombre completo</th>
                                <th width="20%">Cargo</th>
                                <th width="20%">Oficina</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->dni }}</td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->charge }}</td>
                                    <td>{{ $item->office->name }}</td>
                                    <td align="right">
                                        <button class="btn bg-teal btn-sm px-1 py-0" data-toggle="tooltip" data-placement="right"
                                            title="Editar personal"
											onclick="openModal('modal-md', 'Editar personal', null, '{{ route('staffs.edit', $item->id) }}', 'GET')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn bg-maroon btn-sm px-1 py-0" data-toggle="tooltip" data-placement="right"
                                            title="Eliminar personal"
                                            onclick="confirmModal(()=> { $('#modalLoading').show();document.getElementById('delete{{ $item->id }}staff').submit(); })">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete{{ $item->id }}staff" action="{{ route('staffs.delete', $item->id) }}" method="POST" hidden>
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
</x-app-layout>
