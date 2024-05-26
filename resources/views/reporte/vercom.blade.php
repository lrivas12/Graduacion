@extends('reporte.plantilla')

@section('content')
<style>
.titulo
{

    text-align: center;
    display: flex;
    align-items: center;
}
</style>

<div class="titulo">
    <br>
    <label for="titulo" for="titulo" class="tituloreporte">Compras por Fecha desde  {{ \Carbon\Carbon::parse ($fechaini)->format('d-m-Y') }}  hasta
    {{ \Carbon\Carbon::parse ($fechafin)->format('d-m-Y') }} </label>
    <br>

</div>
<div class="content" id="content">
    <div class="cardprodgen" id="cardprodgen"> 
            <div class="table-responsive">
                <table id="producto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comprasfecha as $compra)
                        <tr class="text-center">
                           
                            <td>{{$compra->id}}</td>
                            <td>{{\Carbon\Carbon::parse ($compra->fechacompra)->format('d/m/Y')}}</td>
                            <td>C$ {{number_format($compra->totalcompra, 2, '.', ',')}}</td>
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