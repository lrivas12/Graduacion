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
        <h1>Compras</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaCompraH.jpg')}}" class="img-fluid" alt="Ayuda Compra" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>


<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-shopping-cart"></i> Lista de Compras </h3>
    </div>
    </section>

<div class="containe-fluid">
        <div class="card" {{-- style="border: 1px solid black;" --}}>
            <div class="card-header">
                <strong>

                    <a  href="{{ route('compras.create') }}"  type="button">
                        <i class="fas fa-plus fa-lg text-info" ></i>
                    </a>  
                </strong>
            </div>
            <div class="overflow-auto">
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered" id="listaCompra">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($compra as $compra)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$compra->proveedor->razonsocialproveedor}}</td>
                                <td>{{ \Carbon\Carbon::parse ($compra->fechacompra)->format('d/m/Y')}}</td>
                                <td>{{ number_format($compra->totalcompra, 2, '.', ',')}}</td>
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
