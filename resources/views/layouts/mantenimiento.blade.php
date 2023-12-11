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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaReporte.jpg')}}" class="img-fluid" alt="Ayuda Reporte" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

    <div class="form">
        <div class="overflow-auto">
            <div class="card">
                <section class="sectionT2">
                    <div class="header">
                        <h3><i class="fas fa-cloud-download-alt"></i> Exportar BackUp</h3>
                    </div>
                </section>
                <div class="card-body">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button class="btndownload"><i class="fas fa-cloud-download-alt"></i><br><br><label for="">
                                Descargar
                                BackUp 
                            </label></button>
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
        <div class="overflow-auto">
            <div class="card">
                <section class="sectionT2">
                    <div class="header">
                        <h3><i class="fas fa-undo"></i> Restaurar BackUp</h3>
                    </div>
                </section>
                <div class="card-body">
                    <h5><i class="fas fa-database" style="color: var(--primary);"></i> Archivo SQL</h5>
                    <div>
                        <div onload="init()">
                            <div id="drop-zone">
                                <i class="fas fa-cloud-upload-alt"></i><br>
                                <label for=""> Arrastre y suelte un archivo SQL aquí o haga clic para
                                    seleccionarlo.</label>
                            </div>
                            <br>
                            <p>Archivo seleccionado: <span id="file-name"></span></p>
                        </div>
                        <br>
                        <div class="float-right">
                            <button id="" type="submit" class="btn btn-success"><i class="fas fa-undo""></i>
                                {{ __(' Restaurar') }}
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
@endsection