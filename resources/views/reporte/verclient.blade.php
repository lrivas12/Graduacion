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
    <label for="titulo" for="titulo" class="tituloreporte">Lista de Clientes</label>
</div>

<div class="content" id="content">
    <div class="cardcliente" id="cardcliente"> 
            <div class="table-responsive">
                <table id="cliente" class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr class="text-center">
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombrecliente}}</td>
                            <td>{{$cliente->apellidocliente}}</td>
                            <td>{{$cliente->telefonocliente}}</td>
                            <td>{{$cliente->correocliente}}</td>
                            <td>{{$cliente->direccioncliente}}</td>
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
