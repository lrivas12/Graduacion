<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
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

        table,
        th,
        td {
            border: none;
        }
    </style>
</head>

<body>
    @php
        // debemos user base64_encode para convertir todo el valor de logo de la tabla empresas a string
        // la imagen era la que daba problemas con los reportes
        $imagenEmpresa = base64_encode(file_get_contents(public_path($empresa->logo)));
    @endphp
    <div class="header" style="text-align: center;">
        <img src="data:image/png;base64,{{ $imagenEmpresa }}" id="logo" alt="Logo de la empresa"
            style="width: 70px; height: 70px; filter: grayscale(100%);">
        <h3 style="width: 100%; text-align: center; font-style: italic;">
            {{ $empresa->nombreempresa }}
        </h3>
    </div>
    <br>
    <label style="text-align: center; display: block; margin: 0 auto;">RUC: {{ $empresa->rucempresa }}</label><br>
    <label style="text-align: center; display: block; margin: 0 auto;">Contacto:
        {{ $empresa->contactoempresa }}</label><br>

    <br><label>Factura Nº {{ $ventas->id }} </label>
    <br><label>Fecha: {{ Carbon\Carbon::parse($ventas->fechafactura)->format('d/m/Y') }}</label><br>
    <br><label>Cliente: {{ $ventas->cliente->nombrecliente }} {{ $ventas->cliente->apellidocliente }}</label>
    <br><label>Creado Por:: {{ $ventas->User->usuario }}</label>
    <br><br>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label for=""
        style="text-align: center; display: block; margin: 0 auto;">{{ $ventas->tipoventa === 'contado' ? 'Factura de contado' : 'Factura de crédito' }}</label>

    <table>
        @foreach ($ventas->detallefactura as $detalle)
            <hr class="hr">
            <tr>
                <td style="width:180px; text-align:left;">{{ $detalle->producto->nombreproducto }}</td>
            </tr>
            <tr>

                <td style="width:150px; text-align:right;">{{ $detalle->cantidadventa }} |
                    {{ $detalle->producto->categoria->nombrecategoria }}| --x--> C$
                    {{ $detalle->producto->precioproducto }} = C$ {{ $detalle->subtotalventa }}</td>
                <br>
            </tr>
        @endforeach

    </table>
    <hr>

    <label for="">Neto: C$ {{ number_format($detalle->subtotalventa, 2) }}</label><br>
    <label for="">Descuento: C$ {{ number_format($ventas->descuentoventa, 2) }}</label>
    <hr>
    <label for="">Total: C$ {{ number_format($ventas->totalventa, 2) }}</label>

    @if ($ventas->tipoventa === 'credito')
        <br><br>
        <table border="0" style="text-align: center;">
            <tr>
                <th>Adelanto</th>
                <th>Saldo</th>
                <th>Fecha</th>
            </tr>
            @foreach ($ventas as $detapagos)
                @if ($ventas->detallepagos)
                    @if (Carbon\Carbon::parse($venta->detallepagos->fechapago)->format('Y-m-d') === $ventas->fechaventa)
                        <tr class="text-center">
                            <td>C$ {{ $ventas->detallepagos->cantidaddetallepago }}</td>
                            <td>C$ {{ $ventas->detallepagos->saldodetallepago }}</td>
                            <td>{{ Carbon\Carbon::parse($ventas->detallepagos->fechapago)->format('d/m/Y') }}</td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </table>

        <!-- Firma del Cliente -->
        <p style="text-align: center;">_______________________________<br>Firma del cliente</p>

        <!-- Firma del Vendedor -->
        <p style="text-align: center;">_______________________________<br>Firma del vendedor</p>
    @endif
    <p style="text-align: center;">--------------------------------------------<br>¡Muchas gracias por su compra!
    </p>

</body>

</html>
