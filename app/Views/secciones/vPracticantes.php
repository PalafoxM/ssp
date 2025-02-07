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
                <div class="row mb-2">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-end" id="btn_caragMasiva">
                            <button type="button" onclick="saeg.principal.cargaMasiva()" class="btn btn-info mb-2">Carga
                                Masiva</button>
                        </div>
                        <div class="text-sm-end" style="display:none" id="btn_load">
                            <button class="btn btn-primary" id="btn_load" type="button" disabled>
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Cargando...
                            </button>
                        </div>

                    </div>
                </div><!-- end col-->
            </div>
            <table id="tableProyectos" data-locale="es-MX" data-toolbar="#toolbar" data-toggle="table"
                data-search="true" data-search-highlight="true" data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]" data-sortable="true" data-show-refresh="true"
                data-header-style="headerStyle" data-url="<?=base_url("/index.php/Inicio/getPracticantes")?>">
                <thead>
                    <tr>
                        <th data-field="id_practicante" data-width="10" data-sortable="true" class="text-center">
                            CONSECUTIVO
                        </th>
                        <th data-field="folio" data-width="30" data-sortable="true">FOLIO</th>
                        <th data-field="proyecto" data-width="30" data-sortable="true">NOMBRE DEL PROYECTO</th>

                        <th data-field="numero_prac" data-width="10" data-sortable="true" data-tooltip="true">NÚMERO DE
                            ESTUDIANTES
                        </th>

                        <th data-field="id_practicante" data-width="20"
                            data-formatter="ini.inicio.formatterAccionesPracticante" data-sortable="true">ACCIONES</th>
                    </tr>
                </thead>
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