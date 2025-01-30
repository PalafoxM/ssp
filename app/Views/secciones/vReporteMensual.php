<?php $session = \Config\Services::session(); ?>
<div class="container-fluid">
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
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-success mb-2 me-1"><i
                                    class="mdi mdi-cog-outline"></i></button>

                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>
                <table id="tableReportes" data-locale="es-MX" data-toolbar="#toolbar" data-toggle="table" data-search="true"
                    data-search-highlight="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]"
                    data-sortable="true" data-show-refresh="true" data-header-style="headerStyle"
                    data-url="<?=base_url("/index.php/Inicio/getReportesMensual")?>">
                    <thead>
                        <tr>
                            <th data-field="mes" data-formatter="ini.inicio.formattMeses" data-width="20" data-sortable="true" class="text-center">MES
                            </th>
                            <th data-field="dsc_dependencias" data-width="20" data-sortable="true" class="text-center">DEPENDENCIA</th>
                            <th data-field="nombre_completo" data-width="100" data-sortable="true" class="text-center">NOMBRE</th>
                            <th data-field="curp" data-width="100" data-sortable="true" data-tooltip="true" class="text-center">CURP
                            </th>
                            <th data-field="id_reporte" data-width="20" data-formatter="ini.inicio.reportesMensuales"
                                data-sortable="true" class="text-center">ACCIONES</th>
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


$('#id_dependencia_disabled').select2({
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