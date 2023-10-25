@extends('layouts.index')

@section('title', 'Credito')

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
        <h1> Créditos</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h2>Datos del crédito</h2>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="codigo">No de Crédito: </label>
                    <input type="text" class="form-control" id="creditCode" name="creditCode" value="" readonly>
                </div>
                <div class="col-md-4">
                    <label for="fecha">Fecha de Abono:</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" readonly>
                </div>
                <div class="col-md-4">
                    <label for="monto">Monto a Abonar: </label>
                    <div class="input-group-prepend">
                    <span class="input-group-text">C$</span>
                    <input type="number" step=".01" min="0.01" id="monto" name="monto">
                </div>
                </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-md-4">
                        <label for="cliente">Cliente: </label>
                        <select class="form-control" name="cliente" id="cliente">
                            <option value="">Seleccionar Cliente</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="saldo">Total pendiente: </label>
                        <div class="input-group-prepend">
                        <span class="input-group-text">C$</span>
                        <input type="text" id="totalpendiente" name="totalpendiente" readonly> 
                    </div>
                    </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 mt-2 ">
                    <button type="button" class="btn btn-primary" id="btnAddProducto"> <i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
            <br>
            <h2>Pagos Abonados</h2>
            <br>

            <table id="pagosExistentes" class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Pagos</th>
                        <th>Saldo Pendiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection

@section('js')

<script>
    $(document).ready(function() {
                $('#pagosExistentes').DataTable({
                    "language": {
                        "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                    },
                dom:'Bfrtilp',
                    buttons:[{
                        extend:'print',
                        text: '<i class="fas fa-print"> Imprimir</i>',
                        className:'btn btn-info'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"> Exportar a Excel</i>',
                        className: 'btn btn-success'
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

@endsection