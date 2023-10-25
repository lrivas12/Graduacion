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
        <h1>Editar Compras</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route ('compras.update', $compra->id)}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="overflow-auto">
                                <div class="card-body">
                                    @method('PUT')
                                    @csrf
                                            <input type="hidden" id="detalleCompra" name="detalleCompra">
                                            <div class="border border p-2">
                                            <h2>Datos de compra</h2>
                                            <label for="fechacompra">Fecha de compra: <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('fechacompra') is-invalid @enderror"
                                                    id="fechacompra" name="fechacompra" value="{{ old('fechacompra',  date('Y-m-d') )}}" required readonly>
                                            @error('fechacompra')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <label for="proveedor">Proveedor: <span class="text-danger">*</span></label>
                                            <select class="form-control @error('proveedor_id') is-invalid @enderror" id="proveedor_id"
                                                name="proveedor_id"  required>
                                                <option value="{{ old('proveedor_id') }}">Seleccionar proveedor</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->razonsocialproveedor }}</option>
                                                @endforeach

                                            </select>
                                            @error('proveedor_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                            <label for="nombreproducto">Nombre del Producto: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" key="" original="" id="nombreproducto" name="nombreproducto" placeholder="Nombre del Producto" value="{{old('nombreproducto')}}" readonly>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <label for="cantidadcompra">Cantidad:<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="cantidadcompra" name="cantidadcompra" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57" value="{{old('cantidadcompra', $compra->cantidadcompra)}}" autocomplete="cantidadcompra" autofocus>
                                                <div id="cantidadcompraError" style="color: red;"></div>
                                                </div>
                                                <div class="col-md-6">
                                                <label for="costocompra">Costo: <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                    <input type="number" class="form-control" id="costocompra" name="costocompra" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57" value="{{old('costocompra', $compra->costocompra)}}" autocomplete="costocompra" autofocus>
                                                    <div id="costocompraError" style="color: red;"></div>        
                                                </div>
                                                </div>
                                                </div>
                                                <label for="precioproducto">Precio venta: <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">C$</span>
                                                    <input type="precioproducto" class="form-control" id="precioproducto" name="precioproducto" min="1" onkeypress="return event.charCode >= 48 && event.charCode<=57" value="{{old('precioproducto', $compra->precioproducto)}}" autocomplete="precioproducto" autofocus>
                                                    <div id="precioVentaError" style="color: red;"></div>        
                                    </div>
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
                                                            <th>Precio</th>
                                                            <th>Agregar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @foreach ($productos as $producto)
                                                            <tr class = "text-center">
                                                                <td>{{$loop->iteration}}</td> 
                                                                <td>{{ $producto->nombreproducto }}</td>
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
                                            <th>Acciones</th>
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
                $('#productosExistentes').DataTable({
                    "language": {
                        "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                    },
            });
        });

        $(document).ready(function() {
                $('#productosComprados').DataTable({
                    "language": {
                        "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                    },
            });
        });

</script>

<script>
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

            var tablaDatos = JSON.parse('@json($productosjson)');
            
            
            $("#btnAdd").click(function(){
                
                let id = $("#nombreproducto").attr("key");
                let original = $("#nombreproducto").attr("original");
                let nombreproducto = $("#nombreproducto").val();
                let cantidadcompra = $("#cantidadcompra").val();
                let costocompra = $("#costocompra").val();
                let precioproducto = $("#precioproducto").val();
                
                let subtotalcompra = parseFloat(cantidadcompra) * parseFloat(costocompra);
                
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
                

                if(cantidadcompra <= 0 || costocompra <= 0)
                {
                    $("#cantidadcompraError").html("La cantidad debe ser mayor que cero");
                    $("#costocompraError").html("El costo debe ser mayor que cero");
                    return;
                }

                 // Agrega la condición para verificar que los precios de venta sean mayores que el costo
                 if (parseFloat(precioproducto) <= parseFloat(costocompra) ) {
                    $("#precioproductoError").html("El precio de venta deben ser mayores que el costo de compra");
                    return;
                }
                // Agrega una validación para asegurarte de que se haya seleccionado al menos un producto
            
                let datos = {
                    id:parseInt(id),
                    nombreproducto,
                    cantidadcompra,
                    costocompra,
                    precioproducto,
                    original,
                    subtotalcompra,
                    nuevo: original === "true" ? false : true
                }
                //Busca el indice del arreglo para sustituirlo
                let indice = tablaDatos.findIndex(objeto => parseInt(objeto.id) === parseInt(id));
                //console.log(indice);
                if (indice == -1) { //sino el indice lo agrega
                    tablaDatos.push(datos);
                }else{
                    tablaDatos[indice] = datos; // si existe lo sustituye
                    if(!original) tablaDatos[indice].nuevo =false
                }
                showTable();// Muestra la tabla actualizada

                //vacia las cajas de texto
                    $("#nombreproducto").attr("key", "");
                    $('#nombreproducto').attr('original',false);

                    $("#nombreproducto").val("");
                    $("#precioproducto").val("");
                    $("#cantidadcompra").val("");
                    $("#costocompra").val("");
                    $("#cantidadcompraError").html("");
                    $("#costocompraError").html("");
                    $("#precioVentaError").html("");
                

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
                            <td>${x.subtotalcompra}</td>

                            <td>
                                <div class="d-flex align-items-center"
                                    <a key="${x.id}" id="btnEditCompra" class = "mx-3" title="Editar producto" >
                                        <i class="fas fa-pencil-alt text-success"></i> 
                                    </a>
                                    <a key="${x.id}" id="btnDelCompra" class = "mx-3" title="Eliminar producto">
                                        <i class="fas fa-trash text-danger"></i> 
                                    </a>
                                </div> 
                            </td>
                        </tr>
                    `;
                    total += parseFloat(x.subtotalcompra);
                });
                m += `
                    <tr>
                        <td colspan=8>
                            Total = C$ ${total}
                        </td>
                    </tr>
                `;
                $("#cuerpoCompra").html(m);
                $("#detalleCompra").val(JSON.stringify(tablaDatos));
                console.log(tablaDatos);
                
            }
            showTable();
            console.log(tablaDatos);
            $("#cuerpoCompra").on("click", "#btnEditCompra", function(){
                let id = $(this).attr("key");
                let producto = tablaDatos.find(x =>parseInt (x.id) === parseInt(id));

                $("#nombreproducto").attr("key", producto.id);
                $("#nombreproducto").attr("original", producto.original);
                $("#nombreproducto").val(producto.nombreproducto);
                $("#precioproducto").val(producto.precioproducto);
                $("#cantidadcompra").val(producto.cantidadcompra);
                $("#costocompra").val(producto.costocompra);


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