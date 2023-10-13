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

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarProductoModal">
    <i class="fas fa-shopping-cart"></i>  Añadir Nuevo Stock
</button>
<br>
<br>
<h2>Stock de Productos</h2>
<div class="card">
    <div class="card-body">
<!-- Tabla de Compras -->
<table id="stockTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Categoría</th>
            <th>Stock Mínimo</th>
        </tr>
    </thead>
    <tbody>
        <!-- Aquí se mostrarán los productos agregados a la compra -->
    </tbody>
</table>

<!-- Modal para agregar productos -->
<div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto a la Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar productos -->
                <form id="agregarProductoForm">
                    @csrf
                    <div class="form-group">
                        <label for="producto">Buscar Producto:</label>
                        <input type="text" class="form-control" id="producto" name="producto" placeholder="Nombre del Producto">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad de Compra:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio de Compra:</label>
                        <input type="number" class="form-control" id="precio" name="precio" min="0">
                    </div>
                    <button type="button" class="btn btn-primary" id="agregarProductoBtn">Agregar a la Compra</button>
                </form>
            </div>
        </div>
    </div>
</div>
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