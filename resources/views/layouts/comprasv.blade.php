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
        <h1>Compras</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop


@section('content')

<div class="container">

    <section class="sectionT2">
        <div class="header">
            <h3><i class="fas fa-shopping-cart"></i> Ver Compra </h3>
        </div>
        </section>
    
        <div class="border border-primary rounded p-3">
           
             <div class="card-header">
                    <strong id="id">Detalle de compra Nº {{ $compra->id }}</strong>
                </div>
                <div class="overflow-auto">
                    <div class="card-body" >
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <label for="proveedor">{{ __('Proveedor') }}</label>
                                <input id="proveedor" type="text"
                                class="form-control" name="proveedor"
                                value="{{ $compra->proveedor->razonsocialproveedor }}"  disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="fechacompra">{{ __('Fecha compra') }}</label>
                                <input id="fechacompra" type="text"
                                class="form-control" name="fechacompra"
                                value="{{ $compra->fechacompra }}"  disabled>
                            </div>
                            <div class="col-md-3">
                                <label for=""></label>
                               
                                <form method="GET" action="{{ route('compras.edit', $compra->id) }}">
                                    <button type="submit" class="btn btn-outline-success">Editar compra</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="table-responsive">
                    <table id="showCompra" class="table table-bordered">
                        <thead class = "text-center">
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Costo</th>
                                <th>Subtotal</th>
    
                            </tr>
                        </thead>
                        <tbody > 
                            @foreach ($detallecompras as $detallecompra)
                                <tr class="text-center">
                                    <td>{{ $detallecompra->id }}</td>
                                    <td>{{ $detallecompra->producto->nombreproducto}}</td>
                                    <td>{{ $detallecompra->cantidadcompra }}</td>
                                    <td>C$ {{ $detallecompra->costocompra }}</td>
                                    <td>C$ {{ $detallecompra->subtotalcompra }}</td>
 
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center"> 
                                <td class = "text-right" colspan="4"> <strong>Total </strong></td> <!-- Celdas vacías para alinear correctamente -->
                                <td><strong> C$ {{ $compra->totalcompra }}</strong></td>
                            </tr>
                        </tfoot>
                       
                    </table>
                    
                </div>
                
                <div class="col-md-12 mt-2 text-left">
                    <a href="{{ route('compras.index') }}" class="btn btn-danger" id="btnSalir">Salir</a>
                </div>
                
                
            </div> 
    
        </div>
    
    
    @endsection
    
    @section('js')
    <script>
       $(document).ready(function () {
            var config = {
                "language": {
                    "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Ruta al archivo de idioma en español
                }
            };

            $('#showCompra').DataTable(config);
            
        });
    </script>
    
    @endsection