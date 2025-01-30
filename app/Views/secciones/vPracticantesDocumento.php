<?php $session = \Config\Services::session(); ?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>
                <h4 class="page-title">ENLACES</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="tableUsuario" data-locale="es-MX" data-toolbar="#toolbar" data-toggle="table"
                    data-search="true" data-search-highlight="true" data-pagination="true"
                    data-page-list="[10, 25, 50, 100, all]" data-sortable="true" data-show-refresh="true"
                    data-show-export="true" data-export-types="['excel', 'csv']"
                    data-export-options='{"fileName": "tabla_practicantes"}' data-header-style="headerStyle"
                    data-url="<?=base_url("/index.php/Inicio/getPracticantesDocumento2")?>">
                    <thead>
                        <tr>
                            <th data-field="nombre_completo" data-width="20" data-sortable="true" class="text-center">NOMBRE COMPLETO
                                PRACTICANTE</th>
                            <th data-field="correo" data-width="100" data-sortable="true" class="text-center" class="text-center">CORREO</th>
                            <th data-field="curp" data-width="100" data-sortable="true" data-tooltip="true" class="text-center">CURP</th>
                            <th data-field="documentacion" data-formatter="ini.inicio.accionesEstatusDocumento"
                                data-width="100" data-sortable="true" data-tooltip="true" class="text-center">ESTATUS</th>
                            <th data-field="id_usuario" data-width="20"
                                data-formatter="ini.inicio.accionesPracticanteDocumento" data-sortable="true" class="text-center">DOCUMENTOS
                            </th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Validar Documento</h4>
                <button type="button" class="btn-close" onclick="limpiarModal()" data-bs-dismiss="modal"
                    aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <!--                 <ul id="document-list" class="list-group"></ul> -->
                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>Nombre Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CURP</td>
                            <td id="document-curp"></td>
                        </tr>
                        <tr>
                            <td>SITUACION FISCAL</td>
                            <td id="document-fiscal"></td>
                        </tr>
                        <tr>
                            <td>COMPROBANTE DE DOMICILIO</td>
                            <td id="document-comprobante"></td>
                        </tr>
                        <tr>
                            <td>ESTADO DE CUENTA</td>
                            <td id="document-edo_cuenta"></td>
                        </tr>
                        <tr>
                            <td>IDENTIFICACION</td>
                            <td id="document-identificacion"></td>
                        </tr>
                        <tr>
                            <td>ACTA DE NACIMIENTO</td>
                            <td id="document-acta"></td>
                        </tr>
                        <tr>
                            <td>CONSTANCIA DE ESTUDIO</td>
                            <td id="document-constancia"></td>
                        </tr>
                        <tr>
                            <td>FACULTAD</td>
                            <td id="document-facultativo"></td>
                        </tr>
                        <tr>
                            <td>ESCOLARES</td>
                            <td id="document-escolares"></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<script src="<?php echo base_url("assets/js/vendor.min.js"); ?>"></script>
<!--Bootstrap table-->
<link href="<?php echo base_url('assets/bootstrap-table-master/dist_/bootstrap-table.min.css');?>" rel="stylesheet">
<script src="<?php echo base_url('assets/bootstrap-table-master/dist_/bootstrap-table.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table-master/dist_/tableExport.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table-master/dist_/bootstrap-table-locale-all.min.js');?>"></script>
<script
    src="<?php echo base_url('assets/bootstrap-table-master/dist_/extensions/export/bootstrap-table-export.min.js');?>">
</script>

<script>
saeg.principal.formParticipante();


$('#id_dependencia').select2({
    dropdownParent: $('#modalAltaParticipante'),

});

function limpiarModal() {
    const documentList = document.getElementById('document-list');
    documentList.innerHTML = ''; // Limpia el contenido de la tabla
    console.log('El modal se ha limpiado');
}

function headerStyle() {
    return {
        css: {
            background: '#000099', // Fondo del encabezado
            color: '#FFFFFF' // Color del texto del encabezado
        }
    };
}




function agregar() {

    $('#formParticipante')[0].reset();
}
</script>
</body>

</html>