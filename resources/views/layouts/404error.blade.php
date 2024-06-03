@extends('layouts.index')

@section('title', 'error - 404')

@section('css')
    <style>
        .hidden {
            display: none;
            animation: slideDown 0.5s ease-in-out;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .section {
            display: flex;
            justify-content: flex-end;
        }

        .section1 {
            display: flex;
            justify-content: center;
        }

        .form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }

        .fa-question-circle {
            font-size: 27px;
        }

        .sectionT {
            display: flex;
            text-align: center;
        }

        .sectionT2 {
            background-color: var(--primary);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 10px;
            /* Espaciado interior */
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados */
        }

        .header {
            display: flex;
            /* Mostrar elementos en línea */
            align-items: center;
            /* Centrar verticalmente */
            justify-content: space-between;
            /* Espacio entre elementos */
        }

        .header label {
            margin-right: 10px;
            /* Espacio entre la etiqueta y el input de fecha */
        }

        .card {
            border: none;
            /* Eliminar bordes de la card */
            border-radius: 10px;
            /* Bordes redondeados */
            margin: 0;
            /* Eliminar márgenes */
            box-shadow: none;
            /* Eliminar sombra */
        }

        .overflow-auto {
            overflow: hidden;
            /* Ocultar desbordamiento */
        }
        .imagen img{
            max-width: 30%;
        }
    </style>
@stop
@section('content_header')
    <section class="text-center">
        <h1><i class="fas fa-ban text-danger"></i> ERROR 404 - No encontrado</h1>
    </section>
    <hr class="my-2" />
@stop
@section('content')
<br><br>
            <div class="text-center">
                <img src="public/vendor/adminlte/dist/img/errorq.jpg" class="imagen" style="max-width: 50%;">
                <h1>¡La página a la que desea acceder no existe!</h1>
            </div>
        </div>
@endsection