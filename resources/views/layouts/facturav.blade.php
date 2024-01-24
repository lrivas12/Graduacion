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
        <h1> Recibos</h1>
    <i class="btn far fa-question-circle" title="Ayuda"  data-toggle="modal" data-target="#myModal"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content d-flex align-items-center" style="max-width: 100%; height: auto;">
        
        <!-- Contenido del modal -->
        <div class="modal-body">
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaFacturaH.jpg')}}" class="img-fluid" alt="Ayuda Factura" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>

<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-money-bill-wave-alt"></i> Historial de Recibos </h3>
    </div>
</section>
<div class="card">
    <div class="card-body">

    
    <div class="row justify-content-center">
        <div class="card" style="border: 1px solid black;">
            <div class="card-header">
                <strong>Listado de Ventas &nbsp;&nbsp;&nbsp;

                    <a  href="{{ route('factura.create') }}"  type="button" title= "Crear Venta">
                        <i class="fas fa-plus fa-lg text-info" ></i>
                    </a>  
                </strong>
            </div>
            <div class="overflow-auto">
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered" id="listaventa">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Tipo venta</th>
                                    <th>Fecha</th>
                                    {{-- <th>Saldo</th> agregar el credito, mostrarlo--}} 
                                    <th>Total</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $venta->cliente->nombrecliente}}  {{ $venta->cliente->apellidocliente}} </td>
                                        <td>{{ $venta->tipoventa}}</td>
                                        <td>{{ \Carbon\Carbon::parse($venta->fechafactura)->format('d/m/Y')}}</td>
                                        {{-- <td>{{ $detalle->subtotal}}</td> --}}
                                        {{--  <td>{{ $Venta->saldo}}</td> relacionar con detalle de ventas --}}
                                        <td>C$ {{ number_format($venta->totalventa, 2, '.', ',')}}</td>
                                        <td> <!-- Los botones para desactivar o activar aparecen según el estado almacenado en la base de datos -->
                                            <div class="d-flex align-items-center">
                                                <a  href="{{ route('factura.show',$venta->id) }}" style="margin-right: 10px;" title="Visualizar venta">
                                                    <i class="fas fa-eye fa-lg text-warning" ></i>
                                                </a> 
                                                </td>
                                                <td>
                                                <a href="{{ route('facturas.Imprimirfactura', $venta->id) }}" title= "Imprimir Venta"> 
                                                    <i class="fas fa-print text-success" ></i>
                                                </a>
                                            </div>    
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
</div>

@endsection

@section('js')
<script>
        $(document).ready(function() {
            $('#listaventa').DataTable({
                "language": {
                    "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
                },
        });
        });
</script>
@endsection