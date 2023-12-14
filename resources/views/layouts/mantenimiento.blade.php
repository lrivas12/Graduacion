@extends('layouts.index')

@section('title', 'Mantenimiento')

@section('css')
    <style>
        #drop-zone {
            border: 2px dashed #ccc;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            height: 150px;
        }

        #drop-zone i {
            color: rgb(17, 0, 94);
            font-size: 50px;
            /* Tamaño del icono */
            margin-right: 5px;
            /* Espacio entre el icono y el texto */
        }

        .btndownload {
            background-color: transparent;
            border: 1px solid rgb(17, 0, 94);
            border-radius: 20px;
            /* Bordes sin redondear */
            padding: 10px 20px;
            height: 180px;
            width: 350px;
        }

        .btndownload i {
            color: rgb(17, 0, 94);
            font-size: 80px;
            /* Tamaño del icono */
            margin-right: 5px;
            /* Espacio entre el icono y el texto */
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
            background-color: rgb(17, 0, 94);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 10px;
            /* Espaciado interior */
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados */
        }
        .sectionT4 {
            background-color: rgb(17, 0, 94);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 20px;
            /* Espaciado interior */
            border-radius: 20px 20px 0 0;
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
    </style>
@stop

@section('content_header')
    <section class="sectionT">
        <h1><i class="fas fa-database"></i> Mantenimiento</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaMantenimiento.jpg')}}" class="img-fluid" alt="Ayuda Mantenimiento" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<div class="card">
    <div class="card-body">
        <section class="sectionT4">
            <div class="header">
                <h3><i class="fas fa-cloud-download-alt"></i> Generar Backup</h3>
            </div>
        </section>
        <br>
        <br>
    <div class="form-group row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="overflow-auto">
                <div class="card">
                    <section class="sectionT2">
                        <div class="header">
                            <h3><i class="fas fa-cloud-download-alt"></i> Exportar Datos a Excel</h3>
                        </div>
                    </section>
                    <div class="card-body">
                        <div class="text-center" style="display: flex; justify-content: center; align-items: center;">
                                <a href="{{-- {{ url('/exportVariosModelos') } --}}}" type="submit" class="btndownload" id="btnExportar">
                                    <br><i class="fas fa-cloud-download-alt text-primary"></i>
                                    <i class="fas fa-arrow-right"></i><i class="fas fa-file-excel text-success"></i><br><br>
                                    <label for="" class="text-primary">Descargar Datos del negocio a Excel</label>
                                </a>
                        </div>
                        <br><br>
                        <div class="card" style="background-color: rgb(242, 250, 125); font-size: 12px;">
                            <div class="card-body">
                                <div class="text-center">
                                    <img style="width: 20px; height: 20px;" src="vendor/adminlte/dist/img/warning.png"
                                        alt="">
                                    <label for="">Se exportarán todos los datos almacenados y guardados
                                        hasta el
                                        momento.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <div class="text-center">
        <h3><i class="fas fa-cloud-download-alt text-primary"></i> Exportar Tablas a Excel <i class="fas fa-file-excel text-success"></i></h3>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Descargar Datos de los Clientes</h5>
                        <a href="{{ route('exportarClientes') }}" class="btn btn-success"><i class="fas fa-address-book"></i> Tabla de Clientes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Descargar Datos de las Facturas</h5>
                        <a href="{{ url('/exportarfacturas') }}" class="btn btn-success"><i class="fas fa-file-invoice-dollar"></i> Tabla de Facturas</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Descargar Datos de las Proveedores</h5>
                        <a href="{{ url('/exportarproveedores') }}" class="btn btn-success"><i class="far fa-calendar-alt"></i> Tabla de Proveedores</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Descargar Datos de los Productos</h5>
                        <a href="{{ url('/exportarproductos') }}" class="btn btn-success"><i class="far fa-calendar-alt"></i> Tabla de Productos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br><br>
@section('js')
    <script>
        function handleFileSelect(evt) {
            evt.stopPropagation();
            evt.preventDefault();

            var file = evt.dataTransfer.files[0]; // Obtener el archivo

            if (file && file.name.endsWith('.sql')) { // Comprobar si es un archivo SQL
                document.getElementById('file-name').textContent = file.name; // Mostrar el nombre del archivo
            } else {
                alert('Por favor, seleccione un archivo SQL válido.');
            }
        }

        function handleDragOver(evt) {
            evt.stopPropagation();
            evt.preventDefault();
            evt.dataTransfer.dropEffect = 'copy'; // Efecto visual al arrastrar
        }

        function init() {
            var dropZone = document.getElementById('drop-zone');
            dropZone.addEventListener('dragover', handleDragOver, false);
            dropZone.addEventListener('drop', handleFileSelect, false);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Activar la pestaña "Crear Producto"
            function showAlert(type, icon, title, text) {
                // Mostrar el mensaje de éxito
                Swal.fire({
                    /* imageUrl: 'vendor/adminlte/dist/img/dent.png',
                    imageHeight: 100,
                    imageAlt: 'A tall image', */
                    type: type,
                    icon: icon,
                    title: title,
                    text: text,
                    showConfirmButton: false,
                    timer: 3000
                    //allowOutsideClick: false,
                });
            }

            @if (session('success'))
                // Mostrar mensaje de éxito para la creación
                showAlert('success', 'success', 'Éxito', '{{ session('success') }}');
            @elseif (session('errorS'))
                // Mostrar mensaje de error para la creación
                showAlert('error', 'error', 'Error', '{{ session('errorS') }}');
                $(document).ready(function() {
                    $('#createServicioModal').modal('show');
                });
            @endif

        });
    </script>
@endsection
@endsection