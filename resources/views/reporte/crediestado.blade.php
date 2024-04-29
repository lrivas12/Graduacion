@extends('reporte.plantilla')

@section('content')
    <style>
        .titulo {

            text-align: center;
            display: flex;
            align-items: center;
        }
    </style>


    <div class="titulo">
        <br>
        <label for="titulo" for="titulo" class="tituloreporte">Estado de Cuenta
            {{ $datocliente->nombrecliente }} {{ $datocliente->apellidocliente }}
        </label>
        <br>

    </div>
    <div class="content" id="content">
        <div class="cardprodgen" id="cardprodgen">
            <div class="table-responsive">
                <table id="producto" class="table table-bordered">
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
                                <td>{{ \Carbon\Carbon::parse($pago->fechapago)->format('d/m/Y') }}</td>
                                <td>{{ $pago->nombrecliente }} {{ $pago->apellidocliente }}</td>
                                <td>C$ {{ $pago->totalventa }}</td>
                                <td>C$ {{ $pago->deuda_pendiente }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
