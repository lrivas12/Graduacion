@extends('reporte.plantilla')

@section('content')
    <style>
        @page {
            size: landscape;
        }

        .titulo {
            text-align: center;
            /* Centra el contenido horizontalmente */
            display: flex;
            align-items: center;
            /* Centra el contenido verticalmente */
        }

        .thead-dark {
            background-color: #007BFF !important;
        }
    </style>
    <div class="titulo">
        <br><label id="titulo" for="titulo" class="titulo-reporte">Total de Ingresos desde {{ $fechaini }} hasta
            {{ $fechafin }}</label>
            <br>
    </div>
    <div class="content" id="content">
        <div class="cardTotalVent" id="cardTotalVent">
            <div class="table-responsive">
                <table id="tablaproducto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th style="color: white;">Fecha</th>
                            <th style="color: white;">Total de ingresos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturas as $factura)
                            <tr class="text-center">
                                <td>{{ \Carbon\Carbon::parse ($factura->fechafactura)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($factura->detallepago->cantidaddetallepago > 0 && $factura->detallepago->cantidaddetallepago < $factura->totalapagar)
                                        {{-- Si hay abono y es menor al total a pagar, mostrar el abono --}}
                                        Abonó: C$ {{ number_format($factura->detallepago->cantidaddetallepago, 2, '.', ',') }}
                                    @elseif ($factura->detallepago->cantidaddetallepago > 0 && $factura->detallepago->cantidaddetallepago == $factura->totalapagar && $factura->saldopendiente == 0)
                                        {{-- Si el abono es igual al total a pagar y el saldo pendiente es 0, mostrar el total a pagar --}}
                                        Total: C$ {{ number_format($factura->totalapagar, 2, '.', ',') }}
                                    @else
                                        {{-- Si no hay abono o las condiciones anteriores no se cumplen, mostrar el total a pagar --}}
                                        Total: C$ {{ number_format($factura->totalapagar, 2, '.', ',') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>                                     
                </table><br><br>
                <div style="text-align: right;">
                    <strong>
                        <label for="">Total ingresos: C$
                            {{ number_format($totalVentasRangoFechas, 2, '.', ',') }}</label>
                    </strong>
                </div>
            </div>
            <br>

            <script type="text/php">
                if (isset($pdf)) {
                    $pdf->page_script('
                        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                        $size = 10;
                        $pdf->text(390, 545, "Pág " . $PAGE_NUM . " de " . $PAGE_COUNT, $font, $size);
                    '); 
                }
            </script>
        </div>

    </div>
@endsection