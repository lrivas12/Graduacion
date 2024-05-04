@extends('layouts.index')

@section('title', 'Usuarios')

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

        .imguser img{
            height: 50px;
            width: 50px;
        }
    </style>

@stop

@section('content_header')
    <section class="section">
        <h1><i class="fa fa-user-circle"></i> Usuarios</h1>
        <i class="btn far fa-question-circle" title="Ayuda" data-toggle="modal" data-target="#myModal"></i>
    </section>
    <hr class="my-2" />
@stop


@section('content')

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content d-flex align-items-center" style="max-width: 100%; height: auto;">
        
        <!-- Contenido del modal -->
        <div class="modal-body">
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaUsuario.jpg')}}" class="img-fluid" alt="Ayuda Usuario" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-user-plus"></i> Generar  Usuarios </h3>
    </div>
</section>
<div class="card">
        <div class="col-md-15x">
        <div class="card-body">
    <a id="userModalBtn" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal" data-whatever="@mdo">
        <i class="fas fa-user-plus"></i> Crear
        Usuario</a><br><br>

                <h3>Listado de Usuarios</h3>
                <div class="table-responsive">
                    <table id="userTable" class="table table-hover table-bordered ">
                        <thead class="thead-blue text-center">
                            <tr>
                                <th>Id</th>
                                <th>Fotografía</th>
                                <th>Usuario</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="imguser">
                                        @if ($user->foto)
                                            <img src="{{ asset('storage/usuarios/'. $user->foto) }}"
                                                style="max-width: 50px; border-radius: 50%;">
                                        @else
                                            <img src="{{ asset('storage/usuarios/PlaceholderUser.jpg') }}"
                                                alt="Imagen por defecto">
                                    </td>
                            @endif
                            </td>
                            <td>{{ $user->usuario }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->privilegios }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" title="Editar Usuario" class="btn btn-link" data-toggle="modal"
                                        data-target="#editUserModal{{ $user->id }}">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <a>
                                       
                                        <form method="POST" action="{{ route('usuario.desactivate', ['id' => $user->id]) }}">
                                            @csrf
                                            @if ($user->estado == 1)
                                                <input type="hidden" name="estado" value="0">
                                                <button type="submit" title="Desactivar Usuario" class="btn btn-link"><i
                                                        class="fas fa-user-check text-success"></i></button>
                                            @else
                                                <input type="hidden" name="estado" value="1">
                                                <button type="submit" title="Activar Usuario" class="btn btn-link"><i
                                                        class="fas fa-user-minus text-danger"></i></button>
                                            @endif
                                        </form>
                                    </a>
                                </div>

                            </td>
                            </tr>

                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Editar Usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('usuario.update', $user->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <label style="font-style: italic; ">
                                                    Los campos marcados con  <span style=" color: red;">*</span> son obligatorios</span>
                                                </label>
                                                @method('PUT')

                                                <div class="form-group row">
                                                    <label for="photo"
                                                        class="col-md-4 col-form-label text-md-right">Fotografía:</label>
                                                    <br>

                                                    <div class="col-md-6">
                                                        @if ($user->foto)
                                                            <div class="current-image">
                                                                <img src="{{ asset('storage/usuarios/' . $user->foto) }}"
                                                                    alt="Vista previa de "
                                                                    style="display: none; max-width: 100px; border-radius: 50%;">
                                                            </div>
                                                        @else
                                                            <p>No hay imagen</p>
                                                        @endif
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="file"
                                                                class="form-control-file @error('foto') is-invalid @enderror"
                                                                name="foto" id="foto" accept="image/*"
                                                                onchange="previewImage(event)">
                                                            <br>
                                                        </div>

                                                        @error('foto')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="usuario"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Usuario:') }} <span class="text-danger">*</span></label>

                                                    <div class="col-md-6">
                                                        <input id="usuario" type="text"
                                                            class="form-control @error('usuario') is-invalid @enderror"
                                                            name="usuario" value="{{ old('usuario', $user->usuario) }}"
                                                            required autocomplete="usuario" autofocus>

                                                        @error('usuario')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico:') }} <span class="text-danger">*</span></label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email', $user->email) }}"
                                                            required autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="rol"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Rol:') }} <span class="text-danger">*</span></label>

                                                    <div class="col-md-6">
                                                        <select id="privilegios"
                                                            class="form-control @error('privilegios') is-invalid @enderror"
                                                            name="privilegios" required autocomplete="privilegios">
                                                            <option
                                                                value="Administrador"{{ old('privilegios', $user->privilegios) === 'Administrador' ? ' selected' : '' }}>
                                                                Administrador</option>
                                                            <option
                                                                value="Editor"{{ old('privilegios', $user->privilegios) === 'Editor' ? ' selected' : '' }}>
                                                                Editor</option>
                                                                <option
                                                                value="Vendedor"{{ old('privilegios', $user->privilegios) === 'Vendedor' ? ' selected' : '' }}>
                                                                Vendedor</option>
                                                        </select>
                                                        @error('privilegios')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @php
                                                    $AuthUser = App\Models\User::findOrFail(auth()->id());
                                                @endphp 
                                                @if ($AuthUser->id != $user->id)     
                                                    <div class="form-group row">
                                                        <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}<span class="text-danger">*</span></label>
                                                        <div class="col-md-6">
                                                            <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required autocomplete="estado">
                                                                <option value="1"{{ old('estado', $user->estado) ? ' selected' : '' }}>Activo</option>
                                                                <option value="0"{{ !old('estado', $user->estado) ? ' selected' : '' }}>Inactivo</option>
                                                            </select>
                                                            @error('estadousuario')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }} <span class="text-danger">*</span></label>

                                                    <div class="col-md-6 input-group">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" autocomplete="new-password">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn" title="Mostrar contraseña">
                                                                    <i class="fa fa-eye"></i> 
                                                                </button>
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
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña:') }} <span class="text-danger">*</span></label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control"
                                                            name="password_confirm" autocomplete="new-password">
                                                            
                                                    </div>
                                                    <div id="password-errors" class="col-md-6 offset-md-4"></div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button id="usereditado" type="submit" class="btn btn-primary">
                                                        {{ __('Actualizar') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus"></i> Nuevo Usuario</h5>
                    <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('usuario.store') }}" enctype="multipart/form-data">

                        @csrf
                        <label style="font-style: italic; ">
                            Los campos marcados con  <span style=" color: red;">*</span> son obligatorios</span>
                        </label>
                        
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Fotografía</label>
                            <br>
                            <div class="col-md-6">

                                <img id="photoPreview" src="" alt="Vista previa de la foto de perfil"
                                    style="display: none; max-width: 100px; border-radius: 50%;">
                                <br>
                                <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                                    name="foto" id="foto" accept="image/*" onchange="previewImage(event)">
                                <br>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="usuario"
                                class="col-md-4 col-form-label text-md-right">{{ __('Usuario:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="usuario" type="text"
                                    class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                                    value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>


                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="privilegios"
                                class="col-md-4 col-form-label text-md-right">{{ __('Rol:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="seleccion" class="form-control @error('privilegios') is-invalid @enderror"
                                    name="privilegios" required onchange="mostrarMiniFormulario()">
                                    <option value="">---Selecciona un Rol---</option>
                                    <option value="Administrador"
                                        {{ old('privilegios') === 'Administrador' ? ' selected' : '' }}>
                                        Administrador
                                    </option>
                                    <option value="Editor" {{ old('privilegios') === 'Editor' ? ' selected' : '' }}>
                                        Editor
                                    </option>
                                    <option value="Vendedor" {{ old('privilegios') === 'Vendedor' ? ' selected' : '' }}>
                                        Vendedor
                                    </option>
                                </select>

                                @error('privilegios')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="estado"
                                class="col-md-4 col-form-label text-md-right">{{ __('Estado:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="estado" class="form-control @error('estado') is-invalid @enderror"
                                    name="estado" required>
                                    <option value="1"{{ old('estado') === 'Activo' ? ' selected' : '' }}>Activo
                                    </option>
                                    <option value="0"{{ old('estado') === 'Inactivo' ? ' selected' : '' }}>Inactivo
                                    </option>

                                </select>

                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwordE"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6 input-group">
                                <input id="passwordE" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="passwordE" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="showPasswordBtnE" title="Mostrar contraseña">
                                            <i class="fa fa-eye"></i> 
                                        </button>
                                    </div>                                                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-co"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña:') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirmE" type="password" class="form-control"
                                    name="password_confirmE" autocomplete="new-password">
                                    
                            </div>
                            <div id="password-errorsE" class="col-md-6 offset-md-4"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="	far fa-window-close"></i> Cancelar</button>
                            <button id="usercreate" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                {{ __(' Registrar') }}
                            </button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


@section('js')
    
    
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
                    console.log("con" + password, "confir" + confirmPassword);
                    errors.push("Las contraseñas no coinciden.");
                }

                // Mostrar los mensajes de error
                if (errors.length > 0) {
                    passwordErrors.html('<ul class="text-danger"><li>' + errors.join('</li><li>') + '</li></ul>');
                } else {
                    passwordErrors.html('');
                }
            });

            $('#showPasswordBtnE').click(function () {
                var passwordFieldsE = $('#passwordE, #password-confirmE');
                var passwordFieldTypeE = passwordFieldsE.attr('type');
                if (passwordFieldTypeE === 'password') {
                    passwordFieldsE.attr('type', 'text');
                    $(this).html('<i class="fa fa-eye-slash"></i>');
                } else {
                    passwordFieldsE.attr('type', 'password');
                    $(this).html('<i class="fa fa-eye"></i>');
                }
            });

            // Validación de contraseña segura
            $('#passwordE, #password-confirmE').on('input', function () {
                var passwordE = $('#passwordE').val();
                var confirmPasswordE = $('#password-confirmE').val();
                var passwordErrorsE = $('#password-errorsE');
                var errorsE = [];

                // Validar longitud mínima
                if (passwordE.length < 8) {
                    errorsE.push("La contraseña debe tener al menos 8 caracteres.");
                }

                // Validar al menos un número
                if (!/\d/.test(passwordE)) {
                    errorsE.push("La contraseña debe contener al menos un número.");
                }

                // Validar al menos una letra mayúscula
                if (!/[A-Z]/.test(passwordE)) {
                    errorsE.push("La contraseña debe contener al menos una letra mayúscula.");
                }

                // Validar al menos un carácter especial
                if (!/[\W_]/.test(passwordE)) {
                    errorsE.push("La contraseña debe contener al menos un carácter especial.");
                }

                // Validar que las contraseñas coincidan
                if (passwordE !== confirmPasswordE) {
                    console.log("con" + passwordE, "confir" + confirmPasswordE);

                    errorsE.push("Las contraseñas no coinciden.");
                    console.log(errorsE);
                }

                // Mostrar los mensajes de error
                if (errorsE.length > 0) {
                    passwordErrorsE.html('<ul class="text-danger"><li>' + errorsE.join('</li><li>') + '</li></ul>');
                } else {
                    passwordErrorsE.html('');
                }
            });
        });
    


        document.addEventListener("DOMContentLoaded", function() {
            // Activar la pestaña "Crear Producto"
            function showAlert(icon, title, text) {
                // Mostrar el mensaje de éxito
                Swal.fire({
                    imageUrl: 'vendor/adminlte/dist/img/PlaceholderUser.jpg',
                    imageHeight: 100,
                    imageAlt: 'A tall image',
                    title: title,
                    text: text,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            }

            @if (session('successC'))
                // Mostrar mensaje de éxito para la creación
                showAlert('success', 'Éxito', '{{ session('successC') }}');
            @elseif (session('errorC'))
                // Mostrar mensaje de error para la creación
                showAlert('error', 'Error', '{{ session('errorC') }}');
                $(document).ready(function() {
                    $('#createUserModal').modal('show');
                });
            @endif

            @if (session('success'))
                // Mostrar mensaje de éxito para la actualización
                showAlert('success', 'Éxito', '{{ session('success') }}');
            @elseif (session('error'))
                // Mostrar mensaje de error para la actualización
                showAlert('error', 'Error', '{{ session('error') }}');
                @foreach ($users as $user)
                    @if (session('error_id') == $user->id)
                        $(document).ready(function() {
                            $('#editUserModal{{ $user->id }}').modal('show');
                        });
                    @endif
                @endforeach
            @endif
        });

        function previewImage(event) {
            const input = event.target;
            const imagePreview = document.getElementById('photoPreview');


            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        }

        $(document).ready(function() {
            $('#userTable').DataTable({
                "language": {
                    "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                },
                responsive: "true",
                dom: 'Bfrtilp',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"> Exportar a Excel</i>',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"> Imprimir Tabla</i>',
                        className: 'btn btn-info'
                    },
                ]
            });
        });
    </script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
@stop
@endsection