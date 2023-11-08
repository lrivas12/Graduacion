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
            font-size: 20px;
            font-weight: bold;
        }
        .datos {
            font-size: 16px;
            font-weight: italic;
            text-align: left;
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
            float: left; /* Alinea el div "data" a la izquierda */
            margin-right: 10px; /* Agrega un margen a la derecha para separarlo del div "logo" */
        }

        .logo {
            float: right; /* Alinea el div "logo" a la derecha */
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
    
    <div class="header">
        <div class="empresa"><h2>Moto Repuestos Flor</h2>
        </div><br>
        <div class="datos">
            <div class="container">
                <div class="data">
                    <strong>RUC: </strong> <h2>448-310577-0000X</h2><br>
                    <strong>Contacto: </strong> <h2>2772 5938 | 7698 5828</h2><br>
                    <strong>Dirección: </strong> <h2>Frente al puente Totolate Abajo</h2><br>
                    <strong>Generado el: </strong> <?= date('d/m/Y H:i:s'); ?><br>
                    <strong>Generado por: </strong>{{ $user->usuario }} <br>

                </div>
                <div class="logo">   

                    <img src="/img/IMG-20230421-WA0002.jpg" class="logo">
                    
                </div>
            </div> 
        </div>
    </div>
   <br><br><br><br><br><br>
   <hr style="border-color:  #19284C;">

   
    <div class="content">
        @yield('content')
    </div>
   
    
    
    
</body>
</html>
