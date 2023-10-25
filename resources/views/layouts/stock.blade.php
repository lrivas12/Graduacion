@extends('layouts.index')

@section('title', 'Stock')
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
        <h1> Stock</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<div class="card">
    <div class="card-body">
            <h2>Stock de Productos</h2>
            <!-- Tabla de Compras -->
            <table id="stockTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                        <th>Stock Mínimo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                    <td>{{$producto->id}}</td>
                    <td>{{$producto->nombreproducto}}</td>
                    <td>{{$producto->cantidadproducto}}</td>
                    <td>{{$producto->categoria->nombrecategoria}}</td>
                    <td>{{$producto->stockminimo}}</td>
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
                $('#stockTable').DataTable({
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