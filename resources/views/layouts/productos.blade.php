@extends('layouts.index')

@section('title', 'Productos')
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
        <h1> Productos</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<div class="card">
    <div class="card-body">
                <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-shopping-bag"></i> Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form method= "POST" action="{{route ('producto.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="fotoproducto">Foto producto: </label>
                                <input type="file" name="fotoproducto" id="fotoproducto" class="form-control @error('fotoproducto') is-invalid @enderror" value="{{ old('fotoproducto')}}">
                            @error('fotoproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="nombreproducto">Nombre producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombreproducto') is-invalid @enderror" id="nombreproducto" name="nombreproducto" value="{{ old('nombreproducto')}}" required autocomplete="nombreproducto" autofocus >
                                @error('nombreproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="categoria">Categoría: <span class="text-danger">*</span></label>
                                <select  class="form-control @error('id_categoria') is-invalid @enderror"  name="id_categoria" id="id_categoria">
                                    <option value="">Seleccionar una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombrecategoria }}</option>
                                    @endforeach
                                </select>
                                @error('id_categoria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="descripcionproducto">Descripción producto: </label>
                                <input type="text" class="form-control" id="descripcionproducto" name="descripcionproducto" value="{{ old('descripcionproducto')}}" autocomplete="descripcionproducto" autofocus >
                                @error('descripcionproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="clasificacionproducto">Clasificación producto: <span class="text-danger">*</span></label>
                                <select id="clasificacionproducto"
                                    class="form-control @error('clasificacionproducto') is-invalid @enderror"
                                    name="clasificacionproducto" required autocomplete="clasificacionproducto">
                                    <option value="">Seleccione una clasificación</option>
                                    <option
                                    value="Tipo A"{{ old('clasificacionproducto') === 'Tipoa A' ? ' selected' : '' }}>
                                    Tipo A</option>
                                    <option
                                    value="Tipo B"{{ old('clasificacionproducto') === 'Tipo B' ? ' selected' : '' }}>
                                    Tipo B</option>
                                </select>
                                @error('clasificacionproducto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="cantidadproducto">Cantidad producto: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cantidadproducto" name="cantidadproducto" value="{{ old('cantidadproducto')}}" required autocomplete="cantidadproducto" autofocus >
                                @error('cantidadproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="precioproducto">Precio producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="precioproducto" name="precioproducto" value="{{ old('precioproducto')}}" required autocomplete="precioproducto" autofocus >
                                @error('precioproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="marcaproducto">Marca producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="marcaproducto" name="marcaproducto" value="{{ old('marcaproducto')}}" required autocomplete="marcaproducto" autofocus >
                                @error('marcaproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="stockminimo">Stock mínimo: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stockminimo" name="stockminimo" value="{{ old('stockminimo')}}" required autocomplete="stockminimo" autofocus >
                                @error('stockminimo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="unidadmedidaproducto">Unidad de medida producto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="unidadmedidaproducto" name="unidadmedidaproducto" value="{{ old('unidadmedidaproducto')}}" required autocomplete="unidadmedidaproducto" autofocus >
                                @error('unidadmedidaproducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="	far fa-window-close"></i> Cancelar</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modelId"><i class="fas fa-plus"></i> Agregar Nuevo Producto</button>
        <br><br>
        <h2>Lista de productos</h2>
        <table id="productosTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagen </th>
                    <th>Nombre </th>
                    <th>Categoría</th>
                    <th>Descripción </th>
                    <th>Clasificación</th>
                    <th>Cantidad </th>
                    <th>Precio </th>
                    <th>Marca</th>
                    <th>Stock mínimo</th>
                    <th>Unidad de medida</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                        <td>{{$loop->iteration}}</td> 
                        <td>
                            @if ($producto->fotoproducto)
                                <img src="{{ asset('storage/productos/' . $producto->fotoproducto) }}"
                                    style="max-width: 50px; border-radius: 50%;">
                            @else
                                <img src="{{ asset('img/Placeholderproducto.jpg') }}"
                                    alt="Imagen por defecto">
                            @endif
                        </td>
                        <td>{{ $producto->nombreproducto }}</td>
                        <td>{{$producto->categoria->nombrecategoria}}</td>
                        <td>{{ $producto->descripcionproducto }}</td>
                        <td>{{$producto->clasificacionproducto}}</td>
                        <td>{{ $producto->cantidadproducto }}</td>
                        <td>{{ $producto->precioproducto }}</td>
                        <td>{{ $producto->marcaproducto }}</td>
                        <td>{{ $producto->stockminimo }}</td>
                        <td>{{ $producto->unidadmedidaproducto }}</td>
                        
                        <td>
                            <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#editarproductoModal{{$producto->id}}"><i class="fas fa-edit"></i> Editar</button>
                        </td>
                        </tr>

                        <div class="modal fade" id="editarproductoModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $producto->id }}" aria-hidden="true">
                            <div class="modal-dialog"  role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="editarModalLabel{{ $producto->id }}"><i class="fas fa-edit"></i> Editar Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario de edición de producto -->
                                        <form method="POST" action="{{ route('producto.update', $producto->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="fotoproducto">Foto producto: </label>
                                                <input type="file" name="fotoproducto" id="fotoproducto" class="form-control @error('fotoproducto') is-invalid @enderror" value="{{ old('fotoproducto', $producto->fotoproducto)}}">
                                                <br>
                                                @if ($producto->fotoproducto)
                                                    <div class="current-image">
                                                    <img src="{{ asset('storage/producto/' . $producto->fotoproducto) }}"
                                                    alt="Vista previa de "
                                                    style="display: none; max-width: 100px; border-radius: 50%;">
                                                
                                                @else
                                                 <p>No hay imagen</p>
                                                @endif   
                                                @error('fotoproducto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                 @enderror
                                            </div>       
                                            <div class="form-group">
                                                <label for="nombreproducto">Nombre producto: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('nombreproducto') is-invalid @enderror" id="nombreproducto" name="nombreproducto" value="{{ old('nombreproducto', $producto->nombreproducto )}}" required autocomplete="nombreproducto" autofocus>
                                                @error('nombreproducto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="categoria">Categoría: <span class="text-danger">*</span></label>
                                            <select  class="form-control @error('id_categoria') is-invalid @enderror"  name="id_categoria" id="id_categoria">
                                            <option value="">Seleccionar una categoría</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nombrecategoria }}</option>
                                            @endforeach   
                                                </select>
                                                @error('id_categoria')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>    
                                            <div class="form-group">
                                            <label for="descripcionproducto">Descripción producto: </label>
                                            <input type="text" class="form-control" id="descripcionproducto" name="descripcionproducto" value="{{ old('descripcionproducto', $producto->descripcionproducto)}}" autocomplete="descripcionproducto" autofocus >
                                            @error('descripcionproducto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="clasificacionproducto">Clasificación producto: <span class="text-danger">*</span></label>
                                            <select id="clasificacionproducto"
                                            class="form-control @error('clasificacionproducto') is-invalid @enderror"
                                            name="clasificacionproducto" required autocomplete="clasificacionproducto">
                                            <option
                                            value="TipoA"{{ old('clasificacionproducto' , $producto->clasificacionproducto) === 'Tipoa A' ? ' selected' : '' }}>
                                            Tipo A</option>
                                            <option
                                            value="TipoB"{{ old('clasificacionproducto', $producto->clasificacionproducto ) === 'Tipo B' ? ' selected' : '' }}>
                                            Tipo B</option>
                                            </select>
                                            @error('clasificacionproducto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="cantidadproducto">Cantidad producto: <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('cantidadproducto') is-invalid @enderror" id="cantidadproducto" name="cantidadproducto" value="{{ old('cantidadproducto', $producto->cantidadproducto )}}" required autocomplete="cantidadproducto" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                            @error('cantidadproducto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="estadoproducto">Estado producto: <span class="text-danger">*</span></label>
                                                <select id="estadoproveedor"
                                                class="form-control @error('estadoproducto') is-invalid @enderror"
                                                name="estadoproducto" required autocomplete="estadoproducto">
                                                <option
                                                value="1"{{ old('estadoproducto', $producto->estadoproducto) === 'Activo' ? ' selected' : '' }}>
                                                Activo</option>
                                                <option
                                                value="0"{{ old('estadoproducto' , $producto->estadoproducto) === 'Inactivo' ? ' selected' : '' }}>
                                                Inactivo</option>
                                                </select>
                                                @error('estadoproducto')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror         
                                            </div>
                                            <div class="form-group">
                                                <label for="precioproducto">Precio producto: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('precioproducto') is-invalid @enderror" id="precioproducto" name="precioproducto" value="{{ old('precioproducto', $producto->precioproducto )}}" required autocomplete="precioproducto" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                @error('precioproducto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>         
                                            <div class="form-group">
                                                <label for="marcaproducto">Marca producto: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('marcaproducto') is-invalid @enderror" id="marcaproducto" name="marcaproducto" value="{{ old('marcaproducto', $producto->marcaproducto )}}" required autocomplete="marcaproducto" autofocus >
                                                @error('marcaproducto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="stockminimoE">Stock mínimo: <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('stockminimo') is-invalid @enderror" id="stockminimo" name="stockminimo" value="{{ old('stockminimo', $producto->stockminimo )}}" required autocomplete="stockminimo" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                @error('stockminimo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="unidadmedidaproducto">Unidad de medida producto: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('unidadmedidaproducto') is-invalid @enderror" id="unidadmedidaproducto" name="unidadmedidaproducto" value="{{ old('unidadmedidaproducto', $producto->unidadmedidaproducto )}}" required autocomplete="unidadmedidaproducto" autofocus >
                                                @error('unidadmedidaproducto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>      
                                            </div>
                                        </form>
                                    </div>    
                                </div>
                            </div> 
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
@endsection

@section('js')

<script>


     // Función para mostrar mensajes de SweetAlert2
     function showAlert(icon, title, text, position, isError) {
            const options = {
                position: position,
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: isError, // Mostrar el botón "OK" solo en alertas de error
                allowOutsideClick: false, // Evitar cerrar el modal haciendo clic fuera de él
                timer: isError ? null : 2000, // Cerrar automáticamente después de 2 segundos en alertas de éxito
            };

            // Mostrar la alerta de SweetAlert2 con las opciones configuradas
            Swal.fire(options).then((result) => {
                if (!isError && result.dismiss === Swal.DismissReason.timer) {
                    // Cerrar el modal si la alerta es de éxito y se cierra automáticamente
                    $('#editarproductoModal').modal('hide');
                }
            });
        }
        @if (session('successC'))
            // Mostrar mensaje de éxito para la creación
            showAlert('success', 'Éxito', '{{ session('successC') }}', 'top-end', false);
        @elseif (session('errorC'))
            // Mostrar mensaje de error para la creación
            showAlert('error', 'Error', '{{ session('errorC') }}', 'top-center', true);
            $(document).ready(function () {
                $('#modelId').modal('show');
            });
        @endif

        @if (session('success'))
            // Mostrar mensaje de éxito para la actualización
            showAlert('success', 'Éxito', '{{ session('success') }}', 'top-end', false);
            // Cerrar el modal de edición automáticamente después de 2 segundos
            setTimeout(function () {
                $('#editarproductoModal').modal('hide');
            }, 2000);
        @elseif (session('error'))
            // Mostrar mensaje de error para la actualización
            showAlert('error', 'Error', '{{ session('error') }}', 'top-center', true);
            $(document).ready(function () {
                        $('#editarproductoModal{{$producto->id}}').modal('show');
                    });
           /*  @foreach($productos as $producto)
                @if(session('error_id') == $producto->id)
                   
                @endif
            @endforeach */
        @endif

$(document).ready(function() {
$('#productosTable').DataTable({
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