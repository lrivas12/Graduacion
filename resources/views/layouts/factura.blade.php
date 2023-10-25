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
            <form method="POST" action="{{route('factura.store')}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="overflow-auto">
                        @csrf
                        @php
                        $ultimoNumeroVenta = DB::table('facturas')->max('id');   
                        // 2. Incrementar el número de venta en uno
                        $nuevoNumeroVenta = $ultimoNumeroVenta + 1;
                    @endphp
                        <input type="hidden" id="detalleVenta" name="detalleVenta">
                        <div class="border border p-2">
                        <h2>Datos de venta</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nuevoNumeroVenta">N° de Factura:</label>
                                <input type="text" class="form-control" id="nuevoNumeroVenta" name="nuevoNumeroVenta"  value="{{ $nuevoNumeroVenta }}" readonly >
                            </div>
                            <div class="col-md-6">
                                <label for="fechaventa">Fecha de venta: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="fechaventa" name="fechaventa" value="{{ old('fechaventa',  date('Y-m-d')) }}"  >
                            </div>
                        </div>
                        <label for="tipoventa">Tipo de venta: <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipoventa" name="tipoventa">
                            <option value="">Seleccione el tipo de pago</option>
                            <option value="Contado" {{old('tipoventa') == 'contado' ? 'selected' : ''}}>Contado</option>
                            <option value="Credito"{{old('tipoventa') == 'credito' ? 'selected' : '' }}>Crédito</option>
                        </select>
                        <label for="cliente">Cliente: <span class="text-danger">*</span></label>
                        <select class="form-control" id="cliente_id" name="cliente_id" required>
                            <option value="{{old('clientes_id')}}">Seleccione al cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombrecliente }} {{ $cliente->apellidocliente }}</option>
                        @endforeach
                        </select>
                        <label for="clienteSeleccionado"></label>
                        <input id="clienteSeleccionado" type="text" class="form-control" readonly style="display: none;">
                        <label for="deuda">Deuda: </label>
                        <input id="deuda" name="deuda" type="text" class="form-control" readonly>
                        <label for="nombreproducto">Nombre del Producto: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombreproducto" name="nombreproducto" placeholder="Nombre del Producto" readonly>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cantidadventa">Cantidad: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cantidadventa" name="cantidadventa" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                <div id="cantidadcompraError" style="color: red;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="precioproducto">Precio del Producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="precioproducto" name="precioproducto" placeholder="0.00" readonly>   
                            </div>
                            <div class="col-md-6" id="descuentoinput" style="display: none">
                                <label for="descuentoventa">Descuento:</label>
                                <input type="text" class="form-control" id="descuentoventa" name="descuentoventa" step="0.01" min="0" oninput="this.value = Math.abs(this.value);">>
                            </div>
                            <div class="col-md-8" id="detalleVentaTipoCredito"  style="display: none" >
                                <div class="row" >
                                    <div class="col-md-6">
                                        <label for="adelanto">Adelanto:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CS</span>
                                                
                                            </div>
                                            <input type="number" step="0.01" min="0"
                                            class="form-control" id="adelanto"
                                            name="adelanto" value="{{ old('adelanto', '0')}}" 
                                            oninput="this.value = Math.abs(this.value);">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="saldo">Saldo pendiente:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">C$</span>
                                            </div>
                                            <input type="number" class="form-control" value="{{ old('saldo', '0')}}" id="saldo" name="saldo" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 ">        
                                <button type="button" class="btn btn-primary" id="btnAdd"> <i class="fas fa-cart-plus"></i> Agregar</button>
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
                                            <th>Existencia</th>
                                            <th>Stock</th>
                                            <th>Agregar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @foreach ($productos as $producto)
                                        <td>{{$loop->iteration}}</td> 
                                        <td>{{$producto->nombreproducto }}</td>
                                        <td>{{$producto->cantidadproducto}}</td>
                                        <td>{{$producto->stockminimo}}</td>
                                        <td>
                                            <button type="button" class="btn btn-link" id="btnAddProducto" cod="{{$producto->id}}">
                                                <i class="fas fa-shopping-cart text-success"></i>
                                            </button>
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
         </form>
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

            // Mostrar mensaje de éxito o error si existe
        @if(session('successC'))
            showAlert('success', 'Éxito', '{{ session('successC') }}', false, 'top-end');
        @elseif (session('errorC'))
            showAlert('error', 'Error', '{{ session('errorC') }}', true, 'top-center');
        @endif
    });
    $(document).ready(function () {
            // Al hacer clic en el botón "Seleccionar"
            $("#seleccionarCliente").click(function () {
                // Obtener los valores seleccionados
                const selectedCliente = $("#clientes_id option:selected").val();
                const selectedClienteT = $("#clientes_id option:selected").text();
                tipoVenta = $("#tipoventa").val();
                Comprobar si se seleccionó un cliente, tipo de venta y ruta
                if (selectedCliente.trim() === "" || tipoVenta.trim() === "")
                {
                    // Mostrar un mensaje de error específico
                    let errorMessage = "";
                    if (selectedCliente.trim() === "") {
                        errorMessage = "Debe seleccionar un cliente.";
                    } else if (tipoVenta.trim() === "") {
                        errorMessage = "Debe seleccionar el tipo de venta.";
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    });
                } else{
                    if(selectedCliente.trim() !== "" && tipoVenta.trim()!== "") $("#clienteSeleccionado").val(selectedClienteT);
                        
                        // Ocultar el campo cliente_id y mostrar el campo de texto
                        $("#clientes_id").hide();
                        $("#clienteSeleccionado").show();
                    
                    }
            });    
        });
        var tablaDatos = [];
    var stock, pago, saldo,tipoVenta, totalConDescuento = 0, descuento = 0;

    $("#productosExistentes").on("click","#btnAdd",function(){
            
            let id = $(this).attr("cod");
            //Peticion al servidor con el id
            fetch('http://motoflor.com/api/compras/'+id)
        
            .then(x => {return x.json()})
            .then(x => {
                console.log(x);
                $("#nombreproducto").attr("key", x.id);
                $("#nombreproducto").val(x.nombreproducto);
                $("#precioproducto").val(x.precioproducto);
            
            });
        })
        
        $("#btnAddProducto").click(function(){
                
                let id = $("#nombreproducto").attr("key");
                let nombreproducto = $("#nombreproducto").val();
                let cantidadventa = $("#cantidadventa").val();
                let precioproducto = $("#precioproducto").val();
                
                let subtotal = parseFloat(cantidadventa) * parseFloat(precioproducto);
                
                if (!id || id.trim() === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text:'Debes seleccionar al menos un producto antes de guardar la compra.',
                        allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                        showCancelButton: false, // No mostrar el botón de cancelar
                        confirmButtonText: 'OK' // Personaliza el texto del botón "OK"
                    });
                    return;
                    
                }
                if(cantidadventa <= 0 || precioproducto <= 0)
                {
                    $("#cantidadventaError").html("La cantidad debe ser mayor que cero");
                    $("#precioproductoError").html("El costo debe ser mayor que cero");
                    return;
                }

                /* if(precioproducto > 0)
                {
                    $("#precioproductoError").html("El precio de venta no puede ir vacío");
                    return;
                } */

                // Agrega la condición para verificar que los precios de venta sean mayores que el costo
                if (parseFloat(precioproducto) <= parseFloat(costocompra) ) {
                    $("#precioproductoError").html("El precio de venta deben ser mayores que el costo de compra");
                    return;
                }
                // Agrega una validación para asegurarte de que se haya seleccionado al menos un producto
            
                let datos = {
                    id,
                    nombreproducto,
                    cantidadventa,
                    precioproducto,
                    subtotal
                }
                //Busca el indice del arreglo para sustituirlo
                let indice = tablaDatos.findIndex(objeto => objeto.id === id);
                //console.log(indice);
                if (indice == -1) { //sino el indice lo agrega
                    tablaDatos.push(datos);
                }else{
                    tablaDatos[indice] = datos; // si existe lo sustituye
                }
                showTable();// Muestra la tabla actualizada

                //vacia las cajas de texto
                    $("#nombreproducto").attr("key", "");
                    $("#nombreproducto").val("");
                    $("#precioproducto").val("");
                    $("#cantidadventa").val("");
                    $("#cantidadventaError").html("");
                    $("#precioVentaError").html("");
                

            });

            $(document).ready(function() {
        // Inicializar variables
        var productosVendidos = [];
        var contadorVenta = 1;

        // Evento para agregar un producto a la venta
        $("#btnAdd").on("click", function() {
            var nombreproducto = $("#nombreproducto").val();
            var cantidadventa = $("#cantidadventa").val();
            var precioproducto = $("#precioproducto").val();
            var descuentoventa = $("#descuentoventa").val();
            var adelanto = $("#adelanto").val();
            var saldo = $("#saldo").val();

            // Realizar cálculos y agregar a la lista de productos vendidos
            var subtotal = cantidadventa * precioproducto;
            var productoVendido = {
                id: contadorVenta,
                nombreproducto: nombreproducto,
                cantidadventa: cantidadventa,
                precioproducto: precioproducto,
                descuentoventa: descuentoventa,
                adelanto: adelanto,
                saldo: saldo,
                subtotal: subtotal
            };

            productosVendidos.push(productoVendido);
            contadorVenta++;

            // Actualizar la tabla de productos vendidos
            actualizarTablaProductosVendidos();
        });

        // Función para actualizar la tabla de productos vendidos
        function actualizarTablaProductosVendidos() {
            var cuerpoVenta = $("#cuerpoVenta");
            cuerpoVenta.empty();

            for (var i = 0; i < productosVendidos.length; i++) {
                var producto = productosVendidos[i];
                var fila = $("<tr>");
                fila.append($("<td>").text(producto.id));
                fila.append($("<td>").text(producto.nombreproducto));
                fila.append($("<td>").text(producto.cantidadventa));
                fila.append($("<td>").text(producto.precioproducto));
                fila.append($("<td>").text(producto.subtotal));
                fila.append($("<td>").html('<button type="button" class="btn btn-danger btn-remove" data-id="' + producto.id + '"><i class="fas fa-trash"></i> Eliminar</button>'));

                cuerpoVenta.append(fila);
            }
        }

        // Evento para eliminar un producto de la venta
        $("#productosVendidos").on("click", ".btn-remove", function() {
            var id = $(this).data("id");
            productosVendidos = productosVendidos.filter(function(producto) {
                return producto.id !== id;
            });
            actualizarTablaProductosVendidos();
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