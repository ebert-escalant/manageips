<x-guest-layout>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="login-box-msg">Ingresa tus credenciales para acceder a la plataforma</p>
                <form action="{{ route('login') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group col-12">
                        <label for="email">Correo</label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control rounded-0">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="password">Contraseña</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control rounded-0">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary rounded-0 btn-block">Iniciar sesión</button>
                    </div>
                </form>
                <div class="form-group col-12 d-flex justify-content-center">
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Registrar una nueva cuenta</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
