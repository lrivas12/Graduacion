@extends('layouts.index')

@section('title', 'Ayuda')

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
        <h1>Ayuda</h1>
        <i class="btn far fa-question-circle" title="Ayuda"></i>
    </section>
    <hr class="my-2" />
@stop

@section('content')

<section class="sectionT2">
    <div class="header">
        <h3><i class="far fa-question-circle"></i> Centro de  Ayuda </h3>
    </div>
    </section>
    <div class="card">
        <div class="card-body">
            
            <div class="row">
                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>                
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>

                <div class="col-md-3">
                    <h1>Facturación</h1>

                    <h4>Cómo crear una nueva factura</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Cómo gestionar descuentos y pagos</h4>
                    <p>Explicación detallada...</p>
                
                    <h4>Proceso de generación de facturas y recibos</h4>
                    <p>Explicación detallada...</p>
                </div>                
            </div>
        </div>
    </div>
@endsection