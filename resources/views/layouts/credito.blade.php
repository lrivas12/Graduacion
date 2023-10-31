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
                <div class="col-md-3">
                    <label for="numerocredito">N° de Crédito: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="numerocredito" id="numerocredito" readonly>
                </div>
                <div class="col-md-3">
                    <label for="fechacredito">Fecha Crédito: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="fechacredito" id="fechacredito" readonly>
                </div>
                <div class="col-md-3">
                    <label for="cliente">Cliente: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="cliente" id="cliente" readonly>
                </div>
                <div class="col-md-3">
                    <label for="saldo">Monto Crédito: <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">C$</span>
                        </div>
                    <input type="text" class="form-control" name="saldo" id="saldo" readonly>
                </div>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="col-md-4">
                <label for="fechacredito">Fecha Abono: <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="fechacredito" id="fechacredito" > 
            </div>
            <div class="col-md-4">
                <label for="abono">Monto Abono: <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">C$</span>
                        </div>
                    <input type="text" class="form-control" name="saldo" id="abono" >
                </div>
            </div>
            <div class="col-md-4">
                <label for="total">Saldo Pendiente: <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">C$</span>
                    </div>
                <input type="text" class="form-control" name="total" id="total" readonly>
            </div>
        </div>
    </div>            
            <br>
            <h2>Pagos Abonados</h2>
            <br>

            <table id="pagosExistentes" class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Fecha Abono</th>
                        <th>Pagos</th>
                        <th>Saldo Pendiente</th>
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