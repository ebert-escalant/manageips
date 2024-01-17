<x-guest-layout>
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registro</p>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <div class="input-group">
                            <input type="text" id="name" name="name" class="form-control rounded-0">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control rounded-0">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary rounded-0 btn-block">Registrar datos</button>
                    </div>
                </form>
                <div class="form-group col-12 d-flex justify-content-center">
                    <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
