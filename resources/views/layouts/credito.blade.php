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
        <h1> Créditos</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaCredito.jpg')}}" class="img-fluid" alt="Ayuda Credito" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

    <section class="sectionT2">
        <div class="header">
            <h3><i class="fas fa-credit-card"></i> Abonar Pago</h3>
        </div>
    </section>
    <div class="card">
        <div class="card-body">
            
            <form action="{{route('pagos.update', $pagos->id)}}" method="POST">
                @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <label for="numerocredito">N° de Crédito: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="numerocredito" id="numerocredito" value="{{$pagos->factura->id}}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="fechacredito">Fecha Crédito: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="fechacredito" id="fechacredito" value="{{$pagos->factura->fechafactura}}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="cliente">Cliente: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="cliente" id="cliente" value="{{$pagos->factura->cliente->nombrecliente}} {{$pagos->factura->cliente->apellidocliente}}" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="saldo">Monto Crédito: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">C$</span>
                                </div>
                                <input type="text" class="form-control" name="saldo" id="saldo" value="{{$pagos->factura->totalventa}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="fechacredito">Fecha Abono: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="fechadetallepago" id="fechadetallepago" value="{{ old('fechadetallepago',  date('Y-m-d')) }}"> 
                        </div>
                        <div class="col-md-4">
                            <label for="abono">Monto Abono: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">C$</span>
                                    </div>
                                <input type="text" class="form-control" name="cantidaddetallepago" id="cantidaddetallepago" >
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Agregar</button>
                    <br>
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
                                <tbody>
                                    @foreach ($detallepagos as $detallepago)
                                    <tr>
                                        <td>{{$detallepago->id}}</td>
                                        <td>{{$detallepago->fechadetallepago}}</td>
                                        <td>{{$detallepago->cantidaddetallepago}}</td>
                                        <td>{{$detallepago->saldodetallepago}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
            </form>
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

        document.addEventListener('DOMContentLoaded', function () {
        

        // Función para mostrar mensajes de SweetAlert2
        function showAlert(icon, title, text, isError, position) {
            const options = {
                position: position,
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: isError, // Mostrar el botón "OK" solo en alertas de error
                allowOutsideClick: false, // Evitar que se cierre el mensaje al hacer clic fuera del alerta
                timer: isError ? null : 2000, // Cerrar automáticamente después de 2 segundos en alertas de éxito
            };

            Swal.fire(options);
        }
    });

</script>

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

@endsection