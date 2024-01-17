<x-guest-layout>
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.</p>
                @if (session('status') == 'verification-link-send')
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.
                    </div>
                @endif
                <form method="POST" action="{{ route('sendverifymail') }}">
                    @csrf
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reenviar correo de verificación</button>
                    </div>
                </form>
        
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary btn-block">Cerrar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
