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
        <h1> Recibo</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')
<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-money-bill-wave-alt"></i> Ver Recibo </h3>
    </div>
</section>
<div class="border border-primary rounded p-3">
           
    <div class="card-header">
           <strong id="id">Detalle de venta Nº {{ $venta->id }}</strong>
   </div>
   <div class="overflow-auto">
       <div class="card-body" >
           <div class="row justify-content-center">
               <div class="col-md-2">
                   <label for="id">{{ __('N° Venta') }}</label>
                   <input id="id" type="text"
                   class="form-control" name="id"
                   value="{{ $venta->id }}"  disabled> 
       
               </div>
               <div class="col-md-2">
                   <label for="nombrecliente">{{ __('Cliente') }}</label>
                   <input id="nombrecliente" type="text"
                   class="form-control" name="nombrecliente"
                   value="{{ $venta->clientes->nombrecliente->}} {{$venta->clientes->apellidocliente }}"  disabled>
               </div>
               <div class="col-md-2">
                   <label for="tipoventa">{{ __('Tipo de venta') }}</label>
                   <input id="tipoventa" type="text"
                   class="form-control" name="tipoventa"
                   value="{{ $venta->tipoventa }}"  disabled>
               </div>
               <div class="col-md-2">
                   <label for="fechaventa">{{ __('Fecha') }}</label>
                   <input id="fechaventa" type="text"
                   class="form-control" name="fechaventa"
                   value="{{ $venta->fechaventa }}"  disabled>
               </div>
               
           </div>
       </div>    
   </div>
   
       
   <div class="table-responsive">
       <table id="showventa" class="table table-bordered">
           <thead class = "text-center">
               <tr>
                   <th>Código</th>
                   <th>Producto</th>
                   <th>Cantidad</th>
                   <th>Categoría</th>
                   <th>precio</th>
                   <th>Subtotal</th>

               </tr>
           </thead>
           <tbody > 
               @foreach ($detalleventas as $detalleventa)
                   <tr class="text-center">
                       
                       <td>{{ $detalleventa->id }}</td>
                       <td>{{ $detalleventa->producto->nombreproducto }}</td>
                       <td>{{ $detalleventa->cantidadventa }}</td>
                       <td>C${{ $detalleventa->precioventa }}</td>
                       <td>C${{ $detalleventa->subtotalventa }}</td>
                       
                       
                       
                   </tr>
                  
               @endforeach
           </tbody>
           <tfoot>
               <tr class="text-center"> 
                   <td class = "text-right" colspan="5"> <strong>Descuento </strong></td> <!-- Celdas vacías para alinear correctamente -->
                   <td><strong> C$ {{ $venta->descuentoventa }}</strong></td>
               </tr>
               <tr class="text-center"> 
                   <td class = "text-right" colspan="5"> <strong>Total </strong></td> <!-- Celdas vacías para alinear correctamente -->
                   <td><strong> C$ {{ $venta->totalventa }}</strong></td>
               </tr>
              
           </tfoot>
          
       </table>
       
   </div>
   
   <div class="col-md-12 mt-2 text-left">
       <a href="{{ route('ventas.index') }}" class="btn btn-secondary" id="btnSalir">Salir</a>
       {{-- <a  href="{{ route('ventas.index') }}" class="btn btn-success" id="btnImprimir">Imprimir</a> --}}
       <label for=""></label>
      
       <form class = "text-right" method="GET" action="{{ route('ventas.index', $venta->id) }}">
           <button type="submit" class="btn btn-outline-success">Imprimir venta</button>
       </form>
   </div>
   
</div> 

</div>
</div>


@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#showventa').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Ruta al archivo de idioma en español
            },
    });
    });
</script>
@endsection