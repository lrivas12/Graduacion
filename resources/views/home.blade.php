@extends('layouts.index')

@section('css')
    <style>
        .card1{
            background: linear-gradient(to bottom, var(--success), transparent);
        }
        .card3{
            background: var(--success);
        }
        .card4{
            background: var(--info);
        }
        .card5{
            background: var(--warning);
        }
        .card6{
            background: var(--primary);
        }
    </style>
@stop


@section('content_header')
    <?php
    $empresa = DB::table('empresas')->first();
    $user = Auth::user();
    ?>
    <section class="section">
        <h1><i class="fas fa-store"></i> Bienvenido a {{ $empresa->nombreempresa }}</h1>
        <br>
        <h5><i class="fas fa-user"></i> {{ $user->usuario }}</h5>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<div class="form-group row">
    <div class="col-md-4">
        <div class="card card1">
            <div class="card-body">
                <div class="text-center">
                    <h4 ><strong>Ventas del Día</strong></h4>
                    <br>
                    <h2 ><strong>C$ {{number_format($ingresosHoy, 2, '.', ',')   ?? '0' }}</strong></h2>

                    <h4 ><strong> Ventas del Mes</strong></h4>
                    <br>
                    <h2 ><strong> C$ {{number_format($ingresosGenerales, 2, '.', ',')  ?? '0'}}</strong></h2>
                    <a href="{{ route('factura.create') }}" id="updateButton" class="btn btn-success">
                        <i class="fas fa-money-check-alt"></i> Facturar
                    </a>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card2">
            <div class="card-body">
                <h2 class="text-center"><strong>Productos mas vendidos</strong></h2>
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<br>
<div class="form-group row">
    <div class="col-md-3">
        <div class="card card3">
            <div class="card-body">
                <h3 class="text-center text-white"><strong> Total compras realizadas</strong></h3>
                <br>
                <h4 class="text-center text-white"><strong> C$ {{/* number_format( */$totalCompras/* , 2, '.', ',') */  ?? 'Variable no definida'}}</strong></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card4">
            <div class="card-body">
                <h3 class="text-center text-white"><strong> Total Facturas a Crédito</strong></h3>
                <br>
                 <h4 class="text-center text-white"><strong> {{$totalFacturasCredito  ?? 'Variable no definida' }}</strong></h4> 
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card5">
            <div class="card-body">
                <h3 class="text-center text-white"><strong> Total monto al crédito</strong></h3>
                <br>
                 <h4 class="text-center text-white"><strong>C$ {{/* number_format( */$montoFacturasCredito/* , 2, '.', ',') */  ?? 'Variable no definida'}}</strong></h4> 
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card6">
            <div class="card-body">
                <h3 class="text-center text-white"><strong>Total facturas emitidas</strong></h3>
                <br>
                 <h4 class="text-center text-white"><strong>{{$totalFacturas  ?? 'Variable no definida'}}</strong></h4> 
            </div>
        </div>
    </div>

</div>
@section('js')
<script>
   var ctx = document.getElementById('myPieChart').getContext('2d');

// Crear el gráfico de tipo pie
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: {!! $labels ?? 0 !!},
        datasets: [{
            data: {!! $data ?? 0 !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
            ],
        }],
    },
});
</script> 
@endsection 
@endsection
