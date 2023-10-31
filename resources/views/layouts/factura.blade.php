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
    <form action="{{route('factura.store')}}" method="post">
        @csrf
        <input type="hidden" id="detalleVenta" name="detalleVenta">
            <div class="border border-primary rounded p-2">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="overflow-auto">
                            <div class="card-body">
                                <div class="border border-primary rounded p-1">
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="overflow">
                                               {{--  Datos de la venta --}}
                                                <div class="card-body">
                                                    @php
                                                        $ultimoNumeroVenta = DB::table('facturas')->max('id');   
                                                        // 2. Incrementar el número de venta en uno
                                                        $nuevoNumeroVenta = $ultimoNumeroVenta + 1;
                                                    @endphp
                                                    <label for="numeroventa">{{ __('N° venta') }}</label>
                                                    <input id="numeroventa" type="text"
                                                    class="form-control" name="numeroventa" value="{{ $nuevoNumeroVenta }}" readonly>
                                                    
                                                    <label for="tipoVenta">Tipo de venta<span class="text-danger">*</span></label>
                                                    <select class="form-control @error('tipoventa') is-invalid @enderror" id="tipoventa" name="tipoventa" required>
                                                        <option value="contado" {{ old('tipoventa') == 'contado' ? 'selected' : '' }}>Contado</option>
                                                        <option value="credito" {{ old('tipoventa') == 'credito' ? 'selected' : '' }}>Crédito</option>
                                                    </select>
                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="overflow">
                                                <div class="card-body">
                                                  {{--   Datos de la venta --}}
                                                    <label for="fechafactura">Fecha de venta: </label>
                                                    <input type="date" class="form-control @error('fechafactura') is-invalid @enderror"
                                                        id="fechafactura" name="fechafactura" value="{{ old('fechafactura',  date('Y-m-d')) }}" readonly>
                                                
                                                    <div id="contentCliente">
                                                        <label for="cliente">Cliente: <span class="text-danger">*</span></label>
                                                        <select class="form-control @error('clientes_id') is-invalid @enderror" id="clientes_id" name="clientes_id" required>
                                                            <option value="{{ old('clientes_id') }}">Seleccionar cliente</option>
                                                            @foreach ($clientes as $cliente)
                                                            <option value="{{ $cliente->id }}" >{{ $cliente->nombrecliente }} {{ $cliente->apellidocliente }}</option>
                                                            @endforeach
                                                        </select>
                                                        

                                                        @error('clientes_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="clienteSeleccionado"></label>
                                                        <input id="clienteSeleccionado" type="text" class="form-control" readonly style="display: none;">
                    
                                                        <label for="deuda">Deuda:</label>
                                                        <input id="deuda" name="deuda" type="text" class="form-control" readonly>
                                                    </div>
                                                    <br>
                                                
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2 text-center">
                                            <button type="button" class="btn btn-primary" id="seleccionarCliente"><i class="fas fa-plus-circle"></i> Seleccionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <br>
                       
                        <br>
                    </div>
                   
                    <div class="col-md-6 " id="card-agregarProd" style="display: none">
                        {{-- Formulario para agregar cantidad de productos a vender --}}
                        <div class="row justify-content-center">
                            <div class="overflow-auto">
                                <div class="card-body">
                                    <div class="border border-primary rounded p-1" id="detalleproducto" >
                                        <div class="overflow">
                                            {{-- Card para seleccionar el producto e ingrear la cantidad de venta --}}
                                            <div class="card-body" >
                                            

                                               {{--  Buscador y select de los productos, deben ir juntos para funcionar --}}
                                                <label for="nombreproducto">{{ __('Producto') }}</label>
                                                <input list="producto-list" class="form-control text-center" id="producto-input" placeholder="Busca el producto">
                                                <datalist id="producto-list">
                                                    <?php
                                                        // Obtener y mostrar opciones de productos
                                                        
                                                        foreach ($productos as $producto) {
                                                            echo '<option value="' . $producto->id . '">' . $producto->nombreproducto . ' Existencia: ' . $producto->existenciaproducto . '</option>';
                                                        }
                                                    ?>
                                                </datalist>
                                        
                                                <select class="form-control" id="seleccionarProducto" name="seleccionarProducto" key="" nombre="" >
                                                    <option value="" >Seleccionar producto: </option>
                                                    <?php
                                                        // Mostrar opciones de productos en el select
                                                        foreach ($productos as $producto) {
                                                            echo '<option value="' . $producto->id . '">' . $producto->nombreproducto . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="cantidadventa">Cantidad: <span class="text-danger">*</span></label>
                                                        <input type="number" step="1" min="0"
                                                            class="form-control @error('cantidadcompra') is-invalid @enderror"
                                                            id="cantidadventa" name="cantidadventa" value="{{ old('cantidadventa') }}"
                                                                oninput="this.value = Math.abs(this.value);">
                                                                <div id="cantidadVentaError" style="color: red; font-style: italic;"></div>
                                                        @error('cantidadventa')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
            
                                                        
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="precio">Precio: </label>
                                                
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">C$</span>
                                                                
                                                            </div>
                                                            <input type="number" 
                                                                class="form-control" id="precioproducto"
                                                                name="precioproducto" value="" 
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                               
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12 mt-2 text-center">
                                                    <button type="button" class="btn btn-primary" id="btnAddProducto" ><i class="fas fa-plus-circle"></i> Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                           <br>  
                        </div>
                    </div>
                </div>

                <div class="row justify content-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="overflow-auto">
                                <div class="table-responsive">
                                    <table id="productosVendidos" class="table table-bordered">
                                        <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th colspan="2">Acciones</th>
            
                                        </tr>
                                        </thead>
                                        <tbody id="cuerpoVenta" class="text-center">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row justify content-center">
                         <div class="col-md-12">
                            <div class="card-body">
                               {{--  Descuento total de la venta por monto --}}
                                <div class="col-md-8" id="descuentoInput" style="display: none">
                                    <div class="row justify content-center" >
                                        <div class="col-md-6">
                                            <label for="descuento">Descuento: </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CS</span>
                                                    
                                                </div>
                                                <input type="number" step="0.01" min="0"
                                                class="form-control" id="descuento"
                                                name="descuento" value="{{ old('descuento', '0') }}" 
                                                oninput="this.value = Math.abs(this.value);">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="total">Total venta: </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                    
                                                </div>
                                                <input type="number" 
                                                class="form-control" id="total"
                                                name="total"value="{{ old('total', '0')}}" readonly>
                                            </div>
                                        </div>
                                        
                                    </div>
            
                                </div>
                                {{--  Si la venta es de tipo credito, para ingresar adelanto y calcular saldo --}}
                                <div class="col-md-8" id="detalleVentaTipoCredito"  style="display: none" >
                                    <div class="row justify content-center">
                                        <div class="col-md-6">
                                            <label for="adelanto">Adelanto</label>
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
                                            <label for="saldo">Saldo pendiente</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                </div>
                                                <input type="number" 
                                                class="form-control" value="{{ old('saldo', '0')}}" id="saldo"
                                                name="saldo" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                         </div>
                        </div>
                    </div>
                </div>
               
                <div class="row text-right mt-3">
                    <div class="col-md-12 " >
                       
                        <button class="btn btn-primary mr-2"><i class="fas fa-print"></i> Guardar e Imprimir</button>
                        <button class="btn btn-primary ml-2"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                    <div class="col-md-12 mt-2 text-left">
                        <a href="{{ route('factura.index') }}" class="btn btn-danger" id="btnSalir"><i class="far fa-window-close"></i> Salir</a>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')

<script>
   


    //variables que pueden ser utilizadas en todas las funciones del script
    var tablaDatos = [];
    var stockminimo, pago, saldo,tipoVenta, totaldescuento = 0, descuento = 0; //propias de ventas
    
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

                    
            $(document).ready(function() {
                $('#productosVendidos').DataTable({
                    "language": {
                        "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                    },
                });

                //Configuración para solicitudes ajax
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                        //Muestra el la deuda del cliente al seleccionar el cliente en el select, 
                    //propiamente de las ventas y creditos
                $("#clientes_id").on("change", function () {
                    
                    const selectedClientId = $(this).val();
            
                    if (selectedClientId) {
                        
                        const clienteId = selectedClientId;
                        // Realizar una solicitud AJAX para obtener el saldo pendiente
                        $.ajax({
                            url:'/obtener-saldo/' + clienteId,
                            method: 'GET',
                            
                            success: function (data) {
                                if (data.saldo) {
                                    const saldo = data.saldo;
                                    $("#deuda").val("C$ " + saldo.toFixed(2));
                                    

                                } else {
                                    $("#deuda").val("C$ 0");
                                }
                            },
                            error: function () {
                                $("#deuda").val("Ha ocurrido un error");
                            }
                        });
                        
                    } else {
                        $("#deuda").val("No se seleccionó cliente");
                        
                    }

                });
                //validaciones para la venta
                    // Al hacer clic en el botón "Seleccionar"
                    $("#seleccionarCliente").click(function () {
                        // Obtener los valores seleccionados

                        const selectedCliente = $("#clientes_id option:selected").val();
                        const selectedClienteT = $("#clientes_id option:selected").text();
                        tipoVenta = $("#tipoventa").val();
                        // Comprobar si se seleccionó un cliente, tipo de venta y ruta
                        if (selectedCliente.trim() === "" || tipoVenta.trim() === "" ) {
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
                            if(selectedCliente.trim() !== "" && tipoVenta.trim() !== ""){
                                console.log("click");
                                // Si se seleccionó un cliente, mostrar el valor seleccionado en un campo de texto visible
                                $("#clienteSeleccionado").val(selectedClienteT);
                                
                                // Ocultar el campo cliente_id y mostrar el campo de texto
                                $("#clientes_id").hide();
                                $("#clienteSeleccionado").show();
                                
                                // Mostrar el div con id "card-agregarProd" que contiene los input para agregar la cantidad o editar el productos
                                //antes de agregar la compra
                                $("#card-agregarProd").show();
                                
                            }
                        }    
                        
                    });

            });

        });


        //Buscador de productos correcto, de tipo input on su select
        //Propiamente de ventas
        let productoInput = document.querySelector("#producto-input");
        let productoSelect = document.querySelector("#seleccionarProducto");

        productoInput.addEventListener("change", () => {
            let selectValue = productoInput.value;
            let option = productoSelect.querySelector(`option[value="${selectValue}"]`);
            if (option || productoInput.value == "") {
                if (productoInput.value != "") {
                    productoSelect.value = option.value;
                }
            } else {
                productoInput.value = "";
                $("#producto-input").attr("style", "border: 2px solid red; transition: 1s;");
                setTimeout(() => {
                    $("#producto-input").attr("style", "transition: 1s;");
                }, 1000);
            }
        });
            
        $('#seleccionarProducto').change(function(){
            let id = $(this).val();
            inputSelect(id);
        });

        $('#producto-input').change(function(){
            let id = $(this).val();
            inputSelect(id);
        });

        //propiamente de ventas
        const inputSelect = (id)=>{
            //Peticion al servidor con el id
            fetch('/api/compras/'+id)
            .then(x => {return x.json()})
            .then(x => {
            
                console.log(x);
                console.log("cantidadproducto " + x.cantidadproducto);
          
                    //validacion para los productos con existencia cero
                    if (x.cantidadproducto === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Producto agotado',
                            text: 'Seleccione otro producto',
                            allowOutsideClick: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        });
                        return; // Evita agregar productos agotados
                    }
                    else
                    {
                        //mostrar los datos en los input, propiamente de ventas

                        $("#nombreproducto").attr("key", x.id);
                        $("#nombreproducto").val(x.nombreproducto);
                        $("#seleccionarProducto").attr("key",x.id);
                        $("#seleccionarProducto").attr("nombre",x.nombreproducto);
                        $("#precioproducto").val(x.precioproducto);
                    }
                });
            }
            //Al hacer clic en el boton que agrega a la tabla de productos vendidos
            $("#btnAddProducto").click(function(){
            //validaciones para el producto de la venta
                let id = $("#seleccionarProducto").attr("key");
                if (stockminimo === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Producto agotado',
                        text: 'El producto seleccionado está agotado.',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (!id || id.trim() === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text:'Debes seleccionar al menos un producto.',
                        allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                        showCancelButton: false, // No mostrar el botón de cancelar
                        confirmButtonText: 'OK' // Personaliza el texto del botón "OK"
                    });
                    return;
                    
                }
                //crea las variables que recibe la variable datos
                let nombreproducto = $("#seleccionarProducto").attr("nombre");
                let cantidadventa = $("#cantidadventa").val();
                let precioproducto = $("#precioproducto").val();
                let subtotalventa = parseFloat(cantidadventa) * parseFloat(precioproducto);
                subtotalventa = parseFloat(subtotalventa.toFixed(2));
                
                
                //Validaciones propias de la venta
                if (cantidadventa <= 0) {
                    $("#cantidadVentaError").html("La cantidad debe ser mayor que cero");
                    return;
                }

                if (cantidadventa > stockminimo) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text:'La cantidad de venta debe ser menor o igual al stock',
                        allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                        showCancelButton: false, // No mostrar el botón de cancelar
                        confirmButtonText: 'OK' // Personaliza el texto del botón "OK"
                    });
                    return;
                }
            

            let datos = {
                id,
                nombreproducto,
                cantidadventa,
                precioproducto,
                subtotalventa
            }
            //Busca el indice del arreglo para sustituirlo
            let indice = tablaDatos.findIndex(objeto => objeto.id === id);
            //console.log(indice);
            if (indice == -1) { //sino el indice lo agrega
            tablaDatos.push(datos);
            }else{
                tablaDatos[indice] = datos; // si existe lo sustituye
            }
            showTable();// Muestra la tabla actualizada de ventas

            //vacia las cajas de texto de la card de los productos
            $("#seleccionarProducto").attr("nombre","");
            $("#seleccionarProducto").attr("key","");
            $("#seleccionarProducto").val("");

            $("#producto-input").val("");
       
            $("#precioproducto").val("");
            $("#cantidadventa").val("");
            $("#cantidadVentaError").html("");
            $("#descuentoInput").show();
            if (tipoVenta === 'credito') {
                $("#detalleVentaTipoCredito").show();
            }
       
          
      

    });
    //funciones y variables propiamente de ventas
    var totalSD;
    const showTable = () =>{
        let m = "";
        let total = 0;
        let cont = 1;
        
        tablaDatos.forEach(x => {
       
        $("#productosExistentes button[cod='"+x.id+"']").prop("disabled",true);

            m += `
                <tr >
                    <td>${cont++}</td>
                    <td>${x.nombreproducto}</td>
                    <td>${x.cantidadventa}</td>
                    <td>C$ ${x.precioproducto}</td>
                    <td>C$ ${x.subtotalventa}</td>

                    <td>
                        <div class="d-flex align-items-center"
                            <a key="${x.id}" id="btnEditVenta" class = "mx-4" title="Editar producto" >
                                <i class="fas fa-pencil-alt text-success"></i> 
                            </a>
                            
                        </div> 
                    </td>
                    <td>
                        <div class="d-flex align-items-center"
                           
                            <a key="${x.id}" id="btnDelVenta" class = "mx-4" title="Eliminar producto">
                                <i class="fas fa-trash text-danger"></i> 
                            </a>
                        </div> 
                    </td> 
                </tr>
            `;
            total += parseFloat(x.subtotalventa);
            totalSD = total.toFixed(2); // Redondear el total a dos decimales
           
        });
        m += `
            <tr>
                <td colspan=8>
                    Total sin descuento = C$ ${totalSD}
                </td>
            </tr>
        `;
        $("#cuerpoVenta").html(m);
        $("#detalleVenta").val(JSON.stringify({
            datos:tablaDatos,
            total
        }));//convierte objeto en string
        
    }

    // Escuchar el evento de cambio en el campo "descuento", propiamnete de ventas
    $("#descuento").on("change", function () {
         // Obtener el valor del descuento
        descuento = parseFloat($(this).val()) || 0; // Parsear a número o 0 si no es un número válido
        console.log('totalSD:'+ totalSD);
        console.log('Descuento:'+ descuento);
        if (descuento >= parseFloat(totalSD)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El descuento no puede ser mayor o igual al subtotal de la venta',
                allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                showCancelButton: false, // No mostrar el botón de cancelar
                confirmButtonText: 'OK' // Personaliza el texto del botón "OK"
            });
            $("#total").val("");
            $("#descuento").val("");
            
            return;
               
        }else
        {
          
           // Calcular el nuevo total con descuento
            totaldescuento = totalSD - descuento;
            console.log('totalConDescuento:'+ totaldescuento);

            // Actualizar el elemento en el HTML para mostrar el total con descuento
            $("#total").val(totaldescuento.toFixed(2));
            recalcularSaldoPendiente($("#adelanto").val());
            
            
        }
    
    });
    
    $("#adelanto").on("change", function () {
         // Obtener el valor del descuento
        let adelanto = parseFloat($(this).val()) || 0; // Parsear a número o 0 si no es un número válido
        console.log('adelanto:'+ adelanto);
        console.log('totaldescuento:'+ totalSD-descuento);
        if(adelanto >= parseFloat(totalSD-descuento))
        {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El adelanto no puede ser mayor o igual al total de la venta',
                allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                showCancelButton: false, // No mostrar el botón de cancelar
                confirmButtonText: 'OK' // Personaliza el texto del botón "OK"
            });
            $("#saldo").val("");
            $("#adelanto").val("");
            
            return;
        }
        else
        {
            recalcularSaldoPendiente(adelanto);
        }
        
    });
    //funciones propiamente de ventas
    function recalcularSaldoPendiente(adelanto) {
        let saldoPen;

        if (totaldescuento) {
            saldoPen = (totaldescuento - adelanto).toFixed(2);
        } else {
            saldoPen = (totalSD - adelanto).toFixed(2);
        }
        console.log('totalcD:'+ totaldescuento);
        console.log('saldoPen:'+ saldoPen);

        // Actualizar el elemento en el HTML para mostrar el saldo pendiente
        $("#saldo").val(saldoPen);
    }

    $("#cuerpoVenta").on("click", "#btnEditVenta", function(){
        $("#detalleproducto").show();
        $('html, body').animate({
            scrollTop: $("#detalleproducto").offset().top
        }, 1000);
        let id = $(this).attr("key");
        let producto = tablaDatos.filter(x => x.id === id);
        

        $("#seleccionarProducto").attr("nombre",producto[0].nombreproducto);
        $("#seleccionarProducto").attr("key", producto[0].id);
        $("#seleccionarProducto").val(producto[0].id);
        $("#producto-input").val(producto[0].id);
        $("#precioproducto").val(producto[0].precioproducto);

       
            $("#precioproducto").val(producto[0].precioproducto);
        
        $("#cantidadventa").val(producto[0].cantidadventa);
        console.log(producto);
        
        
    });
    $("#cuerpoVenta").on("click", "#btnDelVenta", function(){
        let id = $(this).attr("key");
        $("#productosExistentes button[cod='"+id+"']").prop("disabled",false);

        tablaDatos = tablaDatos.filter(objeto => objeto.id !== id);
                    
        //renderiza la tabla
        showTable();
    });
    function validarProductosAgregados() {
        if (tablaDatos.length === 0) {
            // Mostrar un mensaje de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes agregar al menos un producto a la venta antes de guardar.',
            });
            return false;
        }
        return true;
    }

    $("form").submit(function (event) {
        if (!validarProductosAgregados()) {
            event.preventDefault(); // Evitar el envío del formulario si no se han agregado productos
        }
    });

</script>



@endsection