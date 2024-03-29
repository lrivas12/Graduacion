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
            <img src="{{asset('/vendor/adminlte/dist/img/AyudaReporte.jpg')}}" class="img-fluid" alt="Ayuda Reporte" style="max-width: 1000px; height: auto;">
        </div>
        <!-- Botón de cierre del modal -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>


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

                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="tipoinventariofactura" class="form-control" id="tipoinventariofactura" onchange="MostrarDivFactura()">
                        <option value="">Seleccione el reporte</option>
                        <option value="verclientes">Lista de Clientes</option>
                        <option value="verfactura">lista de Facturas</option>
                    </select>
                    
                    <div class="row">
                        <div class="col-md-6" id="fechini" style="display: none;" onchange="MostrarDivFactura()">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechini" value="{{$FechIniFactu ?? ''}}" id="fechaini" {{-- onchange="validarfecha()" --}} required>
                        </div>
                        <div class="col-md-6" id="fechfin" style="display: none;" onchange="MostrarDivFactura()">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" value="{{$FechaFinFactu ?? ''}}" name="fechfin" id="fechfin" {{-- onchange="validarfecha()" --}} required>
                        </div>
                    </div>

                    <div class="contenido" id="listclientes" style="display: none;">
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
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="tiporeporteInventario" class="form-control" id="tiporeporteInventario" onchange="MostrarDivInv()">
                        <option value="">Seleccione el reporte</option>
                        <option value="productosge">Inventario General</option>
                        <option value="prodagot">Productos a Agotarse</option>
                        <option value="comprasxfech">Compras por fecha</option>
                    </select>
                    <br>
                    <div class="row">
                        <div class="col-md-6" id="FechInINV" style="display: none;" onchange="MostrarDivInv()">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechaini" value="{{$fechaInicio ?? ''}}" id="fechaini"{{--  onchange="validarfecha()" --}} required>
                        </div>
                        <div class="col-md-6" id="FechFinINV" style="display: none;" onchange="MostrarDivInv()">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" value="{{$fechaFin ?? ''}}" name="fechafin" id="fechafin" {{-- onchange="validarfecha()" --}} required>
                        </div>
                    </div>
                    <div class="contenido" id="cardprodgen" style="display: none">
                        <div class="text-center">
                            <br>
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
                                            <td>{{$producto->id}}</td>
                                            <td>{{$producto->nombreproducto}}</td>
                                            <td>{{$producto->nombrecategoria}}</td>
                                            <td  style="color: {{ $producto->cantidadproducto <= $producto->stockminimo ? 'red' : 'green' }}">
                                                {{ $producto->cantidadproducto }}
                                            </td>
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
                    <div class="contenido" id="cardprodagot" style="display: block">
                        <div class="text-center">
                          <label for="">Producto Agotarse</label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="producto" class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Stock Minimo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productosProximosAgotarse as $prodagot)
                                        <tr class="text-center">
                                            <td>{{$prodagot->nombreproducto}}</td>
                                            <td>{{$prodagot->nombrecategoria}}</td>
                                            <td style="color:{{ $producto->cantidadproducto <= $producto->stockminimo ?  'red' : 'green' }}">
                                                {{ $prodagot->cantidadproducto}}
                                            </td>
                                            <td>{{$prodagot->stockminimo}}</td>
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
                    
                    <label for="">Seleccionar Tipo de Reporte</label>
                    <select name="" class="form-control" id="TiporeporteCredito" onchange="MostrarDivCredito()">
                        <option value="">Seleccione el reporte</option>
                        <option value="estadcuenta">Estado de cuenta</option>
                    </select>

                    <div class="contenido" id="estadcuenta" style="display: none">
                        <div class="text-center">
                            <br>
                          <label for="">Estado de Cuenta</label>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="estadocuenta" class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Saldo Pendiente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                <tr class="text-center">
                           
                                    <td>{{\Carbon\Carbon::parse ($pago->fechapago)->format('d/m/Y')}}</td>
                                    <td>{{$pago->factura->cliente->nombrecliente}} {{$pago->factura->cliente->apellidocliente}}</td> 
                                    <td>C$ {{ number_format($pago->factura->totalventa, 2, '.', ',')}}</td>
                                    <td>C$ {{ number_format($pago->cantidadpago - $pago->detallepago->sum('cantidaddetallepago'), 2, '.', ',')}}</td>
                                
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/estadcuenta-pdf')}}" class="btn btn-outline-info"><i class="fas fa-print"></i> Generar Reporte</a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>


