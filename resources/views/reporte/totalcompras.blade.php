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
    <label for="titulo" for="titulo" class="tituloreporte">Compras</label>
</div>

<div class="content" id="content">
    <div class="cardprodgen" id="cardprodgen"> 
            <div class="table-responsive">
                <table id="producto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todoscompra as $compra)
                        <tr class="text-center">
                            <td>{{$compra->razonsocialproveedor}}</td>
                            <td>{{ \Carbon\Carbon::parse ($compra->fechacompra)->format('d/m/Y')}}</td>
                            <td>{{ number_format($compra->totalcompra, 2, '.', ',')}}</td>
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
