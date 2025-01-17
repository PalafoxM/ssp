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
                        <a href="javascript:void(0);" data-bs-toggle='modal' data-bs-target='#modalAltaParticipante'
                            class="btn btn-danger mb-2" onclick="agregar()">
                           <div id="staticBackdropLabel"> Agregar</div></a>
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
                    data-url="<?=base_url("/index.php/Inicio/getPrincipal")?>">
                    <thead>
                        <tr>
                            <th data-field="id_usuario" data-width="20" data-sortable="true" class="text-center">ID
                                USUARIO
                            </th>
                            <th data-field="nombre_completo" data-width="20" data-sortable="true">NOMBRE</th>
                            <th data-field="curp" data-width="100" data-sortable="true">CURP</th>

                            <th data-field="dsc_dependencia" data-width="100" data-sortable="true" data-tooltip="true">DEPENDENCIA
                            </th>

                            <th data-field="dsc_perfil" data-width="100" data-sortable="true" data-tooltip="true">PERFIL
                            </th>

                            <th data-field="id_usuario" data-width="20" data-formatter="ini.inicio.formatterAccionesTurno"
                                data-sortable="true">Acciones</th>
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

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3 position-relative" id="">
                                <label for="curp" class="form-label campoObligatorio">CURP</label>
                                <input type="text" oninput="this.value = this.value.toUpperCase();" autocomplete="off"
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
                                <label for="id_perfil" class="form-label">PERFIL</label>
                                <select class="form-control" id="id_perfil" name="id_perfil"
                                    data-placeholder="seleccione" style="z-index:100;">
                                    <option value="0">seleccione</option>
                                    <option value="3">ENLACE</option>
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
                                <label for="id_dependencia" class="form-label">DEPENDENCIA</label>
                                <select class="form-control"  id="id_dependencia"
                                    name="id_dependencia">
                                    <option value="0">Seleccione</option>
                                    <?php foreach($cat_dependencia as $d): ?>
                                    <option value="<?= $d->id_dependencia ?>">
                                        <?= $d->dsc_corto.'-'.$d->dsc_dependencia ?></option>
                                    <?php endforeach ?>
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
        <script src="<?php echo base_url('assets/bootstrap-table-master/dist_/extensions/export/bootstrap-table-export.min.js');?>"></script>

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