@section('js')
<script>

    var tipoinventariofactura;

        function MostrarDivFactura() {
            tipoinventariofactura = document.getElementById('tipoinventariofactura').value;
            var listclientes = document.getElementById('listclientes');
            var FechIniFactu = document.getElementById('fechini');
            var FechaFinFactu = document.getElementById('fechfin');

            // Asegura que todos los elementos estén ocultos al principio
            listclientes.style.display = 'none';
            FechIniFactu.style.display = 'none';
            FechaFinFactu.style.display = 'none';

            if (tipoinventariofactura === 'verfactura') {
                FechIniFactu.style.display = 'block';
                FechaFinFactu.style.display = 'block';
            } else if (tipoinventariofactura === 'verclientes') {
                listclientes.style.display = 'block';
            }
        }

        $(document).ready(function() {
            var fechini = $('#fechini');
            var fechfin = $('#fechfin');
            var FechIniFactu = $('#FechIniFactu');
            var FechaFinFactu = $('#FechaFinFactu');
            $('#fechfin').change(function() {
                mostrarUrl();
            });

            function mostrarUrl() {
                var ruta = "";
                var start_date_val = fechini.val();
                var end_date_val = fechfin.val();
                console.log(fechini);

                if (tipoinventariofactura == 'verfactura') {
                    ruta = `/totalventas-pdf?fechini=${start_date_val}&fechfin=${end_date_val}`;
                }

                if (ruta !== "") {
                    window.open(ruta, '_blank');
                }
            }
        });    

</script>

<script>

    
var tiporeporteInventario;
    function MostrarDivInv()
    {
        var tiporeporteInventario = document.getElementById('tiporeporteInventario').value;
        var cardprodgen = document.getElementById('cardprodgen');
        var cardprodagot = document.getElementById('cardprodagot');
        var FechInINV = document.getElementById('FechInINV');
        var FechFinINV = document.getElementById('FechFinINV');

        cardprodagot.style.display = 'none';
        cardprodgen.style.display = 'none';
        FechInINV.style.display = 'none';
        FechFinINV.style.display = 'none';


        if (tiporeporteInventario === 'comprasxfech') {
            FechInINV.style.display = 'block';
            FechFinINV.style.display = 'block';
        }else if (tiporeporteInventario === 'productosge') {
        cardprodgen.style.display = 'block'; // Mostrar el contenido
        } else if (tiporeporteInventario === 'prodagot') {
        cardprodagot.style.display = 'block'; // Mostrar el contenido
        }

        $(document).ready(function() {
            var fechaini = $('#fechaini');
            var fechafin = $('#fechafin');

            $('#fechafin').change(function() {
                mostrarUrl();
            });

            function mostrarUrl() {
                var ruta = "";
                var start_date_val = fechaini.val();
                var end_date_val = fechafin.val();
                console.log(fechini);

                if (tiporeporteInventario == 'comprasxfech') {
                    ruta = `/comprasfecha-pdf?fechaini=${start_date_val}&fechafin=${end_date_val}`;
                }

                if (ruta !== "") {
                    window.open(ruta, '_blank');
                }
            }
        });    

    }
</script>

<script>
    var TiporeporteCredito;

    MostrarDivCredito();
    
</script>
@endsection
@endsection