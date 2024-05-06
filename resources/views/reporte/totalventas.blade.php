@extends('reporte.plantilla')

@section('content')
<style>
.titulo
{
    text-align: center;
    display: flex;
    align-items: center;
    font-weight: bold;
}

/* .thead-dark
{
    background-color: rgb(5, 5, 90);
} */
</style>
<div class="titulo">
    <br>
    <label for="titulo" for="titulo" class="tituloreporte">Ventas</label>
</div>

<div class="content" id="content">
    <div class="cardprodgen" id="cardprodgen"> 
            <div class="table-responsive">
                <table id="producto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>N. Factura</th>
                            <th>Cliente</th>
                            <th>Tipo Venta</th>
                            <th>Fecha</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todoventas as $venta)
                        <tr class="text-center">
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->nombrecliente}}  {{ $venta->apellidocliente}} </td>
                            <td>{{ $venta->tipoventa}}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fechafactura)->format('d/m/Y')}}</td>
                            <td>C$ {{ number_format($venta->totalventa, 2, '.', ',')}}</td>
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
