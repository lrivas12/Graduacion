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
        <h1>Ver Créditos</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-credit-card"></i> Historial de Pago</h3>
    </div>
</section>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table table-bordered" id="listacredito">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Monto de crédito</th>
                        <th>Saldo Pendiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pago->fechapago}}</td>
                        <td>{{$pago->factura->cliente->nombrecliente}} {{$pago->factura->cliente->apellidocliente}}</td> 
                        <td>C$ {{ $pago->factura->totalventa}}</td>
                        <td>C$ {{ number_format($pago->cantidadpago - $pago->detallepago->sum('cantidaddetallepago'), 2, '.', ',')}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a  href ="{{ route('pagos.edit', $pago->id)}}"  title="Abonar">
                                    <i class="fab fa-algolia fa-lg text-success" > Abonar</i>
                                </a> 
                            </div>
                        </td> 
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
            
                $(document).ready(function() {
                $('#listacredito').DataTable({
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