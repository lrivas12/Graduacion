@extends('layouts.index')

@section('title', 'Empresa')

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
        <h1>Empresa</h1>
        <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')


<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-store"></i> Registrar Empresa </h3>
    </div>
    </section>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('empresa.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                {{-- <div class="col-md-4">
                    <label for="logo">{{ __('Logo Actual') }}</label><br>
                    @if ($empresa->logo)
                        <img src="{{ asset($empresa->logo) }}" alt="Logo actual de la empresa" style="max-width: 100px;"><br>
                    @else
                        <p>No hay logo actual</p>
                    @endif
                </div> --}}
                <div class="col-md-4">
                    <label for="logo">Logo de Empresa: <span class="text-danger">*</span></label>
                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" {{-- onchange="previewLogo(this);" --}}>
                    @error('logo')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="nombre">Nombre de Empresa: <span class="text-danger">*</span></label>
                    <input class="form-control @error('nombreempresa') is-invalid @enderror" type="text" id="nombreempresa" name="nombreempresa">
                    @error('nombreempresa')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="telefono">Teléfono de Empresa: <span class="text-danger">*</span></label>
                    <input class="form-control @error('contactoempresa') is-invalid @enderror" type="text" id="contactoempresa" name="contactoempresa">
                    @error('contactoempresa')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>  
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="ruc">Numero RUC de Empresa: <span class="text-danger">*</span></label>
                    <input class="form-control @error('rucempresa') is-invalid @enderror" type="text" id="rucempresa" name="rucempresa">
                    @error('rucempresa')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="direccion">Dirección de Empresa: <span class="text-danger">*</span></label>
                    <input class="form-control @error('direccionempresa') is-invalid @enderror" type="text" id="direccionempresa" name="direccionempresa">
                    @error('direccionempresa')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Agregar</button>
        </form>
        <br>
        
        <table id="empresaTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>RUC</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if ($empresa->logo) 
                            <img src="{{ asset('storage/empresa/' . $empresa->logo) }}"
                            style="max-width: 50px; border-radius: 50%;">
                    @else
                        <img src="{{ asset('img/Placeholderlogo.jpg') }}"
                            alt="Imagen por defecto">
                    @endif</td>
                        <td>{{$empresa->nombreempresa}}</td>
                        <td>{{$empresa->contactoempresa}}</td>
                        <td>{{$empresa->rucempresa}}</td>
                        <td>{{$empresa->direccionempresa}}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#editarModal{{$empresa->id}}"><i class="fas fa-edit"></i> Editar</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editarModal{{ $empresa->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $empresa->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel{{ $empresa->id }}">Editar Empresa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                                    <!-- Formulario de edición de empresa -->
                                    <form id="editarForm{{ $empresa->id }}" method="POST" action="{{ route('empresa.update', $empresa->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="logo">Logo empresa: </label>
                                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo', $empresa->logo)}}">
                                            <br>
                                            @if ($empresa->logo)
                                                <div class="current-image">
                                                <img src="{{ asset('storage/producto/' . $empresa->logo) }}"
                                                alt="Vista previa de "
                                                style="display: none; max-width: 100px; border-radius: 50%;">
                                            
                                            @else
                                             <p>No hay imagen</p>
                                            @endif   
                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                             @enderror
                                        </div> 
                                        <div class="form-group">
                                            <label for="nombre">Nombre de la Empresa: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nombreempresa') is-invalid @enderror" id="nombreempresa" name="nombreempresa" value="{{ old('nombreempresa', $empresa->nombreempresa )}}" required autocomplete="nombreempresa" autofocus>
                                            @error('nombreempresa')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror    
                                         </div>
                                         <div class="form-group">
                                            <label for="nombre">Teléfono de la Empresa: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('contactoempresa') is-invalid @enderror" id="contactoempresa" name="contactoempresa" value="{{ old('contactoempresa', $empresa->contactoempresa )}}" required autocomplete="contactoempresa" autofocus>
                                            @error('contactoempresa')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror    
                                         </div>
                                         <div class="form-group">
                                            <label for="nombre">Numero RUC de la Empresa: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('rucempresa') is-invalid @enderror" id="rucempresa" name="rucempresa" value="{{ old('rucempresa', $empresa->rucempresa )}}" required autocomplete="rucempresa" autofocus>
                                            @error('rucempresa')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror    
                                         </div>
                                         <div class="form-group">
                                            <label for="nombre">Dirección de la Empresa: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('direccionempresa') is-invalid @enderror" id="direccionempresa" name="direccionempresa" value="{{ old('direccionempresa', $empresa->direccionempresa )}}" required autocomplete="direccionempresa" autofocus>
                                            @error('direccionempresa')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror    
                                         </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i> Guardar Cambios</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Cancelar</button>
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
@endsection

@section('js')
<script>
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

    $(document).ready(function() {
        $('#empresaTable').DataTable({
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

</script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


@endsection