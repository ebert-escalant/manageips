<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DREA</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('css')
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
		<div id="modalLoading" style="display: none;">
            <div>
                <div>
                    <div>
                        <img src="{{asset('img/loader.svg')}}" width="70%">
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.header')
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('img/logo-drea-sm.png') }}" alt="LOGO DREA" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">DREApurímac</span>
            </a>
            <div class="sidebar">
                @include('layouts.partials.menu')
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>
            </div>
            <div class="content">
				<div id="mainDiv"></div>
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Versión 1.0
            </div>
            <strong>Copyright &copy; 2024-{{ date('Y') }} <a href="#">develops</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!--select2-->
    <script src="{{ asset('plugins/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/plugins/select2/js/i18n/es.js') }}"></script>
	<!-- jQuery validation -->
	<script src="{{ asset('plugins/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('plugins/adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
	<!-- printjs -->
	{{-- <script src="{{ asset('plugins/printjs/print.min.js') }}"></script> --}}
    <script>
		$(document).ready(function() {
			$('form[method="post"]').on('keypress', function(event) {
				if (event.keyCode === 13) {
					event.preventDefault();
				}
			});
		});

        $(function() {
            @if (Session::has('globalMessage'))
                @if (Session::get('type') == 'error' || Session::get('type') == 'exception')
                    @foreach (Session::get('globalMessage') as $value)
                        @if (trim($value) != '')
                            toastr.error('{{ $value }}', 'No se pudo proceder');
                        @endif
                    @endforeach
                @else
                    swal.fire({
                        title: '{{ Session::get('type') == 'success' ? 'Correcto' : 'Alerta' }}',
                        text: '{!! Session::get('globalMessage')[0] !!}',
                        icon: '{{ Session::get('type') }}',
                        timer: '{{ Session::get('type') == 'success' ? '3000' : '8000' }}',
                    });
                @endif
            @endif
        });

		function openModal(width, title, data, url, method)
		{

			$('#mainDiv').html('');

			$('#modalLoading').show();

			$.ajax(
			{
				url: url,
				type: method,
				data: data,
				cache: false,
				async: true
			}).done(res => {
				$('#modalLoading').hide();

				$('#mainDiv').html(`
					<div class="modal fade" id="genericModal" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog ${width}">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">${title}</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									${res}
								</div>
							</div>
						</div>
					</div>
				`);

				$('#genericModal').modal('show');
			}).fail(() => {
				$('#modalLoading').hide();
				toastr.error('Ocurrió un error inesperado. Por favor reporte esto a la plataforma.');
			});
		}

		function confirmModal(callback) {
			Swal.fire(
			{
				title : 'Confirmar operación',
				text : '¿Desea proceder con la operación?',
				icon : 'warning',
				showCancelButton: true,
				confirmButtonText: 'Si, proceder!',
				cancelButtonText: 'No, cancelar!',
			}).then(conf =>
			{
				if(conf.isConfirmed)
				{
					callback();
				}
			});
		}
    </script>
    @stack('js')
</body>

</html>
