<?php $session = \Config\Services::session(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>
                <h4 class="page-title"> SUBIR ARCHIVO EN FORMATO PDF</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="formCargaParticipante" name="formCargaParticipante" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $edita ?>" id="editar" name="editar">


                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="curp_archivo" class="form-label">Clave Única de Registro de la Población
                                        (CURP)</label><span style="color:red;"> *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="curp_archivo"
                                        name="curp_archivo" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="fiscal_archivo" class="form-label">Constancia de Situación
                                        Fiscal</label><span style="color:red;">
                                        *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="fiscal_archivo"
                                        name="fiscal_archivo" accept=".pdf">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="edo_cuenta" class="form-label">Estado de cuenta bancario</label><span
                                        style="color:red;"> *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="edo_cuenta"
                                        name="edo_cuenta" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="comprobante" class="form-label">Comprobante de domicilio;</label><span
                                        style="color:red;">
                                        *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="comprobante"
                                        name="comprobante" accept=".pdf">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="identificacion" class="form-label">Identificación Oficial</label><span
                                        style="color:red;">
                                        *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="identificacion"
                                        name="identificacion" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="acta" class="form-label">Acta de nacimiento</label><span
                                        style="color:red;"> *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="acta" name="acta"
                                        accept=".pdf">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="constancia" class="form-label">Constancia de estudios</label><span
                                        style="color:red;">
                                        *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="constancia"
                                        name="constancia" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="facultativo" class="form-label">Documento que acredite que se cuenta con
                                        seguro facultativo</label><span style="color:red;"> *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="facultativo"
                                        name="facultativo" accept=".pdf">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6 position-relative" id="">
                                    <label for="escolares" class="form-label">Documento que acredite que se cuenta con
                                        seguro accidentes escolares</label><span style="color:red;">
                                        *</span>
                                    <input type="file" autocomplete="off" class="form-control" id="escolares"
                                        name="escolares" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-6">

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
saeg.principal.formCargaParticipante();

function validateFileSize(event, maxSizeKB) {
    const fileInput = event.target;
    const file = fileInput.files[0]; // Obtener el archivo seleccionado
    const maxSizeBytes = maxSizeKB * 1024;

    const errorMessage = document.getElementById('error_message');

    if (file) {
        if (file.size > maxSizeBytes) {

            Swal.fire("Atención", `El archivo "${file.name}" excede el tamaño máximo permitido de 1M, favor de bajar la calidad del PDF`,"info");
            // Limpiar el input
            fileInput.value = '';
        } 
    }
}

// Selecciona todos los inputs tipo file y les añade el evento change
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (event) => validateFileSize(event, 999)); // Reutiliza la función
});

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