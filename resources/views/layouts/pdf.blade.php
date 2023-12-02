<!DOCTYPE html>
<html>
<head>
    <title>Recibo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
       /*  #header {  
            background-color: #f2f2f2;
            color: #333;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        } */

        .center {
            text-align: center;
        }
        .italic {
            font-style: italic;
        }

        .hr {
            margin-top: 0.5px;
            margin-bottom: 1px;
            border-top: 1px solid #000;
        }

        table {
            border-collapse: collapse;
           /*  width: 100%; */
        }

        table, th, td {
            border: none;
        }

    </style>
</head>
<body>
    <img id="logo" src="{{ asset($empresa->logo) }}" alt="Logo de la empresa" style="width: 70px; height: auto; margin-bottom: 0px; filter: grayscale(100%);">
    <div style="width: 100%; padding-left: 50px; text-align: center; font-style: italic;">{{ $empresa->nombreempresa }}</div>
    <br>
    <label style="text-align: center; display: block; margin: 0 auto;">RUC: {{ $empresa->rucempresa }}</label><br>
    <label style="text-align: center; display: block; margin: 0 auto;">Contacto: {{ $empresa->contactoempresa }}</label><br>
    
        <br><label>Factura Nº {{ $venta->id }} </label>
        <br><label>Fecha: {{ Carbon\Carbon::parse($venta->fechaventa)->format('d/m/Y') }}</label><br>
        <br><label>Cliente: {{ $venta->clientes->nombrecliente }} {{ $venta->clientes->apellidocliente }}</label>
        <br><label>Creado Por:: {{ $venta->usuarios->usuario }}</label>
        <br><br>
    
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label for="" style="text-align: center; display: block; margin: 0 auto;">{{ $venta->tipoventa === 'contado' ? 'Factura de contado' : 'Factura de crédito' }}</label>
        
        <table>
                 @foreach ($venta->detalleventas as $detalle)
                 <hr class="hr">  
                     <tr>
                         <td style="width:180px; text-align:left;">{{ $detalle->producto->nombreproducto }}</td>
                     </tr>
                     <tr>
                         
                         <td style="width:150px; text-align:right;">{{ $detalle->cantidadventa }} | {{ $detalle->producto->categoria->nombrecategoria }}| --x--> C$  {{ $detalle->producto->precioproducto }} = C$ {{ $detalle->subtotalventa }}</td>
                         <br>
                     </tr>
                 @endforeach
                
         </table>
         <hr>

         <label for="">Neto: C$ {{ number_format($venta->totalventa - $venta->descuentoventa, 2) }}</label><br>
         <label for="">Descuento: C$ {{ number_format($venta->descuentoventa, 2) }}</label><hr>
         <label for="">Total: C$ {{ number_format($venta->total, 2) }}</label>
         
         @if($venta->tipoventa === 'credito')
         <br><br>
             <table border="0" style="text-align: center;">
                 <tr>
                     <th>Adelanto</th>
                     <th>Saldo</th>
                     <th>Fecha</th>
                 </tr>
                 @foreach ($detallepagos as $detalle)
                         @if(Carbon\Carbon::parse($detalle->fechapago)->format('Y-m-d') === $venta->fechaventa)
                         <tr class="text-center">
                            <td>C$ {{ $detalle->cantidaddetallepago }}</td>
                            <td>C$ {{ $detalle->saldodetallepago }}</td>
                            <td>{{ Carbon\Carbon::parse($detalle->fechapago)->format('d/m/Y') }}</td>
                        </tr>
                    @endif
            @endforeach
        </table>

        <!-- Firma del Cliente -->
       <p style="text-align: center;">_______________________________<br>Firma del cliente</p>

       <!-- Firma del Vendedor -->
       <p style="text-align: center;">_______________________________<br>Firma del vendedor</p>
   @endif
       <p style="text-align: center;">--------------------------------------------<br>¡Muchas gracias por su compra!</p>
</body>
</html>