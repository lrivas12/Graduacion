@extends('layouts.index')
@section('title', 'Acerca de')

@section('css')
    <style>
        .modal {
            display: none;
        }

        .mini-formulario {
            display: none;
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .section {
            display: flex;
            justify-content: space-between;
        }

        .fa-question-circle {
            font-size: 27px;
        }

        .sectionT2 {
            background-color: rgb(17, 0, 94);
            /* Fondo azul */
            color: white;
            /* Texto blanco */
            padding: 10px;
            /* Espaciado interior */
            border-radius: 10px 10px 0 0;
            /* Bordes redondeados */
        }
    </style>

@stop


@section('content_header')
    
    <section class="section">
        <h1>Acerca de</h1>
    <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<section class="sectionT2">
    <div class="header">
        <h3><i class="fas fa-landmark"></i> Nosotros</h3>
    </div>
    </section>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="mx-auto">
                <img  style="max-width: 150px; border-radius: 20%;"  src="{{asset('/vendor/adminlte/dist/img/perfil.jpg')}}" alt="">
            </div>
            </div>
            <br><br>
            
            <div class="row" >
                <h4 class="offset-md-2">Proyecto de Graduación: <strong>Titulo de Ingeniero en Sistemas de Información</strong></h4>
            </div>
            <br>
            <div class="row" >
                <h4 class="offset-md-2">Sistema web: <strong>Titulo de Ingeniero en sistemas de información</strong></h4>
            </div>
            <br>
            <div class="row">
                <h2 class="offset-md-4"><strong>Datos del Desarrollador:</strong></h2>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6 text-center">
                <label for="">Nombre y Apellidos:</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for="">Número de teléfono:</label>
                </div>    
            </div>
            
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for=""> <i class="far fa-id-badge"></i> Luis Angel Rivas Jarquin</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for=""><i class="fa fa-phone-square"></i> +505 8724 5552</label>
                </div>    
            </div>

            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for=""> <i class="fas fa-book-open" ></i> Correo Electrónico:</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for=""><i class="far fa-address-book"></i> No de Carné:</label>
                </div>    
            </div>
            
            
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">lrivasjarquin@gmail.com</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for="">17606760</label>
                </div>    
            </div>

            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for=""> <i class="fa fa-dashboard" ></i> Nombre del Sistema:</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for=""><i class="fas fa-store"></i> Desarrollado para:</label>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">FICC</label>
                </div>
                <div class="col-md-6 text-center">
                    <label for="">Moto Repuesto Flor</label>
                </div>    
            </div>
            <br><br>
            <div class="row" >
                <p class="offset-md-3">Sistema Web Hecho Por: <strong>Techno Advanced 2023 | Todos los Derechos Reservados</strong></p>
            </div>
        </div>
    </div>
@endsection