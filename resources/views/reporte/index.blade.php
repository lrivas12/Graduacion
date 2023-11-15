@extends('layouts.index')

@section('title', 'Reportes')
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
        .btnreport{
            background-color: transparent;
            border-radius: 20%;
            width: 250px;
            height: 270px;
        }
        .btnreport img{
            border-radius: 20%;
            width: 230px;
            height: 250px;
        }
        .sectionR{
            background-color: rgb(17, 0, 94);
            border-radius: 10px 10px 0 0;
            padding: 10px;
        }
        .sectionR h3{
            color: white;
        }
    </style>

@stop
@section('content_header')
    <section class="section">
        <h1> Reportes</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')
    <div class="card">
        <section class="sectionR"><h3><i class="fas fa-print"></i> Generar Reporte</h3></section>
        <div class="card-body">

            <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId" type="button"><img src="vendor/adminlte/dist/img/factura.png" alt=""></button>
                            <h3><strong>Ventas</strong></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId2" type="button"><img src="vendor/adminlte/dist/img/IM.png" alt=""></button>
                            
                            <h3><strong>Inventario</strong></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <button class="btnreport" data-toggle="modal" data-target="#modelId3" type="button"><img src="vendor/adminlte/dist/img/credito.jpg" alt=""></button>
                            
                            <h3><strong>Crédito</strong></h3>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Facturación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechini" id="fechini">
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" name="fechfin" id="fechfin">
                        </div>
                    </div>
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="tipoinventariofactura" class="form-control" id="tipoinventariofactura">
                        <option value="">Seleccione el reporte</option>
                        <option value="verclientes">Lista de Clientes</option>
                        <option value="verfactura">lista de Facturas</option>
                    </select>

                    <div class="contenido" id="listclientes" style="display: block">
                        <div class="text-center">
                          <label for="">Listado de Clientes</label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="producto" class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr class="text-center">
                                           
                                            <td>{{$cliente->id}}</td>
                                            <td>{{$cliente->nombrecliente}}</td>
                                            <td>{{$cliente->apellidocliente}}</td>
                                            <td>{{$cliente->telefonocliente}}</td>
                                            <td>{{$cliente->correocliente}}</td>
                                            <td>{{$cliente->direccioncliente}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/listclien-pdf')}}" class="btn btn-outline-info"><i class="fas fa-print"></i> Generar Reporte</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Inventario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechini" id="fechini">
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" name="fechfin" id="fechfin">
                        </div>
                    </div>
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="tiporeporteInventario" class="form-control" id="tiporeporteInventario" onchange="mostrarInventario()">
                        <option value="">Seleccione el reporte</option>
                        <option value="productosge">Inventario General</option>
                        <option value="prodagot">Productos a Agotarse</option>
                    </select>

                    <div class="contenido" id="cardprodgen" style="display: block">
                        <div class="text-center">
                          <label for="">Inventario General</label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="producto" class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Stock Minimo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr class="text-center">
                                            @php
                                                $existenciaClase = '';
                                                            
                                                if ($producto->cantidadproducto <= $producto->stockminimo) {
                                                $existenciaClase = 'btn btn-danger'; // Clase danger de AdminLTE (rojo)
                                                } elseif ($producto->cantidadproducto <= 30) {
                                                $existenciaClase = 'btn btn-warning'; // Clase warning de AdminLTE (amarillo)
                                                } else {
                                                $existenciaClase = 'btn btn-success'; // Clase success de AdminLTE (verde)
                                                }
                                            @endphp
                                            <td>{{$producto->id}}</td>
                                            <td>{{$producto->nombreproducto}}</td>
                                            <td>{{$producto->nombrecategoria}}</td>
                                            <td>
                                            <button class="{{ $existenciaClase }}" >
                                                {{ $producto->cantidadproducto }}
                                            </button></td>
                                            <td>{{$producto->stockminimo}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/productogen-pdf')}}" class="btn btn-outline-info"><i class="fas fa-print"></i> Generar Reporte</a>
                        </div>
                    </div>
                    <br>
                    <div class="contenido" id="cardprodagot" style="display: none">
                        <div class="text-center">
                          <label for="">Producto Agotarse</label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="producto" class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Stock Minimo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr class="text-center">
                                            @php
                                            $existenciaClase = '';
                                                        
                                            if ($producto->cantidadproducto <= $producto->stockminimo) {
                                            $existenciaClase = 'btn btn-danger'; // Clase danger de AdminLTE (rojo)
                                            } elseif ($producto->cantidadproducto <= 10) {
                                            $existenciaClase = 'btn btn-warning'; // Clase warning de AdminLTE (amarillo)
                                            } else {
                                            $existenciaClase = 'btn btn-success'; // Clase success de AdminLTE (verde)
                                            }
                                        @endphp
                                            <td>{{$producto->id}}</td>
                                            <td>{{$producto->nombreproducto}}</td>
                                            <td>{{$producto->nombrecategoria}}</td>
                                            <td>
                                                <button class="{{ $existenciaClase }}" > {{ $producto->cantidadproducto }}</button>
                                            </td>
                                            <td>{{$producto->stockminimo}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/productoag-pdf')}}" class="btn btn-outline-info"><i class="fas fa-print"></i> Generar Reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId3" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reportes de Control de Crédito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechini" id="fechini">
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" name="fechfin" id="fechfin">
                        </div>
                    </div>
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="" class="form-control" id="">
                        <option value="">Seleccione el reporte</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close	"></i> Close</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $function mostrarInventario()
    {
        var tipoinventario = 
        document.getElementById('tiporeporteInventario').value;
            var cardprodgen = document.getElementById('cardprodgen');
            var cardprodagot = document.getElementById('cardprodagot');

            if (tiporeporteInventario === 'productosge') {
                cardprodgen.style.display = 'block'; // Mostrar el contenido
            } else {
                cardProGen.style.display = 'none'; // Ocultar el contenido
            }
            if (tiporeporteInventario === 'prodagot') {
                cardprodagot.style.display = 'block'; // Mostrar el contenido
            } else {
                cardprodagot.style.display = 'none'; // Ocultar el contenido
        }
    }
</script>

@endsection