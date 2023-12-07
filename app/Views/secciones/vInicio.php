<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos 2.0</title>
</head>
<body>

    <h1>Hola <?php echo $nombre_completo; ?></h1> 
    <h4>Turnos recientes</h4>
    <table
        id="table"
        data-locale="es-MX"
        data-toolbar="#toolbar"
        data-toggle="table"
        data-search="true"
        data-search-highlight="true"
        data-pagination="true"
        data-page-list="[10, 25, 50, 100, all]"
        data-sortable="true"
        data-show-refresh="true"
        data-header-style="headerStyle"
        data-url="<?=base_url("/index.php/Inicio/getPrincipal")?>">
        <thead>
            <tr>
                <th data-field="id_turno" data-width="20" data-sortable="true">FOLIO</th>
                <th data-field="fecha_recepcion" data-width="20" data-sortable="true">FECHA RECEPCION</th>
                <th data-field="solicitante_nombre" data-width="100" data-sortable="true">REMITENTE</th>
                <th data-field="solicitante_razon_social" data-width="50" data-sortable="true">RAZON SOCIAL</th>
                <th data-field="resumen" data-width="100" data-sortable="true"  data-formatter="ini.inicio.formatterTruncaTexto" data-tooltip="true">SINTESIS ASUNTO</th>
                <th data-field="resultado_turno" data-width="100" data-sortable="true" data-formatter="ini.inicio.formatterTruncaTexto" data-tooltip="true">RESULTADO TURNO</th>
                <th data-field="id_estatus" data-width="20" data-sortable="true" data-formatter="ini.inicio.formatteStatus" class="text-center" >ESTATUS</th>
                 <th data-field="id_turno" data-width="20" data-formatter="ini.inicio.formatterAccionesTurno" data-sortable="true">Acciones</th>
            </tr>
        </thead>
    </table>  

<link href="<?php echo (base_url('/assets/bootstrap-table-master/dist_/bootstrap-table.min.css'));?>" rel="stylesheet">
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/bootstrap-table.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/tableExport.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/bootstrap-table-locale-all.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/extensions/export/bootstrap-table-export.min.js');?>"></script>
<script>
    
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    });
    function headerStyle() {
    return {
        css: {
        background: '#000099', // Fondo del encabezado
        color: '#FFFFFF'        // Color del texto del encabezado
        }
    };
    }
</script>
</body>
</html>