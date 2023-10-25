@extends('layouts.index')

@section('title', 'Reportes')
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
    </style>

@stop
@section('content_header')
    <section class="section">
        <h1>Reportes</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Generar Reportes</h2>
            <br>
        <div class="row">
            <div class="col-md-3 mb-4">
                <a href="#" data-toggle="modal" data-target="#modal1" class="text-decoration-none">
                <img src="{{ asset('img/factura.png') }}"  class="rounded-circle img-thumbnail" style="max-width: 70%; height: auto;">Facturación</button>
            </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="#" data-toggle="modal" data-target="#modal2" class="text-decoration-none">
                <img src="{{ asset('img/IN.png') }}" class="rounded-circle img-thumbnail" style="max-width: 70%; height: auto;">Inventario</button>
            </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="#" data-toggle="modal" data-target="#modal3" class="text-decoration-none">
                <img src="{{ asset('img/IM.png') }}" class="rounded-circle img-thumbnail" style="max-width: 70%; height: auto;">Stock</button>
            </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="#" data-toggle="modal" data-target="#modal4" class="text-decoration-none">
                <img src="{{ asset('img/credito.jpg') }}" class="rounded-circle img-thumbnail" style="max-width: 70%; height: auto;">Crédito</button>
            </a>
            </div>
        </div>
    </div>

    <!-- Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel1">Facturación</h5>
                </div>
                <div class="modal-body">
                    <form id="modalForm1">
                        @csrf
                        <div class="form-group">
                            <label for="fechaInicio1">Fecha de inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio1" name="fechaInicio1">
                        </div>
                        <div class="form-group">
                            <label for="fechaFin1">Fecha de fin:</label>
                            <input type="date" class="form-control" id="fechaFin1" name="fechaFin1">
                        </div>
                        <div class="form-group">
                            <label for="tipoReporte1">Tipo de reporte:</label>
                            <select class="form-control" id="tipoReporte1" name="tipoReporte1">
                                <option value="opcion1">Grafico</option>
                                <option value="opcion2">Tabla</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="submitModalForm(1)">Generar Reporte</button>
                </div>
            </div>
        </div>

        
    <!-- Modal 2 -->
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel2">Modal 1</h5>
                    </div>
                    <div class="modal-body">
                        <form id="modalForm2">
                            @csrf
                            <div class="form-group">
                                <label for="fechaInicio2">Fecha de inicio:</label>
                                <input type="date" class="form-control" id="fechaInicio2" name="fechaInicio2">
                            </div>
                            <div class="form-group">
                                <label for="fechaFin2">Fecha de fin:</label>
                                <input type="date" class="form-control" id="fechaFin2" name="fechaFin2">
                            </div>
                            <div class="form-group">
                                <label for="tipoReporte1">Tipo de reporte:</label>
                                <select class="form-control" id="tipoReporte2" name="tipoReporte2">
                                    <option value="opcion1">Grafico</option>
                                    <option value="opcion2">Tabla</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="submitModalForm(2)">Generar Reporte</button>
                    </div>
                </div>
            </div>
        </div>
    

            
    <!-- Modal 3 -->

            <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel3" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel3">Modal 1</h5>
                        </div>
                        <div class="modal-body">
                            <form id="modalForm3">
                                @csrf
                                <div class="form-group">
                                    <label for="fechaInicio3">Fecha de inicio:</label>
                                    <input type="date" class="form-control" id="fechaInicio3" name="fechaInicio3">
                                </div>
                                <div class="form-group">
                                    <label for="fechaFin3">Fecha de fin:</label>
                                    <input type="date" class="form-control" id="fechaFin3" name="fechaFin3">
                                </div>
                                <div class="form-group">
                                    <label for="tipoReporte3">Tipo de reporte:</label>
                                    <select class="form-control" id="tipoReporte3" name="tipoReporte3">
                                        <option value="opcion1">Grafico</option>
                                        <option value="opcion2">Tabla</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="submitModalForm(3)">Generar Reporte</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel4" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel4">Modal 1</h5>
                        </div>
                        <div class="modal-body">
                            <form id="modalForm4">
                                @csrf
                                <div class="form-group">
                                    <label for="fechaInicio4">Fecha de inicio:</label>
                                    <input type="date" class="form-control" id="fechaInicio4" name="fechaInicio4">
                                </div>
                                <div class="form-group">
                                    <label for="fechaFin4">Fecha de fin:</label>
                                    <input type="date" class="form-control" id="fechaFin4" name="fechaFin4">
                                </div>
                                <div class="form-group">
                                    <label for="tipoReporte4">Tipo de reporte:</label>
                                    <select class="form-control" id="tipoReporte4" name="tipoReporte4">
                                        <option value="opcion1">Grafico</option>
                                        <option value="opcion2">Tabla</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="submitModalForm(4)">Generar Reporte</button>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

@endsection
@section('js')

    <script>
        function submitModalForm(modalNumber) {
            // Obtener los datos del formulario
            var fechaInicio = document.getElementById('fechaInicio' + modalNumber).value;
            var fechaFin = document.getElementById('fechaFin' + modalNumber).value;
            var tipoReporte = document.getElementById('tipoReporte' + modalNumber).value;

            // Realizar acciones con los datos, como enviarlos al servidor a través de AJAX
            console.log("Fecha de inicio: " + fechaInicio);
            console.log("Fecha de fin: " + fechaFin);
            console.log("Tipo de reporte: " + tipoReporte);

            // Cerrar el modal
            $('#modal' + modalNumber).modal('hide');
        }
    </script>
@endsection