<?php $session = \Config\Services::session(); ?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>
                <h4 class="page-title">REGISTRO</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="formParticipante" name="formParticipante">
                    <input type="hidden" value="<?= $edita ?>" id="editar" name="editar">
                    <input type="hidden" value="<?= $id_practicante ?>" id="id_practicante" name="id_practicante">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="nombre" class="form-label">SOLICITANTE/RESPONSABLE</label><span
                                        style="color:red;"> *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre"
                                        placeholder="NOMBRE" value="<?= ($edita == 1)?$practicante->nombre:'' ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="correo" class="form-label">CORREO</label><span style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="correo" name="correo"
                                        placeholder="CORREO" value="<?= ($edita == 1)?$practicante->correo:'' ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="puesto" class="form-label">PUESTO</label><span style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="puesto" name="puesto"
                                        placeholder="PUESTO" value="<?= ($edita == 1)?$practicante->puesto:'' ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="oficina" class="form-label">OFICINA</label><span style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="oficina"
                                        name="oficina" placeholder="OFICINA"
                                        value="<?= ($edita == 1)?$practicante->oficina:''?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="domicilio" class="form-label">DOMICILIO</label><span style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="domicilio"
                                        name="domicilio" placeholder="DOMICILIO"
                                        value="<?= ($edita == 1)?$practicante->domicilio:''?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="telefono" class="form-label">TELEFONO</label><span style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="telefono"
                                        name="telefono" placeholder="TELEFONO"
                                        value="<?= ($edita == 1)?$practicante->telefono:''?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="modalidad" class="form-label">MODALIDAD</label>
                                    <select class="form-control" id="modalidad" name="modalidad"
                                        data-placeholder="seleccione" style="z-index:100;">
                                        <option value="0"
                                            <?= ($edita == 1 && $practicante->modalidad == 0) ? 'selected' : '' ?>>
                                            seleccione</option>
                                        <option value="1"
                                            <?= ($edita == 1 && $practicante->modalidad == 1) ? 'selected' : '' ?>>
                                            PRESENCIAL</option>
                                        <option value="2"
                                            <?= ($edita == 1 && $practicante->modalidad == 2) ? 'selected' : '' ?>>
                                            VIRTUAL</option>
                                        <option value="3"
                                            <?= ($edita == 1 && $practicante->modalidad == 3) ? 'selected' : '' ?>>
                                            HIBRIDO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="proyecto" class="form-label">NOMBRE DEL PROYECTO</label><span
                                        style="color:red;">
                                        *</span>
                                    <input type="text" autocomplete="off" class="form-control" id="proyecto"
                                        name="proyecto" placeholder="NOMBRE"
                                        value="<?= ($edita == 1)?$practicante->proyecto:''?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="dias" class="form-label">DIAS POR SEMANA</label><span
                                        style="color:red;"> *</span>
                                    <select class="form-control" id="dias" name="dias" data-placeholder="seleccione"
                                        style="z-index:100;">
                                        <option value="1"
                                            <?= ($edita == 1 && $practicante->dias == 1) ? 'selected' : '' ?>>
                                            1 DIA</option>
                                        <option value="2"
                                            <?= ($edita == 1 && $practicante->dias == 2) ? 'selected' : '' ?>>
                                            2 DIAS</option>
                                        <option value="3"
                                            <?= ($edita == 1 && $practicante->dias == 3) ? 'selected' : '' ?>>
                                            3 DIAS</option>
                                        <option value="4"
                                            <?= ($edita == 1 && $practicante->dias == 4) ? 'selected' : '' ?>>
                                            4 DIAS</option>
                                        <option value="4"
                                            <?= ($edita == 1 && $practicante->dias == 4) ? 'selected' : '' ?>>
                                            5 DIAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="hora" class="form-label">HORAS POR SEMANA</label><span
                                        style="color:red;"> *</span>
                                    <select class="form-control" id="hora" name="hora" data-placeholder="seleccione"
                                        style="z-index:100;">
                                        <?php for ($i = 1; $i <= 30; $i++): ?>
                                        <option value="<?= $i ?>"
                                            <?= ($edita == 1 && $practicante->hora == $i) ? 'selected' : '' ?>>
                                            <?= $i ?> HORA<?= $i > 1 ? 'S' : '' ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="descripcion" class="form-label">DESCRIPCION DEL PROYECTO</label><span
                                        style="color:red;"> *</span>
                                    <textarea autocomplete="off" class="form-control" id="descripcion"
                                        name="descripcion"
                                        placeholder="DESCRIPCION DEL PROYECTO"><?= ($edita == 1)?$practicante->descripcion:''?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="beneficios" class="form-label">BENEFICIOS ESPERADOS</label><span
                                        style="color:red;"> *</span>
                                    <textarea autocomplete="off" class="form-control" id="beneficios" name="beneficios"
                                        placeholder="DESCRIPCION"><?= ($edita == 1)?$practicante->beneficios:''?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="actividad" class="form-label">ACTIVIDADES A REREALIZAR</label><span
                                        style="color:red;"> *</span>
                                    <textarea autocomplete="off" class="form-control" id="actividad" name="actividad"
                                        placeholder="ACTIVIDAD A REREALIZAR"><?= ($edita == 1)?$practicante->actividad:''?></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 position-relative" id="">
                                    <label for="campus" class="form-label">CAMPUS</label><span style="color:red;">
                                        *</span>
                                    <select class="form-control" id="campus" name="campus" data-placeholder="seleccione"
                                        style="z-index:100;">
                                        <option value="0"
                                            <?= ($edita == 1 && $practicante->campus == 0) ? 'selected' : '' ?>>
                                            seleccione</option>
                                        <?php foreach($campus as $c): ?>
                                        <option value="<?= $c->id_campus ?>"
                                            <?= ($edita == 1 && $practicante->campus == $c->id_campus) ? 'selected' : '' ?>>
                                            <?= $c->dsc_campus ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="mb-3 position-relative">
                                    <label for="licenciatura" class="form-label">LICENCIATURA</label><span
                                        style="color:red;"> *</span>
                                    <select class="form-control" id="licenciatura" name="licenciatura"
                                        data-placeholder="seleccione" style="z-index:100;">
                                        <option value="0">seleccione</option>
                                        <?php if ($edita == 1): ?>
                                        <?php foreach ($licenciaturas as $l): ?>
                                        <option value="<?= $l->id_licenciatura ?>"
                                            <?= ($practicante->licenciatura == $l->id_licenciatura) ? 'selected' : '' ?>>
                                            <?= $l->dsc_licenciatura ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="conocimiento" class="form-label">CONOCIMIENTOS </label><span
                                        style="color:red;"> *</span>
                                    <textarea autocomplete="off" class="form-control" id="conocimiento"
                                        name="conocimiento"
                                        placeholder="CONOCIMIENTO"><?= ($edita == 1)?$practicante->conocimiento:''?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="numero_prac" class="form-label">CANTIDAD DE ESTUDIANTE REQUERIDOS EN EL
                                        PROYECTO</label><span style="color:red;"> *</span>
                                    <select class="form-control" id="numero_prac" name="numero_prac" data-placeholder="seleccione"
                                        style="z-index:100;">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>"
                                            <?= ($edita == 1 && $practicante->numero_prac == $i) ? 'selected' : '' ?>>
                                            <?= $i ?> ESTUDIANTE<?= $i > 1 ? 'S' : '' ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="modal-footer" id="btn_guardar">

                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </div>
                    <div class="modal-footer" style="display:none" id="btn_load">
                        <button class="btn btn-primary" id="btn_load" type="button" disabled>
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalCambioContrasenia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-filled bg-info">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">CAMBIO DE CONTRASEÑA</h5>
                <a href="<?php echo base_url()?>index.php/Login/cerrar" type="button" class="btn-close"
                    aria-hidden="true"></a>
            </div> <!-- end modal header -->
            <div class="modal-body">

                Para mayor seguridad de sus datos personales, favor de cambiar su contraseña.
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url()?>index.php/Login/cerrar" type="button"
                    class="btn btn-secondary">Cerrar</a>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    onclick="modalCambioContrasenia()">Cambiar</button>
            </div> <!-- end modal footer -->
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->


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
<?php if ($session->cambio_password == 1): ?>
window.onload = function() {
    var myModal = new bootstrap.Modal(document.getElementById('modalCambioContrasenia'));
    myModal.show();
};
<?php endif; ?>
saeg.principal.formPracticante();
$('#id_dependencia').select2({
    dropdownParent: $('#modalAltaParticipante'),

});


