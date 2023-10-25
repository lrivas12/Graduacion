@extends('layouts.index')

@section('title', 'Compras')
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
        <h1>Mostar Compras</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')
<div class="containe-fluid">
        <div class="card" style="border: 1px solid black;">
            <div class="card-header">
                <strong>Listado de compras &nbsp;&nbsp;&nbsp;

                    <a  href="{{ route('compras.create') }}"  type="button">
                        <i class="fas fa-plus fa-lg text-info" ></i>
                    </a>  
                </strong>
            </div>
            <div class="overflow-auto">
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered" id="listaCompra">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compra as $compra)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$compra->proveedor->razonsocialproveedor}}</td>
                                <td>{{$compra->fechacompra}}</td>
                                <td>{{$compra->totalcompra}}</td>
                                <td>
                                    <!-- Los botones para desactivar o activar aparecen según el estado almacenado en la base de datos -->
                                    <div class="d-flex align-items-center">
                                        <a  href ="{{ route('compras.show', $compra->id)}}" style="margin-right: 10px;" title="Visualizar compra">
                                            <i class="fas fa-eye fa-lg text-warning" ></i>
                                        </a> 
                                        <a href="{{route('compras.edit', $compra->id)}}" title= "Editar compra"> 
                                            <i class="fas fa-pencil-alt text-success" ></i>
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
        </div>
    </div>
@endsection

@section('js')

<script>
    $(document).ready(function() {
                $('#listaCompra').DataTable({
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
