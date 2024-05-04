@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.password_reset_message'))

@section('auth_body')
    <form action="{{ $password_reset_url }}" method="post">
        @csrf

        {{-- Token field --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
            placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                
                <button type="button" class="btn btn-outline-primary border-0" id="showPasswordBtn" title="Mostrar constraseña">
                    <span  class="fas fa-eye {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </button>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password confirmation field --}}
        <div class="input-group mb-3">
            
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                
            <div class="input-group-append">
                 <div class="input-group-text">
                     <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                 </div>
                 
            </div>
             
 
             @error('password_confirmation')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
            <div id="password-errors">
                             
            </div>
        </div>

        {{-- Confirm password reset button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-sync-alt"></span>
            {{ __('adminlte::adminlte.reset_password') }}
        </button>

    </form>
@stop

@section('js')
    <script>
        $(function() {
            $('#showPasswordBtn').click(function () {
                var passwordFields = $('#password, #password-confirm');
                var passwordFieldType = passwordFields.attr('type');
                if (passwordFieldType === 'password') {
                    passwordFields.attr('type', 'text');
                    $(this).html('<i class="fa fa-eye-slash"></i>');
                } else {
                    passwordFields.attr('type', 'password');
                    $(this).html('<i class="fa fa-eye"></i>');
                }
            });

            // Validación de contraseña segura
            $('#password, #password_confirm').on('input', function () {
                var password = $('#password').val();
                var confirmPassword = $('#password-confirm').val();
                var passwordErrors = $('#password-errors');
                var errors = [];
                console.log(confirmPassword);

                // Validar longitud mínima
                if (password.length < 8) {
                    errors.push("La contraseña debe tener al menos 8 caracteres.");
                }

                // Validar al menos un número
                if (!/\d/.test(password)) {
                    errors.push("La contraseña debe contener al menos un número.");
                }

                // Validar al menos una letra mayúscula
                if (!/[A-Z]/.test(password)) {
                    errors.push("La contraseña debe contener al menos una letra mayúscula.");
                }

                // Validar al menos un carácter especial
                if (!/[\W_]/.test(password)) {
                    errors.push("La contraseña debe contener al menos un carácter especial.");
                }

                // Mostrar los mensajes de error
                if (errors.length > 0) {
                    passwordErrors.html('<ul class="text-danger"><li>' + errors.join('</li><li>') + '</li></ul>');
                } else {
                    passwordErrors.html('');
                }
            });
        });
    </script>
@stop
