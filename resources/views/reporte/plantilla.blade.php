<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte</title>
    <style>
     
        .header {
            text-align: center;
            padding: 20px;
        }
        .empresa {
            font-size: 40px;
            font-weight: bold;
        }
        .datos {
            font-size: 16px;
            font-weight: italic;
            text-align: center;
            line-height: 1.5;
        }
        .content {
            margin: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
         .table th, .table td {
            border: 1px solid gray; 
            padding: 12px;
            text-align: center;
        }
        .titulo-reporte {
            font-size: 20px;
            text-align: center; 
            margin-bottom: 10px; 
            font-weight: bold;
           
        } 
        body {
            border: 1.5px solid #007BFF; /* Borde sólido de 2 píxeles con color azul (#007BFF) */
            padding: 10px; /* Espacio interno para el contenido */
        }
        .container {
            display: flex;
            justify-content: space-between;
        }

        .data {
            flex: 1; /* El div de datos ocupará el espacio restante */
             /* Alinea el div "data" a la izquierda */
            margin-right: 10px; /* Agrega un margen a la derecha para separarlo del div "logo" */
           
        }

        .logo {
            float: center; /* Alinea el div "logo" a la derecha */
            max-width: 100px;
            max-height: 100px;
        }

    </style>
</head>
<body>
    <?php
    $empresa = DB::table('empresas')->first();
    $user = Auth::user();
    ?>
    <div class="logo">   

                    <img src="{{ asset($empresa->logo) }}" class="logo">
                    
                </div>
    <div class="header">
        <div class="empresa">
            {{$empresa->nombreempresa}}
        </div><br>
        <div class="datos">
            <div class="container">
                <div class="data">
                    <strong>RUC: </strong> {{$empresa->rucempresa}}<br>
                    <strong>Contacto: </strong> {{$empresa->contactoempresa}}<br>
                    <strong>Dirección: </strong> {{$empresa->direccionempresa}}<br>
                    <strong>Generado el: </strong> <?= date('d/m/Y H:i:s') ?><br>
                     <strong>Generado por: </strong>{{ $user->usuario }} <br> 

                </div>
                
            </div> 
        </div>
    </div>
   <br>
   <hr style="border-color:  #19284C;">

   
    <div class="content">
        @yield('content')
    </div>
   
    
    
    
</body>
</html>
