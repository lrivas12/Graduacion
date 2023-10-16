@extends('layouts.index')

@section('title', 'Recibo')

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
        <h1> Recibo</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="overflow-auto">
                        <input type="hidden" id="detalleVenta" name="detalleVenta">
                        <div class="border border p-2">
                        <h2>Datos de venta</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id">No de Factura:</label>
                                <input type="text" class="form-control" id="id" name="id" readonly >
                            </div>
                            <div class="col-md-6">
                                <label for="fechacompra">Fecha de compra: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="fechaventa" name="fechaventa">
                            </div>
                        </div>
                        <label for="proveedor">Cliente: <span class="text-danger">*</span></label>
                        <select class="form-control" id="nombrecliente" name="nombrecliente">
                            <option value="">Seleccione al cliente</option>
                        </select>

                        <label for="proveedor">Tipo de pago: <span class="text-danger">*</span></label>
                        <select class="form-control" id="nombrecliente" name="nombrecliente">
                            <option value="">Seleccione el tipo de pago</option>
                            <option value="Contado">Contado</option>
                            <option value="Credito">Crédito</option>
                        </select>

                        <label for="nombreproducto">Nombre del Producto: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombreproducto" name="nombreproducto" placeholder="Nombre del Producto" readonly>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cantidadcompra">Cantidad:<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cantidadcompra" name="cantidadcompra" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                <div id="cantidadcompraError" style="color: red;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="nombreproducto">Precio del Producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="precioproducto" name="precioproducto" placeholder="0.00" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 ">        
                                <button type="button" class="btn btn-primary" id="btnAddProducto"> <i class="fas fa-cart-plus"></i> Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="overflow-auto">
                    <div class="card-body">
                        <div class="border border rounded p-2">
                            <div class="table-responsive">
                                <h2>Productos existentes</h2>
                                <table id="productosExistentes" class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Stock</th>
                                            <th>Agregar</th>
                                        </tr>
                                    </thead>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <br>
        <h2>Listado de venta</h2>
        <div class="card-body">
            <div class="table-responsive">

                <table id="productosVendidos" class="table table-bordered">
                    <thead class = "text-center">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoVenta" class = "text-center">
                
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Registrar Venta</button>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    
    $(document).ready(function() {
                $('#productosVendidos').DataTable({
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

    $(document).ready(function() {
                $('#productosExistentes').DataTable({
                    "language": {
                        "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                    },
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