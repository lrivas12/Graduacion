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
    <label for="titulo" for="titulo" class="tituloreporte">Estado de Cuenta {{$datocliente}} </label>
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
                            <th>Cliente</th>
                            <th>Saldo Pendiente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($credito as $creditos)
                        <tr class="text-center">
                           
                            <td>{{$creditos->id}}</td>
                            <td>{{\Carbon\Carbon::parse ($creditos->fechafactura)->format('d/m/Y')}}</td>
                            <td>{{$creditos->clientes->nombrecliente}} {{$creditos->clientes->apellidocliente}}</td>
                            <td>{{number_format($creditos->detallepagos->saldodetallepago, 2, '.', ',')}}</td>
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