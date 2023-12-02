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
                    <h4>Ventas del Día</h4>
                    <br>
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
                <canvas id="topProductsPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<br>
<div class="form-group row">
    <div class="col-md-3">
        <div class="card card3">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card4">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card5">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card6">
            <div class="card-body">

            </div>
        </div>
    </div>

</div>
@section('js')
<{{-- script>
    // Obtener los datos pasados desde el controlador
    var labels = <?php /* echo json_encode($labels); */ ?>;
    var values = <?php /* echo json_encode($values); */ ?>;

    var ctx = document.getElementById('topProductsPieChart').getContext('2d');
    var topProductsPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF"],
            }]
        }
    });
</script> --}}
@endsection
@endsection
