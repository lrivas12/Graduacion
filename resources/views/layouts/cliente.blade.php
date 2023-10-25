@extends('layouts.index')
@section('title', 'Clientes')

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
        <h1>Clientes</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<div class="card">
   <div class="card-body">
        <!-- Formulario para crear un nuevo Cliente -->
            <form method="POST" action="{{ route('cliente.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre">Nombre del cliente: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombrecliente') is-invalid @enderror" id="nombrecliente" name="nombrecliente" required autocomplete="nombrecliente" value="{{ old('nombrecliente')}}" autofocus>
                        @error('nombrecliente')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="nombre">Apellido del cliente: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('apellidocliente') is-invalid @enderror" id="apellidocliente" name="apellidocliente" required autocomplete="apellidocliente" value="{{ old('apellidocliente')}}" autofocus>
                        @error('apellidocliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-8">
                        <label for="nombre">Dirección del cliente: </label>
                        <input type="text" class="form-control @error('direccioncliente') is-invalid @enderror" id="direccioncliente" name="direccioncliente" autocomplete="direccioncliente" value="{{ old('direccioncliente')}}" autofocus>
                        @error('direccioncliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nombre">Teléfono del cliente: </label>
                            <input type="text" class="form-control @error('telefonocliente') is-invalid @enderror" id="telefonocliente" name="telefonocliente" autocomplete="telefonocliente" value="{{ old('telefonocliente')}}" autofocus>
                            @error('telefonocliente')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="nombre">Correo eléctronico del cliente: </label>
                            <input type="email" class="form-control @error('correocliente') is-invalid @enderror" id="correocliente" name="correocliente" autocomplete="correocliente" value="{{ old('correocliente')}}" autofocus>
                            @error('correocliente')
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
               <h2>Lista de Clientes</h2>
                <table id="clienteTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cliente as $cliente)
                            <tr>
                                    <td>{{$cliente->id }}</td>
                                    <td>{{$cliente->nombrecliente }}</td>
                                    <td>{{$cliente->apellidocliente }}</td>
                                    <td>{{$cliente->direccioncliente}}</td>
                                    <td>{{$cliente->telefonocliente }}</td>
                                    <td>{{$cliente->correocliente }}</td>
                                    <td>
                                    {{-- <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-primary">Editar</a> --}}
                                    <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#editarclienteModal{{$cliente->id}}"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#eliminarModal{{ $cliente->id }}"><i class="fa fa-trash"></i> Eliminar</button>
                            
                                </td>
                            </tr>
                            <div class="modal fade" id="editarclienteModal{{ $cliente->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $cliente->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarModalLabel{{ $cliente->id }}">Editar Cliente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulario de edición de categoría -->
                                            <form id="editarForm{{ $cliente->id }}" method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                                            @csrf
                                            @method('PUT')
                
                                                <div class="form-group">
                                                    <label for="nombre">Nombre del cliente: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nombreclienteE') is-invalid @enderror" id="nombreclienteE" name="nombreclienteE" value="{{ old('nombreclienteE', $cliente->nombrecliente )}}" required autocomplete="nombreclienteE" autofocus>
                                                    @error('nombreclienteE')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Apellido del cliente: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('apellidoclienteE') is-invalid @enderror" id="apellidoclienteE" name="apellidoclienteE" value="{{ old('apellidoclienteE', $cliente->apellidocliente )}}" required autocomplete="apellidoclienteE" autofocus>
                                                    @error('apellidoclienteE')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Dirección del cliente</label>
                                                    <input type="text" class="form-control @error('direccionclienteE') is-invalid @enderror" id="direccionclienteE" name="direccionclienteE" value="{{ old('direccionclienteE', $cliente->direccioncliente )}}" autocomplete="direccionclienteE" autofocus>
                                                    @error('direccionclienteE')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Teléfono del cliente</label>
                                                    <input type="text" class="form-control @error('telefonoclienteE') is-invalid @enderror" id="telefonoclienteE" name="telefonoclienteE" value="{{ old('telefonoclienteE', $cliente->telefonocliente )}}" autocomplete="telefonoclienteE" autofocus onkeypress="return event.charCode >= 48 && event.charCode<=57">
                                                    @error('telefonoclienteE')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Correo eléctronico del cliente</label>
                                                    <input type="email" class="form-control @error('correoclienteE') is-invalid @enderror" id="correoclienteE" name="correoclienteE" value="{{ old('correoclienteE', $cliente->correocliente )}}" autocomplete="correoclienteE" autofocus>
                                                    @error('correoclienteE')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror    
                                                </div>
    
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i> Guardar Cambios</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="eliminarModal{{ $cliente->id }}" tabindex="-1" aria-labelledby="eliminarModalLabel{{ $cliente->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="eliminarModalLabel{{ $cliente->id }}">Eliminar Cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <p>¿Estás seguro de que quieres eliminar el cliente "{{ $cliente->nombrecliente }}"?</p>
                                </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('cliente.destroy', $cliente->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                                        </form>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-window-close"></i> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
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
                            $('#editarclienteModal').modal('hide');
                        }
                    });
                }
                
                @if (session('success'))
                    // Mostrar mensaje de éxito para la actualización
                    showAlert('success', 'Éxito', '{{ session('success') }}', 'top-end', false);
                    // Cerrar el modal de edición automáticamente después de 2 segundos
                    setTimeout(function () {
                        $('#editarclienteModal').modal('hide');
                    }, 2000);
                @elseif (session('error'))
                    // Mostrar mensaje de error para la actualización
                    showAlert('error', 'Error', '{{ session('error') }}', 'top-center', true);
                    @foreach($clientes as $cliente)
                        @if(session('error_id') == $cliente->id)
                            $(document).ready(function () {
                                $('#editarclienteModal{{$cliente->id}}').modal('show');
                            });
                        @endif
                    @endforeach
                @endif

    $(document).ready(function() {
    $('#clienteTable').DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
            },
            responsive: "true",
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