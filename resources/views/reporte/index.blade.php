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
        .btnreport{
            background-color: transparent;
            border-radius: 20%;
            width: 250px;
            height: 270px;
        }
        .btnreport img{
            border-radius: 20%;
            width: 230px;
            height: 250px;
        }
        .sectionR{
            background-color: rgb(17, 0, 94);
            border-radius: 10px 10px 0 0;
        }
        .sectionR h3{
            color: white;
        }
    </style>

@stop
@section('content_header')
    <section class="section">
        <h1> Reportes</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')
    <div class="card">
        <section class="sectionR"><h3><i class="fas fa-print"></i> Generar Reporte</h3></section>
        <div class="card-body">

            <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId" type="button"><img src="vendor/adminlte/dist/img/factura.png" alt=""></button>
                            <h3>Ventas</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId2" type="button"><img src="vendor/adminlte/dist/img/IM.png" alt=""></button>
                            
                            <h3>Inventario</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId3" type="button"><img src="vendor/adminlte/dist/img/credito.jpg" alt=""></button>
                            
                            <h3>Crédito</h3>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Facturación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md 3">
                            <label for="fechainicio">Fecha Inicio:</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="fechafin">Fecha Fin:</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="" class="form-control" id="">
                        <option value="">Seleccione el reporte</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close	"></i> Close</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Inventario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="" class="form-control" id="">
                        <option value="">Seleccione el reporte</option>
                        <option value="inventario_general">Productos Existentes</option>
                        <option value="proximos_agotarse">Productos a Agotarse</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close	"></i> Close</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId3" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Control de Crédito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="" class="form-control" id="">
                        <option value="">Seleccione el reporte</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close	"></i> Close</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


@endsection