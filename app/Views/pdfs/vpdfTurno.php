<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
       
        @font-face {
            font-family: 'ProximaNova'; 
            src: url(FCPATH .'assets/fonts/custom/proxima-nova.otf') format('opentype');
           
        }

        .container{
            /* border:3px solid red; */
            margin: 0;
            padding: 0;
            left:0%;
            top:0;
            position: absolute;
            width:100%;
            height: 100%;
            background-image: url('<?= $dataImagen ?>');
            background-size:100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .proxima{
            font-family: 'ProximaNova', sans-serif;
        }
        .folio{
            width:13%;
            color:#ecf7ff;
            font-weight: bold;
            /* border:1px solid red; */
        }
        .textResumen{
            font-size: 12px;
            text-align: justify;
        
        }
        .resumen{
            
            width:83%;
        }
        .fecha{
            font-size: 12px;
           
        }
    </style>
    
<body>
    <?php date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d');
        setlocale(LC_TIME, 'es_MX'); 
        $fechaFormateada = strftime('%d de %B del %y', strtotime($fechaActual));
    ?>
    <div class='container'>
        <div class="" style="margin-left: 65.5%; margin-top:5.3%;">
            <small class="proxima fecha">Guanajuato, Gto, <?= $fechaFormateada; ?></small>
        </div>
        <div class="folio" style="margin-left: 74%; margin-top:2.5%;">
            <span class="proxima "><?= $dataPage['id_turno']."/".$dataPage['anio']; ?></span>
        </div>
        
        <div class="" style="margin-left: 76.5%; margin-top:2.8%;">
            <span class="proxima "><?= strtoupper($dataPage['usuario_registro']); ?></span>
        </div>
        <div class="" style="margin-left: 18%; margin-top:25.3%;">
            <span class="proxima "><?= $dataPage['asunto']; ?></span>
        </div>
        <div class="" style="margin-left: 9%; margin-top:0.5%;">
            <span class="proxima "><?= strtoupper($dataPage['nombre_completo']); ?></span>
        </div>
        <div class="" style="margin-left: 9%; margin-top:0.5%;">
            <span class="proxima "><?= strtoupper($dataPage['cargo']); ?></span>
        </div>
        <div class="" style="margin-left: 9%; margin-top:0.5%;">
            <span class="proxima "><?= strtoupper($dataPage['razon_social']); ?></span>
        </div>
        <div class="" style="margin-left: 9%; margin-top:0.5%;">
            <span class="proxima "><?= strtoupper($dataPage['fecha_recepcion']); ?></span>
        </div>
        <div class="resumen" style="margin-left: 9%; margin-top:4%;">
            <span class="proxima textResumen"><?= $dataPage['resumen']; ?></span>
        </div>
        
    </div>
    
</body>
</html>