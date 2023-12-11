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
@stop


@section('footer')
<p class="text-center "><strong>Derechos Reservados UNAN - Managua, FAREM - Matagalpa © 2023 </strong></p>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('path/to/sweetalert2.min.js') }}"></script>
@endsection