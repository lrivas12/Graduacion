@extends('layouts.index')

@section('title', 'Categorias')

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
        <h1>Categorías</h1>
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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaCategoria.jpg')}}" class="img-fluid" alt="Ayuda Categoria" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-boxes"></i> Generar Categoría </h3>
    </div>
    </section>

<div class="card">
    <div class="card-body">
    <!-- Formulario para crear una nueva categoría -->
    <form method="POST" action="{{ route('categoria.store') }}">
       @csrf
       <label style="font-style: italic; ">
           Los campos marcados con  <span style=" color: red;">*</span> son obligatorios</span>
       </label>
       
        <div class=" row">
          <div class="col-md-4 ">
               <label for="nombre">Nombre de la categoría: <span class="text-danger">*</span></label>
               <input type="text" class="form-control @error('nombrecategoria') is-invalid @enderror"  id="nombrecategoria" name="nombrecategoria" required autocomplete="nombrecategoria" value="{{ old('nombrecategoria')}}" autofocus>
                @error('nombrecategoria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-md-4 ">
                    <label for="nombre">Tipo de la categoría: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nombrecategoria') is-invalid @enderror"  id="tipocategoria" name="tipocategoria" required autocomplete="tipocategoria" value="{{ old('tipocategoria')}}" autofocus>
                    @error('nombrecategoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i>Agregar</button>
        </form>
   <br>
   <h2>Lista de Categorías</h2>
   <table id="categoriaTable" class="table table-bordered">
       <thead class="text-center">
           <tr>
               <th>Id</th>
               <th>Nombre</th>
               <th>Tipo</th>
               <th>Acciones</th>
           </tr>
            </thead>
                <tbody class="text-center">
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->id }}</td>
                        <td>{{$categoria->nombrecategoria }}</td>
                        <td>{{$categoria->tipocategoria}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                            
                            <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#editarModal{{$categoria->id}}"><i class="fas fa-edit"></i> Editar</button>
                            <a>                            
                                <!-- Se crea los botones dentro del formulario donde la acción hace el llamado a la ruta correspondiente -->
                                <form method="POST" action="{{ route('categoria.desactivate', ['id' => $categoria->id]) }}">
                                    @csrf
                                    <!--Se crea la condición si ya está almacenado el valor 1 por defecto, 
                                        que significa activo muestra un botón de color verde sino de color rojo -->
                                    @if ($categoria->estadocategoria == 1)
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
                            </div>
                        </td>
                   
                    </tr>
                    <div class="modal fade" id="editarModal{{ $categoria->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $categoria->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel{{ $categoria->id }}">Editar Categoría</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                               <!-- Formulario de edición de categoría -->
                               <form id="editarForm{{ $categoria->id }}" method="POST" action="{{ route('categoria.update', $categoria->id) }}">
                                   @csrf
                                   @method('PUT')
       
                                   <div class="form-group">
                                       <label for="nombre">Nombre de la categoría: <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control @error('nombrecategoria') is-invalid @enderror" id="nombrecategoria" name="nombrecategoria" value="{{ old('nombrecategoria', $categoria->nombrecategoria )}}" required autocomplete="nombrecategoria" autofocus>
                                       @error('nombrecategoria')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror    
                                    </div>
                                    <div class="form-group">
                                       <label for="tipo">Tipo de la categoría: <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control @error('tipocategoria') is-invalid @enderror" id="tipocategoria" name="tipocategoria" value="{{ old('tipocategoria', $categoria->tipocategoria )}}" required autocomplete="tipocategoria" autofocus>
                                       @error('tipocategoria')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i> Guardar Cambios</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cancelar</button>
                                        </div>
                                    </form>
                                        
                                        
                                    </div>
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
                            $('#editarForm').modal('hide');
                        }
                    });
                }

                @if (session('success'))
                    // Mostrar mensaje de éxito para la actualización
                    showAlert('success', 'Éxito', '{{ session('success') }}', 'top-end', false);
                    // Cerrar el modal de edición automáticamente después de 2 segundos
                    setTimeout(function () {
                        $('#editarForm').modal('hide');
                    }, 2000);
                @elseif (session('error'))
                    // Mostrar mensaje de error para la actualización
                    showAlert('error', 'Error', '{{ session('error') }}', 'top-center', true);
                    @foreach($categorias as $categoria)
                        @if(session('error_id') == $categoria->id)
                            $(document).ready(function () {
                                $('#editarForm{{$categoria->id}}').modal('show');
                            });
                        @endif
                    @endforeach
                @endif

        $(document).ready(function() {
        $('#categoriaTable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
            },
                responsive:"true",
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


