@extends('reporte.plantilla')

@section('content')
    <style>
        .titulo {
            text-align: center;
            display: flex;
            align-items: center;
        }
    </style>

    <div class="content" id="content">
        <div class="cardprodgen" id="cardprodgen">
            <div class="table-responsive">
                <div class="titulo">
                    <br>
                    <label for="titulo" for="titulo" class="tituloreporte">Historial de abonos créditos pendientes de
                        {{ $datocliente->nombrecliente }} {{ $datocliente->apellidocliente }}
                    </label>
                    <br>
                </div>
                @foreach ($pagos as $pagos_cliente)
                    <table id="producto" class="table table-bordered">
                        @for ($i = 0; $i < count($pagos_cliente); $i++)
                            @if ($i == 0)
                                <tr class="thead-dark text-center">
                                    <td colspan="2">Factura N.{{ $pagos_cliente[$i]->id }}</td>
                                    <td colspan="2">Monto C$: {{ $pagos_cliente[$i]->totalventa }}</td>
                                </tr>
                            @endif
                        @endfor
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>N. Abono</th>
                                <th>Fecha Abono</th>
                                <th>Abono</th>
                                <th>Saldo Pendiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos_cliente as $index => $pago)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pago->fechadetallepago)->format('d/m/Y') }}
                                    </td>
                                    <td>C$ {{ number_format($pago->cantidaddetallepago, 2, '.', ',') }}</td>
                                    <td>C$ {{ number_format($pago->saldodetallepago, 2, '.', ',') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
                <br>
                <table id="producto" class="table table-bordered">
                    <tr class="text-center">
                        <td colspan="3">Deuda Total</td>
                        <td colspan="1">C$: {{ $total_deuda }}</td>
                    </tr>
                </table>
                </br>
            </div>
            <script type="text/php">
                if(isset($pdf))
                {
                    $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size=10;
                    $pdf->text(270,780, "Pág" . $PAGE_NUM . "de" . $PAGE_COUNT, $font, $size);');
                }

            </script>
        </div>
    </div>
@endsection
