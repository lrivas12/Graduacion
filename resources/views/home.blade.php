@extends('layouts.index')

@section('css')
    <style>
        .card1{
            background: linear-gradient(to bottom, #6704e9, purple);
        }
        .card3{
            background: linear-gradient(to bottom, #048de9, rgb(2, 59, 216));
        }
        .card4{
            background: linear-gradient(to bottom, #ffa703, rgb(255, 251, 0));
        }
        .card5{
            background: linear-gradient(to bottom, purple, rgb(2, 59, 216));
        }
        .card6{
            background: linear-gradient(to bottom, #34f89c, rgb(35, 206, 1));
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
                    <h4 class="text-white"><strong>Ventas del Día</strong></h4>
                    <br>
                    <h2 class="text-white"><strong>C$ {{ $ingresosHoy  ?? '0' }}</strong></h2>

                    <h4 class="text-white"><strong> Ventas del Mes</strong></h4>
                    <br>
                    <h2 class="text-white"><strong> C$ {{$ingresosGenerales  ?? '0'}}</strong></h2>
                    <a href="{{ route('factura.index') }}" id="updateButton" class="btn btn-success">
                        <i class="fas fa-money-check-alt"></i> Facturar
                    </a>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card2">
            <div class="card-body">
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
                <h4 class="text-center text-white"><strong> C$ {{$totalCompras  ?? 'Variable no definida'}}</strong></h4>
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
                 <h4 class="text-center text-white"><strong>C$ {{$montoFacturasCredito  ?? 'Variable no definida'}}</strong></h4> 
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
        labels: {!! $labels !!},
        datasets: [{
            data: {!! $data !!},
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
