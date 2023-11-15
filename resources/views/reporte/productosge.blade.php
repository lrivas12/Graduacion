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
    <label for="titulo" for="titulo" class="tituloreporte">Inventario General</label>
</div>

<div class="content" id="content">
    <div class="cardprodgen" id="cardprodgen"> 
            <div class="table-responsive">
                <table id="producto" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Stock Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr class="text-center">
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->nombreproducto}}</td>
                            <td>{{$producto->nombrecategoria}}</td>
                            <td style="color: {{ $producto->cantidadproducto <= $producto->stockminimo ? 'red' : 'green' }}">
                                {{ $producto->cantidadproducto}}</td>
                            <td>{{$producto->stockminimo}}</td>
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
