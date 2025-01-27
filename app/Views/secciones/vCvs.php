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
                <table id="table" data-locale="es-MX" data-toolbar="#toolbar" data-toggle="table" data-search="true"
                    data-search-highlight="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]"
                    data-sortable="true" data-show-refresh="true" data-header-style="headerStyle"
                    data-url="<?=base_url("/index.php/Inicio/getEstudianteCV")?>">
                    <thead>
                        <tr>
                            <th data-field="id_archivo_cv" data-width="20" data-sortable="true" class="text-center">
                                CONSECUTIVO
                            </th>
                            <th data-field="nombre" data-width="20" data-sortable="true">NOMBRE DEL ESTUDIANTE</th>
                            <th data-field="folio" data-width="100" data-sortable="true">FOLIO</th>
                            <th data-field="comentario" data-width="100" data-sortable="true" data-tooltip="true">
                                COMENTARIO
                            </th>
                            <th data-field="ruta_absoluta" data-width="20" data-formatter="ini.inicio.estudianteCV"
                                data-sortable="true">ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<div id="modalAltaParticipante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Agregar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="formParticipante" name="formParticipante">
                <input type="hidden" value="0" id="editar" name="editar">
                <input type="hidden" value="0" id="id_usuario" name="id_usuario">
                <input type="hidden" id="id_perfil" name="id_perfil" value="4">
                <input type="hidden" id="id_dependencia" name="id_dependencia" value="<?= $session->id_dependencia ?>">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3 position-relative" id="">
                                <label for="curp" class="form-label campoObligatorio">CURP</label>
                                <input type="text" oninput="actualizarContrasenia();"
                                    oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    class="form-control" id="curp" name="curp" placeholder="CURP">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 position-relative" id="">
                                <label for="nombre" class="form-label campoObligatorio">NOMBRE</label>
                                <input type="text" oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    class="form-control" id="nombre" name="nombre" placeholder="NOMBRE">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 position-relative" id="">
                                <label for="primer_apellido" class="form-label campoObligatorio">PRIMER
                                    APELLIDO</label>
                                <input type="text" oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    class="form-control" id="primer_apellido" name="primer_apellido"
                                    placeholder="PRIMER APELLIDO">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 position-relative" id="">
                                <label for="segundo_apellido" class="form-label campoObligatorio">SEGUNDO
                                    APELLIDO</label>
                                <input type="text" oninput="this.value = this.value.toUpperCase();" autocomplete="off"
                                    class="form-control" id="segundo_apellido" name="segundo_apellido"
                                    placeholder="SEGUNDO APELLIDO">
                            </div>
                        </div>


                    </div>
                    <div class="row">


                        <div class="col-md-4">
                            <div class="mb-4 position-relative" id="">
                                <label for="id_perfil_disabled" class="form-label">PERFIL</label>
                                <select class="form-control" id="id_perfil_disabled" data-placeholder="seleccione"
                                    style="z-index:100;" disabled>
                                    <option value="4">PRACTICANTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 position-relative" id="">
                                <label for="correo" class="form-label campoObligatorio">CORREO</label>
                                <input type="text" autocomplete="off" class="form-control" id="correo" name="correo"
                                    placeholder="CORREO ELECTRONICO">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 position-relative" id="">
                                <label for="id_sexo" class="form-label">SEXO</label>
                                <select class="form-control" id="id_sexo" name="id_sexo" data-placeholder="seleccione"
                                    style="z-index:100;">
                                    <option value="0">seleccione</option>
                                    <option value="1">HOMBRE</option>
                                    <option value="2">MUJER</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 position-relative">
                                <label for="id_dependencia_disabled" class="form-label">DEPENDENCIA</label>
                                <select class="form-control" id="id_dependencia_disabled" name="id_dependencia_disabled"
                                    <?=($session->id_dependencia != '-1')?'disabled':'' ?>>
                                    <?php if($session->id_dependencia != -1): ?>
                                    <option value="<?= $session->id_dependencia ?>"><?= $dependencia ?></option>
                                    <?php endif ?>
                                    <?php if($session->id_dependencia == -1): ?>
                                    <?php foreach($cat_dependencia as $d): ?>
                                    <option value="<?= $d->id_dependencia ?>">
                                        <?= $d->dsc_corto.'-'.$d->dsc_dependencia ?></option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4 position-relative" id="">
                                <label for="contrasenia" class="form-label">CONTRASEÑA</label>
                                <input type="text" autocomplete="off" class="form-control" id="contrasenia"
                                    name="contrasenia" placeholder="CONTRASEÑA">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4 position-relative" id="">
                                <label for="confir_contrasenia" class="form-label campoObligatorio">CONFIRMAR
                                    CONTRASEÑA</label>
                                <input type="text" autocomplete="off" class="form-control" id="confir_contrasenia"
                                    name="confir_contrasenia" placeholder="CONFIRMAR CONTRASEÑA">
                            </div>
                        </div>


                    </div>



                </div>
                <div class="modal-footer" id="btn_guardar">
                    <button type="button" class="btn btn-light" id="closeModalButton"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>

                </div>
                <div class="modal-footer" style="display:none" id="btn_load">
                    <button class="btn btn-primary" id="btn_load" type="button" disabled>
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






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

function actualizarContrasenia() {
        let valor = $("#curp").val();
        $("#contrasenia").val(valor);
        $("#confir_contrasenia").val(valor);
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