@extends('layouts.index')

@section('title', 'Proveedores')

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
        <h1>Proveedores</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaProveedor.jpg')}}" class="img-fluid" alt="Ayuda Proveedor" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<div class="container-fluid">
<section class="sectionT2">
    <div class="header">
        <h3><i class="far fa-address-book"></i> Generar  Proveedores </h3>
    </div>
    </section>

<div class="card">
    <div class="card-body">
    <!-- Formulario para crear un proveedor-->
        <form method="POST" action="{{ route('proveedores.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="razonsocialproveedor">Razón social o nombre proveedor: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('razonsocialproveedor') is-invalid @enderror" id="razonsocialproveedor" name="razonsocialproveedor" value="{{ old('razonsocialproveedor')}}" required autocomplete="razonsocialproveedor" autofocus>
                    @error('razonsocialproveedor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col-md-4 ">
                    <label for="numerorucproveedor">Número RUC proveedor: </label>
                    <input type="text" class="form-control @error('numerorucproveedor') is-invalid @enderror" id="numerorucproveedor" name="numerorucproveedor" autocomplete="numerorucproveedor" value="{{ old('numerorucproveedor')}}" autofocus>
                    @error('numerorucproveedor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="telefonoproveedor">Teléfono proveedor: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('telefonoproveedor') is-invalid @enderror" id="telefonoproveedor" name="telefonoproveedor" autocomplete="telefonoproveedor" value="{{ old('telefonoproveedor')}}" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57"  required>
                    @error('telefonoproveedor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            
            <br>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Agregar</button>
        </form>
        <br>
        <h1>Lista de proveedores</h1><br>
        <div class="table-responsive" >
        <table id="proveedor" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razón social o Nombre</th>
                    <th>Número RUC</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->razonsocialproveedor }}</td>
                        <td>{{ $proveedor->numerorucproveedor }}</td>
                        <td>{{ $proveedor->telefonoproveedor }}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#editarproveedorModal{{$proveedor->id}}"><i class="fas fa-edit"></i> Editar</button>
                        
                            <a>                            
                                <!-- Se crea los botones dentro del formulario donde la acción hace el llamado a la ruta correspondiente -->
                                <form method="POST" action="{{ route('proveedor.desactivate', ['id' => $proveedor->id]) }}">
                                    @csrf
                                    <!--Se crea la condición si ya está almacenado el valor 1 por defecto, 
                                        que significa activo muestra un botón de color verde sino de color rojo -->
                                    @if ($proveedor->estadoproveedor == 1)
                                        <button type="submit" class="btn btn-link">
                                            <i class="fas fa-check text-success"></i>Desactivar <!-- Icono de check en verde -->
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-link" class="d-flex align-items-center">
                                            <i class="fas fa-times text-danger"></i> <!-- Icono de X en rojo -->
                                        </button>
                                    @endif
                                </form>
                            </a>
                            <div class="d-flex align-items-center">
                            
                                
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="editarproveedorModal{{ $proveedor->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $proveedor->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="editarModalLabel{{ $proveedor->id }}"><i class="fas fa-edit"></i> Editar proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de edición de proveedor -->
                                    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="razonsocialproveedor">Razón Social o nombre proveedor: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('razonsocialproveedor') is-invalid @enderror" id="razonsocialproveedor" name="razonsocialproveedor" value="{{ old('razonsocialproveedor', $proveedor->razonsocialproveedor) }}" required autocomplete="razonsocialproveedorE" autofocus>
                                            @error('razonsocialproveedor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="numerorucproveedor">Número RUC proveedor: </label>
                                            <input type="text" class="form-control @error('numerorucproveedor') is-invalid @enderror" id="numerorucproveedor" name="numerorucproveedor" value="{{ old('numerorucproveedor', $proveedor->numerorucproveedor) }}" required autocomplete="numerorucproveedor" autofocus>
                                            @error('numerorucproveedor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="telefonoproveedor">Teléfono proveedor: </label>
                                            <input type="text" class="form-control @error('telefonoproveedor') is-invalid @enderror" id="telefonoproveedor" name="telefonoproveedor" value="{{ old('telefonoproveedor', $proveedor->telefonoproveedor) }}"  autocomplete="telefonoproveedor" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                            @error('telefonoproveedor')
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
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
<br>

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
                    $('#editarproveedorModal').modal('hide');
                }
            });
        }

        @if (session('success'))
            // Mostrar mensaje de éxito para la actualización
            showAlert('success', 'Éxito', '{{ session('success') }}', 'top-end', false);
            // Cerrar el modal de edición automáticamente después de 2 segundos
            setTimeout(function () {
                $('#editarproveedorModal').modal('hide');
            }, 2000);
        @elseif (session('error'))
            // Mostrar mensaje de error para la actualización
            showAlert('error', 'Error', '{{ session('error') }}', 'top-center', true);
            @foreach($proveedores as $proveedor)
                @if(session('error_id') == $proveedor->id)
                    $(document).ready(function () {
                        $('#editarproveedorModal{{$proveedor->id}}').modal('show');
                    });
                @endif
            @endforeach
        @endif
</script>

<script>
    
    $(document).ready(function() {
    $('#proveedor').DataTable({
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
