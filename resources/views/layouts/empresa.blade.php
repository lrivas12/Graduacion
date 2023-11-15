@extends('layouts.index')

@section('title', 'Empresa')

@section('css')
    <style>
        .hidden {
            display: none;
            animation: slideDown 0.5s ease-in-out;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .section {
            display: flex;
            justify-content: flex-end;
        }

        .section1 {
            display: flex;
            justify-content: center;
        }

        .form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }

        .fa-question-circle {
            font-size: 27px;
        }

        .sectionT {
            display: flex;
            justify-content: space-between;
        }

        .sectionT2 {
            background-color: var(--primary);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 10px;
            /* Espaciado interior */
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados */
        }

        .header {
            display: flex;
            /* Mostrar elementos en línea */
            align-items: center;
            /* Centrar verticalmente */
            justify-content: space-between;
            /* Espacio entre elementos */
        }

        .header label {
            margin-right: 10px;
            /* Espacio entre la etiqueta y el input de fecha */
        }

        .card {
            border: none;
            /* Eliminar bordes de la card */
            border-radius: 10px;
            /* Bordes redondeados */
            margin: 0;
            /* Eliminar márgenes */
            box-shadow: none;
            /* Eliminar sombra */
        }

        .overflow-auto {
            overflow: hidden;
            /* Ocultar desbordamiento */
        }

        .sectionT3 {
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
    @foreach ($empresas as $emp)
        <section class="sectionT">
                <h1><i class="fas fa-store"></i> {{$emp->nombreempresa}}</h1>
                <i class="btn far fa-question-circle" title="Ayuda"></i>
        </section>
        <hr class="my-2" />
   
@stop


@section('content')
<section class="sectionT3">
    <div class="header">
        <h3><i class="fas fa-store"></i> Información del negocio </h3>
    </div>
    </section>
        <div class="card">
            <div class="overflow-auto">
                <div class="card-body">
                    <br>
                    <div class="text-center">
                        @if ($emp->logo)
                            <div class="form-group">
                                <img src="{{ asset($emp->logo) }}" alt="Logo de la empresa" style="max-width: 300px;">
                            </div>
                        @endif 
                        <br>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-store"></i> Nombre del negocio:</h3>
                                <h4>{{$emp->nombreempresa}}</h4>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <h3><i class="fas fa-id-badge"></i> N° RUC del negocio:</h3>
                                <h4>{{$emp->rucempresa}}</h4>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-phone-alt"></i> Contacto del negocio:</h3>
                                <h4>{{$emp->contactoempresa}}</h4>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <h3><i class="far fa-address-card"></i> Dirección del negocio:</h3>
                                <h4>{{$emp->direccionempresa}}</h4>
                            </div>
                        </div>
                        <br>
                        <button id="updateButton" class="btn btn-warning btn1" onclick="mostrarFormulario()"><i
                                class="fas fa-edit"></i>
                            Actualizar
                            Datos del negocio</button>
                    </div>
                </div>
            </div>
        </div>
    <br>
    @endforeach
    <div class="card">
        <div class="overflow-auto">
            <div class="card-body hidden" id="updateFormCard" style="display:none">
                <div class="text-center">
                    <h3>Datos de la Empresa</h3>
                </div>
                <br>
                <form method="POST" action="{{ route('empresa.update', $emp->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="logo">{{ __('Logo Actual') }}</label><br>
                            @if ($emp->logo)
                                <img src="{{ asset($emp->logo) }}" alt="Logo actual de la empresa"
                                    style="max-width: 200px;"><br>
                            @else
                                <p>No hay logo actual</p>
                            @endif
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label for="logo">{{ __('Nuevo Logo') }}</label>
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                                name="logo" onchange="previewLogo(this);">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="col-md-6">
                            <span class="text-danger">*</span><label
                                for="nombreempresa">{{ __('Nombre de la empresa: ') }}</label>
                            <input id="nombreempresa" type="text"
                                class="form-control @error('nombreempresa') is-invalid @enderror" name="nombreempresa"
                                value="{{ old('nombreempresa', $emp->nombreempresa) }}" required
                                autocomplete="nombreempresa" autofocus>
                            @error('nombreempresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>

                        <div class="col-md-6">
                            <span class="text-danger">*</span><label for="rucempresa">{{ __('N° RUC: ') }}</label>
                            <input id="rucempresa" type="text"
                                class="form-control @error('rucempresa') is-invalid @enderror" name="rucempresa"
                                value="{{ old('rucempresa', $emp->rucempresa) }}" required autocomplete="rucempresa">
                            @error('rucempresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>

                        <div class="col-md-6">
                            <span class="text-danger">*</span><label for="contactoempresa">{{ __('Contacto: ') }}</label>
                            <input id="contactoempresa" type="text"
                                class="form-control @error('contactoempresa') is-invalid @enderror" name="contactoempresa"
                                value="{{ old('contactoempresa', $emp->contactoempresa) }}" required
                                autocomplete="contactoempresa">
                            @error('contactoempresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <br>
                        <div class="col-md-6">
                            <label for="direccionempresa">{{ __('Dirección: ') }}</label>
                            <input id="direccionempresa" type="text"
                                class="form-control @error('direccionempresa') is-invalid @enderror" name="direccionempresa"
                                value="{{ old('direccionempresa', $emp->direccionempresa) }}" required
                                autocomplete="direccionempresa">
                            @error('direccionempresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                    </div>
                    <div class="float-right">
                        <button id="" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            {{ __(' Guardar Cambios') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
@endsection

@section('js')
    <script>
        // Esta función se llama cuando se hace clic en el botón "Editar/Cancelar"
        function mostrarFormulario() {
            const formularioContainer = document.getElementById(
                'updateFormCard'); // Obtiene el contenedor del formulario
            const mostrarBoton = document.getElementById('updateButton'); // Obtiene el botón "Editar/Cancelar"

            // Comprueba si el contenedor del formulario está oculto
            if (formularioContainer.style.display === 'none') {
                formularioContainer.style.display = 'block'; // Muestra el contenedor del formulario
                mostrarBoton.textContent = 'Cancelar'; // Cambia el texto del botón a "Cancelar"
            } else {
                formularioContainer.style.display = 'none'; // Oculta el contenedor del formulario
                mostrarBoton.textContent = 'Actualizar Datos de la neogocio'; // Cambia el texto del botón a "Editar"
            }
        }

        function previewLogo(input) {
            var reader = new FileReader();
            var logoPreview = $('#logo_preview');
            reader.onload = function(e) {
                logoPreview.attr('src', e.target.result).css('display', 'block');
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para mostrar mensajes de SweetAlert2
            function showAlert(type, icon, title, text, isError) {
                const options = {
                    type: type,
                    icon: icon,
                    title: title,
                    text: text,
                    showConfirmButton: isError, // Mostrar el botón "OK" solo en alertas de error
                    allowOutsideClick: false, // Evitar que se cierre el mensaje al hacer clic fuera del alerta
                    timer: isError ? null :
                    3000, // Cerrar automáticamente después de 2 segundos en alertas de éxito
                };

                Swal.fire(options);
            }

            // Mostrar mensaje de éxito o error si existe
            @if (session('successC'))
                showAlert('success', 'success', 'Clínica Actualizada', '{{ session('successC') }}', false);
            @elseif (session('errorC'))
                showAlert('error', 'error', 'Error', '{{ session('errorC') }}', true);
            @endif
        });
    </script>
@endsection
