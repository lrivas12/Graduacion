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
        <h1> Compras</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaCompra.jpg')}}" class="img-fluid" alt="Ayuda Compra" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<section class="sectionT2">
<div class="header">
    <h3><i class="fas fa-shopping-cart"></i> Generar Compra </h3>
</div>
</section>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route ('compras.store')}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="overflow-auto">
                                <div class="card-body">
                                    @csrf
                                    <label style="font-style: italic; ">
                                        Los campos marcados con  <span style=" color: red;">*</span> son obligatorios</span>
                                    </label>
                                            <input type="hidden" id="detalleCompra" name="detalleCompra">
                                            <div class="border border p-2">
                                            <h2>Datos de compra</h2>
                                            <label for="fechacompra">Fecha de compra: <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('fechacompra') is-invalid @enderror"
                                                    id="fechacompra" name="fechacompra" value="{{ old('fechacompra',  date('Y-m-d') )}}" required >
                                            @error('fechacompra')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <label for="proveedor">Proveedor: <span class="text-danger">*</span></label>
                                            <select class="form-control @error('proveedor_id') is-invalid @enderror" id="proveedor_id"
                                                name="proveedor_id" required>
                                                <option value="{{ old('proveedor_id') }}">Seleccionar proveedor</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->razonsocialproveedor }}</option>
                                                @endforeach
                                            </select>
                                            <label for="proveedorSeleccionado"></label>
                                            <input id="proveedorSeleccionado" type="text" class="form-control" readonly style="display: none;">
                                            @error('proveedor_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                            <label for="nombreproducto">Nombre del Producto: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombreproducto" name="nombreproducto" placeholder="Nombre del Producto" readonly>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <label for="cantidadcompra">Cantidad:<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="cantidadcompra" name="cantidadcompra" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                <div id="cantidadcompraError" style="color: red;"></div>
                                                </div>
                                                <div class="col-md-6">
                                                <label for="costocompra">Costo: <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                    <input type="number" class="form-control" id="costocompra" name="costocompra" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                          
                                                </div>
                                                <div id="costocompraError" style="color: red;"></div>  
                                                </div>
                                                </div>
                                                <label for="precioproducto">Precio venta: <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                    <input type="precioproducto" class="form-control" id="precioproducto" name="precioproducto" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                          
                                                </div>
                                                <div id="precioproductoError" style="color: red;"></div>  
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 mt-2 ">
                                                    <button type="button" class="btn btn-primary" id="btnAddProducto"> <i class="fas fa-cart-plus"></i> Agregar a la compra</button>
                                                </div>
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
                                                            <th>Stock </th>
                                                            <th>Precio</th>
                                                            <th>Agregar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @foreach ($productos as $producto)
                                                            <tr class = "text-center">
                                                                <td>{{$loop->iteration}}</td> 
                                                                <td>{{$producto->nombreproducto }}</td>
                                                                <td>{{$producto->cantidadproducto}}</td>
                                                                <td>C$  {{ $producto->precioproducto }}</td>
                                                                <td> 
                                                                    <button type="button" class="btn btn-link" id="btnAdd" cod="{{$producto->id}}">
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
                        
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="productosComprados" class="table table-bordered">
                                    <thead class = "text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Costo</th>
                                            <th>Subtotal</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpoCompra" class = "text-center">
                                
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Registrar compra</button>
                
                        </div>
            </form>
        </div>
    </div>

@endsection

@section('js')

<script>
    $(document).ready(function() {
                $('#productosComprados').DataTable({
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

<script>

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
    }

    Swal.fire(options);
        }
    // Mostrar mensaje de éxito o error si existe
    @if(session('successC'))
    showAlert('success', 'Éxito', '{{ session('successC') }}', false, 'top-end');
    @elseif (session('errorC'))
    showAlert('error', 'Error', '{{ session('errorC') }}', true, 'top-center');
    @endif

    $(document).ready(function () {
        
        $("#proveedor_id").change(function () {
            // Obtener el valor seleccionado en el campo proveedor_id
            
                
        });
    });
});    
    
        
    $("#productosExistentes").on("click","#btnAdd",function(){
    
        let id = $(this).attr("cod");
        //Peticion al servidor con el id
        let baseUrl = "{{ url('/') }}";
        fetch(baseUrl+'/api/compras/'+id)
    
        .then(x => {return x.json()})
        .then(x => {
            console.log(x);
            $("#nombreproducto").attr("key", x.id);
            $("#nombreproducto").val(x.nombreproducto);
            $("#precioproducto").val(x.precioproducto);
        
        });
    })
    


    var tablaDatos = [];

    $("#btnAddProducto").click(function(){
        
        const selectedProveedor = $("#proveedor_id option:selected").val();
            const selectedProveedorT = $("#proveedor_id option:selected").text();
            if (selectedProveedor.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debe seleccionar un proveedor',
                    allowOutsideClick: false, // No permitir que se cierre haciendo clic fuera del modal
                    showCancelButton: false, // No mostrar el botón de cancelar
                    confirmButtonText: 'OK' // Personaliza el texto del botón "OK"     
                });
            }else if (selectedProveedor.trim() !== "") {
                // Si se seleccionó un proveedor, mostrar el valor seleccionado en un campo de texto visible
                $("#proveedorSeleccionado").val(selectedProveedorT);
                    
                // Ocultar el campo proveedor_id
                $("#proveedor_id").hide();
                $("#proveedorSeleccionado").show();

            }

        let id = $("#nombreproducto").attr("key");
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

        let nombreproducto = $("#nombreproducto").val();
        let cantidadcompra = $("#cantidadcompra").val();
        let costocompra = $("#costocompra").val();
        let precioproducto = $("#precioproducto").val();
        
        let subtotal = parseFloat(cantidadcompra) * parseFloat(costocompra);
        if(cantidadcompra <= 0 & costocompra <= 0)
        {
            $("#cantidadcompraError").html("La cantidad debe ser mayor que cero");
            $("#costocompraError").html("El costo debe ser mayor que cero");
            return;
        }
        if(cantidadcompra <= 0 )
        {
            $("#cantidadcompraError").html("La cantidad debe ser mayor que cero");
            return;
        }
        if( costocompra <= 0)
        {
            $("#costocompraError").html("El costo debe ser mayor que cero");
            return;
        }
        
        // Agrega la condición para verificar que los precios de venta sean mayores que el costo
        if (parseFloat(precioproducto) <= parseFloat(costocompra) || precioproducto <= 0) {
            $("#precioproductoError").html("El precio de venta deben ser mayor que el costo de compra");
            return;
        }
        // Agrega una validación para asegurarte de que se haya seleccionado al menos un producto
    
        let datos = {
            id,
            nombreproducto,
            cantidadcompra,
            costocompra,
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
            $("#cantidadcompra").val("");
            $("#costocompra").val("");
            $("#cantidadcompraError").html("");
            $("#costocompraError").html("");
            $("#precioproductoError").html("");
            

    });
    //Funcion para mostrar los datos en la tabla, const:funcion unica
    const showTable = () =>{
        
        let m = "";
        let total = 0;
        let cont = 1;
        tablaDatos.forEach(x => {
        $("#productosComprados button[cod='"+x.id+"']").prop("disabled",true);

            m += `
                <tr >
                    <td>${cont++}</td>
                    <td>${x.nombreproducto}</td>
                    <td>${x.cantidadcompra}</td>
                    <td>${x.costocompra}</td>
                    <td>${x.subtotal}</td>

                    <td>
                        <div class="d-flex align-items-center"
                            <a key="${x.id}" id="btnEditCompra" class = "mx-3" title="Editar producto" >
                                <i class="fas fa-pencil-alt text-success"></i> 
                            </a>
                    </td>        
                    <td>
                            <a key="${x.id}" id="btnDelCompra" class = "mx-3" title="Eliminar producto">
                                <i class="fas fa-trash text-danger"></i> 
                            </a>
                        </div> 
                    </td>
                </tr>
            `;
            total += x.subtotal;
        });
        m += `
            <tr>
                <td colspan=8>
                    Total = C$ ${total}
                </td>
            </tr>
        `;
        $("#cuerpoCompra").html(m);
        $("#detalleCompra").val(JSON.stringify({
            datos:tablaDatos,
            total
        }));//convierte objeto en string
        console.log(tablaDatos);

    }
    $("#cuerpoCompra").on("click", "#btnEditCompra", function(){
        let id = $(this).attr("key");
        let producto = tablaDatos.filter(x => x.id === id);

        $("#nombreproducto").attr("key", producto[0].id);
        $("#nombreproducto").val(producto[0].nombreproducto);
        $("#precioproducto").val(producto[0].precioproducto);
        $("#cantidadcompra").val(producto[0].cantidadcompra);
        $("#costocompra").val(producto[0].costocompra);


        console.log(producto);
        

    });
    $("#cuerpoCompra").on("click", "#btnDelCompra", function(){
        let id = $(this).attr("key");
        $("#productosExistentes button[cod='"+id+"']").prop("disabled",false);

        tablaDatos = tablaDatos.filter(objeto => objeto.id !== id);
                    
        //renderiza la tabla
        showTable();
    });
    // Esta función verifica si se ha agregado al menos un producto a la compra
    function validarProductosAgregados() {
        if (tablaDatos.length === 0) {
            // Mostrar un mensaje de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes agregar al menos un producto a la compra antes de guardar.',
            });
            return false;
        }
        return true;
    }

    // Agregar un manejador de eventos al formulario para validar antes de enviar
    $("form").submit(function (event) {
        if (!validarProductosAgregados()) {
            event.preventDefault(); // Evitar el envío del formulario si no se han agregado productos
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
