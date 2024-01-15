@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('plugins.Chartjs', true)
@section('plugins.select2', true)


@section('head')
<meta name="viewport" content="width=device-width,initial-scale=1"/>
@stop

@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('content')

@auth
<div class="user-panel">
    <div class="pull-left image">
        <img src="{{ auth()->user()->adminlte_image() }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ auth()->user()->usuario}}</p>
    </div>
</div>
@endauth
@stop


@section('footer')
<p class="text-center "><strong>Derechos Reservados UNAN - Managua, FAREM - Matagalpa © 2023 </strong></p>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('path/to/sweetalert2.min.js') }}"></script>

    <script>

        var globalUrl = "{{ asset('') }}"; // Usa asset para obtener la ruta raíz
      

    </script>
@endsection