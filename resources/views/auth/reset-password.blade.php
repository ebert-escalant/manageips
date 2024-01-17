<x-guest-layout>
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Estás a un paso de tu nueva contraseña, recupera tu contraseña ahora.</p>
                <form action="{{ route('resetpassword') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <div class="form-group col-12">
                        <label for="email">Correo</label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control rounded-0" value="{{ $request->email }}" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-grpup col-12">
                        <label for="password">Nueva contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary btn-block">Restablecer contraseña</button>
                    </div>
                </form>
                <div class="form-group col-12">
                    <p class="mt-3 mb-1">
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
