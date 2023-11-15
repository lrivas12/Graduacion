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
    <br>
    <label for="titulo" for="titulo" class="tituloreporte">Lista de Ventas</label>
</div>

<div class="content" id="content">
    <div class="cardcliente" id="cardcliente"> 
            <div class="table-responsive">
                <table id="factura" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Tipo Venta</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr class="text-center">
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->clientes->nombrecliente}} {{$venta->clientes->apellidocliente}}</td>
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
