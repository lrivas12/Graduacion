@extends('reporte.plantilla')

@section('content')
<style>
.titulo
{

    text-align: center;
    display: flex;
    align-items: center;
}

/* .thead-dark
{
    background-color: rgb(5, 5, 90);
} */
</style>
<div class="titulo">
    <br><label id="titulo" for="titulo" class="titulo-reporte">Compras recientes desde {{ $fechaibi }} hasta
        {{ $fechafin }}</label>
</div>
<div class="content" id="content">
    <div class="cardestadofact" id="cardestadofact">
        <div class="table-responsive">
            <table id= "tablaproducto" class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th style="color: white;">Fecha de Compra</th>
                        <th style="color: white;">Total de Compra</th>
                        <th style="color: white;">Cantidad comprada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comprasrecientes as $compra)
                        <tr>
                            <td>{{ $compra->fechacompra }}</td>
                            <td>C$ {{ $compra->totalcompra }}</td>
                            <td>{{ $cantidadporcompra->where('compras_id', $compra->id)->first()->cantidad_total_prod ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>C$ {{ $totalcompras }}</th>
                        <th>{{ $cantidadTotalInsumos }}</th>
                    </tr>
                </tfoot>
            </table><br><br>
            <div style="text-align: right;">
                <strong>
                    <label for="">Total de compras: C$
                        {{ number_format($totalcompras, 2, '.', ',') }}</label>
                </strong>
            </div>
        </div>
        <br>

        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 10;
                    $pdf->text(270, 780, "Pág " . $PAGE_NUM . " de " . $PAGE_COUNT, $font, $size);
                '); 
            }
        </script>
    </div>
</div>
@endsection