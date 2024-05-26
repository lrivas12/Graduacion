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
                    <label for="titulo" for="titulo" class="tituloreporte">Estado de Cuenta General
                    </label>
                    <br>
                </div>
                <table id="producto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Cliente</th>
                            <th>Total Credito</th>
                            <th>Saldo Deuda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosCliente['cliente_id'] as $index => $cliente_id) 
                        {{-- usamos la key cliente_id arriba para poder determinar la cantidad de iteraciones dependiendo la cantidad de registros guardados en ESA key --}}
                            <tr>
                                <td>{{ $datosCliente['nombrecliente'][$index] }}
                                    {{ $datosCliente['apellidocliente'][$index] }}</td>
                                <td>{{ $datosCliente['totalventa'][$index] }}</td>
                                <td>{{ $datosCliente['saldo_deuda'][$index] }}</td>
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
