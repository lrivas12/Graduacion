@extends('layouts.index')

@section('title', 'Perfil')

@section('css')
    <style>
        .modal {
            display: none;
        }

        .mini-formulario {
            display: none;
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .section {
            display: flex;
            justify-content: space-between;
        }

        .fa-question-circle {
            font-size: 27px;
        }

        .sectionT2 {
            background-color: rgb(17, 0, 94);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 10px;
            /* Espaciado interior */
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados */
        }
    </style>

@stop


@section('content_header')
    <section class="section">
    <h1><i class="fas fa-user"></i> Bienvenido a tu perfil || <strong> {{ $user->usuario }} </strong></h1>
    </section>
    <hr class="my-2" />
    <br>
@stop

@section('content')
<div class="container">
    <div class="container1">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form id="editUserForm" method="POST" action="{{ route('perfil.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if ($user->foto)
                                        <div class="img-area select-image">
                                            <img id="photoPreview" src="{{ asset('storage/usuarios/' . $user->foto) }}"
                                                alt="Foto de perfil" class="rounded-circle p-1 bg-primary"
                                                width="110">
                                            <h1><i class="fas fa-camera"></i></h1>
                                        </div>
                                    @else
                                        <div class="img-area select-image">
                                            <img id="photoPreview" style="max-width: 120px; border-radius: 50%;">
                                            <h1><i class="fas fa-camera"></i>
                                            </h1>
                                        </div>
                                        <p>No hay imagen</p>
                                    @endif
                            </form>
                            <div class="mt-3">
                                    <h4><i class="fas fa-user"></i>  {{ $user->usuario }}</h4>
                                    <p class="text-muted font-size-sm"><i class="fas fa-user"></i> {{ $user->privilegios }}</p>
                                    <p class="text-muted font-size-sm"><i class="fas fa-mail"></i> {{ $user->email }}</p>
                                <br>
                                <a class="btn btn-outline-warning" id="mostrarFormulario"
                                    onclick="mostrarFormulario()">Editar Perfil</a>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fas fa-user-check success"></i> Estado: </h6>
                                <span class="@if($user->estado == 1) text-success @else text-danger @endif">
                                    @if($user->estado == 1)
                                        Activo
                                    @else
                                        Desactivado
                                    @endif
                                </span>
                            </li>                                
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fas fa-cog"></i> Rol: </h6>
                                <span class="text-primary">{{ $user->privilegios }}</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-lg-8" id="formularioContainer" style="display:none">
                <form id="editUserForm" method="POST" action="{{ route('perfil.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-body">
                            <h4 class="justify-content-center">Editar mis datos</h4>
                            <br>

                            <input type="file" id="foto" onchange="updateImagePreview(this)" accept="image/*"
                                hidden name="foto" />

                            <div class="form-group row">
                                <label for="usuario"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario:') }}</label>

                                <div class="col-md-6">
                                    <input id="usuario" type="text"
                                        class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                                        value="{{ old('usuario', $user->usuario) }}" required autocomplete="usuario"
                                        autofocus>

                                    @error('usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico:') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">
                                                <i class="fa fa-eye"></i> </button>
                                            </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña:') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                        
                                <div id="password-errors" class="col-md-6 offset-md-4"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-md-3 offset-md-3">
                                    <button id="usereditado" type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>
@section('js')

    <script>
        function updateImagePreview(input) {
            const imagePreview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Esta función se llama cuando se selecciona un archivo en el input de imagen
        function previewImage(event) {
            const input = event.target; // Obtiene el elemento de entrada de archivo que desencadenó el evento
            const imagePreview = document.getElementById('photoPreview'); // Obtiene la imagen de vista previa

            // Comprueba si se ha seleccionado un archivo
            if (input.files && input.files[0]) {
                const reader = new FileReader(); // Crea un objeto FileReader para leer el archivo seleccionado

                // Esta función se ejecutará cuando se complete la lectura del archivo
                reader.onload = function(e) {
                    imagePreview.src = e.target
                        .result; // Establece la fuente de la imagen de vista previa con los datos del archivo cargado
                    imagePreview.style.display = 'block'; // Muestra la imagen de vista previa
                };

                // Lee el archivo seleccionado como una URL de datos (base64)
                reader.readAsDataURL(input.files[0]);
            } else {
                // Si no se selecciona un archivo, oculta la imagen de vista previa
                imagePreview.style.display = 'none';
            }
        }

        // Esta función se llama cuando se hace clic en el botón "Editar/Cancelar"
        function mostrarFormulario() {
            const formularioContainer = document.getElementById(
                'formularioContainer'); // Obtiene el contenedor del formulario
            const mostrarBoton = document.getElementById('mostrarFormulario'); // Obtiene el botón "Editar/Cancelar"

            // Comprueba si el contenedor del formulario está oculto
            if (formularioContainer.style.display === 'none') {
                formularioContainer.style.display = 'block'; // Muestra el contenedor del formulario
                mostrarBoton.textContent = 'Cancelar'; // Cambia el texto del botón a "Cancelar"
            } else {
                formularioContainer.style.display = 'none'; // Oculta el contenedor del formulario
                mostrarBoton.textContent = 'Editar Perfil'; // Cambia el texto del botón a "Editar"
            }
        }
    </script>

    <script>
        function submitForm() {
            // Simular el clic en el input de archivo para que se active el evento "onchange"
            document.getElementById('foto').click();
        }
    </script>

    <script>
        const selectImage = document.querySelector(".select-image");
        const inputFile = document.querySelector("#foto");
        const imgArea = document.querySelector(".img-area");

        selectImage.addEventListener("click", function() {
            inputFile.click();
        });

        inputFile.addEventListener("change", function() {
            const image = this.files[0];
            if (image.size < 2000000) {
                const reader = new FileReader();
                reader.onload = () => {
                    const allImg = imgArea.querySelectorAll("img");
                    allImg.forEach((item) => item.remove());
                    const imgUrl = reader.result;
                    const img = document.createElement("img");
                    img.src = imgUrl;
                    imgArea.appendChild(img);
                    imgArea.classList.add("active");
                    imgArea.dataset.img = image.name;
                };
                reader.readAsDataURL(image);
            } else {
                alert("Tamaño de imagen superior a 2MB");

            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Activar la pestaña "Crear Producto"
            function showAlert(type, icon, title, text) {
                // Mostrar el mensaje de éxito
                Swal.fire({
                    type: type,
                    icon: icon,
                    title: title,
                    text: text,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            }

            @if (session('success'))
                // Mostrar mensaje de éxito para la actualización
                showAlert('success', 'success', 'Éxito', '{{ session('success') }}');
            @elseif (session('error'))
                // Mostrar mensaje de error para la actualización
                showAlert('error', 'error', 'Error', '{{ session('error') }}');
                mostrarFormulario(); // Mostrar el formulario después del mensaje de error
            @endif
        });
    </script>

<script>
    $(document).ready(function () {
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
       $('#password, #password-confirm').on('input', function () {
           var password = $('#password').val();
           var confirmPassword = $('#password-confirm').val();
           var passwordErrors = $('#password-errors');
           var errors = [];

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

           // Validar que las contraseñas coincidan
           if (password !== confirmPassword) {
               errors.push("Las contraseñas no coinciden.");
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
@endsection
@endsection