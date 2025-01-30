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
                <?php if($session->id_perfil == 1 || $session->id_perfil == 2): ?>
                <div id="toolbar">
                    <button id="export" class="btn btn-primary" onclick="cargaCsv()">
                        <i class="mdi mdi-upload"></i>Cargar secuenciales
                    </button>
                    <button id="btn_carga" class="btn btn-info" onclick="descargarZip()">
                        <i class="mdi mdi-download"></i> Descargar Zip
                    </button>
                    <button class="btn btn-primary" id="loading" style="display:none;" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
                        Descargando...
                    </button>
                </div>
                <?php endif ?>
                <table id="tableUsuario" data-locale="es-MX" data-toolbar="#toolbar" data-toggle="table"
                    data-search="true" data-search-highlight="true" data-pagination="true"
                    data-page-list="[10, 25, 50, 100, all]" data-sortable="true" data-show-refresh="true"
                    data-show-export="true" data-export-types="['excel', 'csv']"
                    data-export-options='{"fileName": "tabla_practicantes"}' data-header-style="headerStyle"
                    data-url="<?=base_url("/index.php/Inicio/getPracticantesDocumento")?>">
                    <thead>
                        <tr>
                            <th data-field="id_usuario" data-width="20" data-sortable="true" class="text-center">ID</th>
                            <th data-field="nombre_completo" data-width="20" data-sortable="true" class="text-center">NOMBRE COMPLETO PRACTICANTE</th>
                            <th data-field="correo" data-width="100" data-sortable="true" class="text-center">CORREO</th>
                            <th data-field="curp" data-width="100" data-sortable="true" data-tooltip="true" class="text-center">CURP</th>
                          
                            <th data-field="secuencial" data-width="100" data-sortable="true" data-tooltip="true" class="text-center">
                                SECUENCIAL</th>
                            <th data-field="id_usuario" data-width="20"
                                data-formatter="ini.inicio.accionesPracticanteDocumento2" data-sortable="true" class="text-center">ACCIONES
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

function cargaCsv() {
    Swal.fire({
        title: "<strong>Subir CSV</strong>",
        icon: "info",
        html: `<input type='file' id="fileinput" class="form-control" accept=".csv" >`,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Guardar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            let fileInput = $('#fileinput')[0].files[0];
            if (!fileInput) {
                Swal.fire("Error", "Es requerido el archivo CSV", "error");
                return;
            }
            Swal.fire({
                title: "Atención",
                text: "Se enviará el archivo, ¿Desea proceder?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceder"
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('file', fileInput);
                    $.ajax({
                        url: base_url + "index.php/Usuario/subirSecuencial",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            if (!response.error) {
                                Swal.fire("Perfecto", "El archivo se cargó correctamente.",
                                    "success")
                                $('#tableUsuario').bootstrapTable('refresh');

                            } else {
                                Swal.fire("Error",
                                    "Hubo un problema al procesar el archivo.", "error");
                                console.log("Error: " + response.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            Swal.fire("Error", "Favor de llamar al Administrador", "error");
                        }
                    });
                }
            });
        }
    });
}

function descargarZip() {
    Swal.fire({
        title: "Atención",
        text: "Se descargará todos los archivos, ¿Desea proceder?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Proceder"
    }).then((result) => {
        if (result.isConfirmed) {
            $('#btn_carga').hide();
            $('#loading').show();
            $.ajax({
                url: base_url + "index.php/Usuario/descargarZip",
                type: 'POST',
                data: {
                    id_usuario: 1
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (!response.error) {
                        Swal.fire("Éxito", "El archivo se cargó correctamente.", "success");
                        //$('#tableUsuario').bootstrapTable('refresh');
                        // Crear un enlace de descarga dinámico
                        const link = document.createElement('a');
                        link.href = response.ruta; // Ruta proporcionada por el backend
                        link.download = 'archivos_descarga.zip'; // Nombre sugerido para el archivo
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                    } else {
                        Swal.fire("Error", response.respuesta, "error");
                        console.log("Error: " + response.error);
                    }
                    $('#btn_carga').show();
                    $('#loading').hide();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire("Error", "Favor de llamar al Administrador", "error");
                }
            });
        }
    });
}

function agregar() {

    $('#formParticipante')[0].reset();
}
</script>
</body>

</html>