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
                @foreach ($datocliente as $cliente)
                    <div class="titulo">
                        <br>
                        <label for="titulo" for="titulo" class="tituloreporte">Estado de Cuenta
                            {{ $cliente->nombrecliente }} {{ $cliente->apellidocliente }}
                        </label>
                        <br>
                    </div>
                    <table id="producto" class="table table-bordered">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>N. Factura</th>
                                <th>Cliente</th>
                                <th>Fecha Abono</th>
                                <th>Abonos</th>
                                <th>Saldo Pendiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pagos_cliente)
                                @foreach ($pagos_cliente as $pago)
                                    {{-- si el cliente_id del arreglo exterior coincide con el cliente_id del arreglo interior, entonces imprimimos los registros --}}
                                    @if ($cliente->id == $pago->cliente_id)
                                        <tr class="text-center">
                                            <td>{{ $pago->id }}</td>
                                            <td>{{ $pago->nombrecliente }}
                                                {{ $pago->apellidocliente }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pago->fechadetallepago)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ number_format($pago->cantidaddetallepago, 2, '.', ',') }}</td>
                                            <td>{{ number_format($pago->saldodetallepago, 2, '.', ',') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
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
