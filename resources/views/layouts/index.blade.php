@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)


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
<p class="text-center ">Derechos Reservados © 2023 | Creado por Techno Advanced</p>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('path/to/sweetalert2.min.js') }}"></script>
@endsection