<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
/* .proxima{
            font-family: 'BalooRegular', sans-serif;
        } */
.proxima {
    font-family: 'ProximaNova', sans-serif;
}

.folio {
    width: 13%;
    color: #ecf7ff;
    font-weight: bold;
    /* border:1px solid red; */
}

.textResumen {
    font-size: 12px;
    text-align: justify;
}

.textList {
    font-size: 13px;
    text-align: justify;
    list-style: none;
}

.textTurnado {
    font-size: 12px;
    text-align: justify;
}

.resumen {

    width: 83%;
}

.fecha {
    font-size: 12px;

}

.bordeRojo {
    border: 1px solid red;
}
</style>

<body>
    <div>
        <img src="<?php echo $dataImagen ?>" alt="Encabezado" />

        <div style="position:absolute; margin-left: 9%; margin-top:5.3%;width:60%; height:18px">
            <small class="proxima fecha"><strong>Folio</strong> </small> <?= $datos->folio ?><br><br>
        </div>
        <div class="textTurnado" style="position:absolute; margin-left: 9%; width:80%; height:18px;">
            <div style="padding-bottom: 5px;"><strong>Nombre del proyecto</strong></div>
            <?= $datos->proyecto ?><br><br>
        </div>
        <div class="textTurnado" style="position:absolute; margin-left: 9%;width:80%; height:18px; ">
            <div style="padding-bottom: 5px;"><strong>Descripción general del Proyecto</strong></div>
            <?= $datos->descripcion ?><br><br>
        </div>
        <div class="textTurnado" style="position:absolute; margin-left: 9%; width:80%; height:18px;">
            <div style="padding-bottom: 5px;"><strong> Beneficios esperados</strong></div>
            <?= $datos->beneficios ?><br><br>
        </div>
        <div class="textTurnado " style="position:absolute; margin-left: 9%; width:80%; height:18px; ">
            <div style="padding-bottom: 5px;"><strong>Lugar de realización del proyecto</strong></div>
            <?= $datos->domicilio ?><br><br>
        </div>
        <div class="textTurnado" style="position:absolute; margin-left: 9%; width:80%; height:18px;">
            <div style="padding-bottom: 5px;"><strong>Perfil requerido</strong></div>
            <?= $licenciatura->dsc_licenciatura ?><br><br>
        </div>
        <div class="textTurnado " style="position:absolute;margin-left: 9%; width:80%; height:18px; ">
            <div style="padding-bottom: 5px;"><strong>Conocimientos y/o habilidades</strong></div>
            <?= $datos->conocimiento ?><br><br>
        </div>
        <div class="textTurnado " style="position:absolute;margin-left: 9%; width:80%; height:18px; ">
            <div style="padding-bottom: 5px;"><strong>Actividades a realizar<strong></div>
            <?= $datos->actividad ?><br><br>
        </div>
        <div class="textTurnado" style="position:absolute; margin-left: 9%;width:80%; height:18px; ">
            <div style="padding-bottom: 5px;"><strong>Modalidad de prestación del servicio social
                    profesional</strong></div>
            <?php 
                    switch($datos->modalidad )
                    {
                        case 1:
                            echo 'PRESENCIAL';
                            break;
                        case 2:
                            echo 'VIRTUAL';
                            break;
                        case 3:
                            echo 'HIBRIDO';
                            break;
                    }
                    ?><br>
        </div>
        <div class="textList" style="position: absolute; margin-left: 9%; margin-top: 2%; width: 80%; height: 70px;">
            <span class="proxima textResumen">
                Si te interesa participar sube tu cv
                <a target="_blank"
                    href="http://localhost/ssp/index.php/Login/index?doc=<?= $datos->id_dependencia ?>">aquí</a>.
            </span>
            <div style="position: absolute; margin-left: 40%; margin-top: 0.3%; width:100px; height:100px;">
                <img src="<?= $filePath ?>" alt="Codigo QR" width="70px;" height="70px;" />
            </div>
        </div>




    </div>
</body>

</html>