$('#campus').change(function() {
    const campusId = $(this).val(); // Obtén el ID del campus seleccionado
    if (campusId !== "0") { // Solo envía si es una opción válida
        $.ajax({
            url: base_url + "index.php/Inicio/getCampus",
            type: 'POST',
            data: {
                id: campusId
            },
            success: function(response) {
                $('#licenciatura').empty().append('<option value="0">seleccione</option>');
                console.log(response);
                // Agrega las nuevas opciones al select
                response.forEach(function(licenciatura) {
                    $('#licenciatura').append(
                        `<option value="${licenciatura.id_licenciatura}">${licenciatura.dsc_licenciatura}</option>`
                    );
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    } else {
        $('#licenciatura').empty().append(
            '<option value="0">seleccione</option>'); // Limpia si se selecciona "0"
    }
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

function modalCambioContrasenia() {
    $.ajax({
        type: "POST",
        url: base_url + "index.php/Opciones/getUsuario",
        dataType: "json",
        data: {
            'id_usuario': <?= $session->id_usuario ?>
        },
        success: function(data) {
            if (data) {
                console.log(data);

                $('#editar2').val(1);
                $('#nombre2').val(data.nombre);
                $('#primer_apellido2').val(data.primer_apellido);
                $('#segundo_apellido2').val(data.segundo_apellido);
                $('#contrasenia').val(data.curp);
            } else {
                Swal.fire("info", "No se encontraron datos del usuario.", "info");
            }
        },
        error: function() {
            Swal.fire("info", "No se encontraron datos del usuario.", "info");
        }
    });

    setTimeout(() => {
        var myModal = new bootstrap.Modal(document.getElementById('modalContraseniaParticipante'));
        myModal.show();
    }, 500);


}
</script>
</body>

</html>