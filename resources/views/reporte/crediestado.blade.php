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
    <label for="titulo" for="titulo" class="tituloreporte">Crédito por Fecha desde {{-- {{ $FechIniFact }} --}} hasta
    {{-- {{ $FechaFinFact }} --}}</label>
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
                            <th>Tipo venta</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventasporfecha as $venta)
                        <tr class="text-center">
                           
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->fechafactura}}</td>
                            <td>{{$venta->tipoventa}}</td>
                            <td>{{$venta->totalventa}}</td>
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