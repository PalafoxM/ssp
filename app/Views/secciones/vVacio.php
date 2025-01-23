<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-6">

                <div class="card">

                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 fw-bold">Subir tu CV</h4>
                            <p class="text-muted mb-4">Registro</p>
                        </div>

                        <div class="mb-3">
                            <label for="curp_login" class="form-label">CURP</label>
                            <input class="form-control" type="text" autocomplete="off" id="curp_login" name="curp_login"
                                required="" placeholder="CURP" oninput="this.value = this.value.toUpperCase();">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_login" class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="nombre_login" name="nombre_login" required=""
                                placeholder="Nombre" autocomplete="off"
                                oninput="this.value = this.value.toUpperCase();">
                        </div>
                        <div class="mb-3">
                            <label for="matricula" class="form-label">Matricula</label>
                            <input class="form-control" type="text" id="matricula" name="matricula" required=""
                                placeholder="Número de Alumno" autocomplete="off"
                                oninput="this.value = this.value.toUpperCase();">
                        </div>
                        <div class="mb-3">
                            <label for="fileinput" class="form-label">Subir CV</label>
                            <input type="file" id="fileinput" name="fileinput" class="form-control" accept=".pdf">
                        </div>

                        <div class="mb-3 mb-0 text-center" id="btn_entrar">
                            <button class="btn btn-primary" onclick="uploadCSV()"><i class="mdi mdi-upload"></i>
                                Subir
                            </button>
                        </div>
                        <div class="mb-3 mb-0 text-center" id="btn_load" style="display:none;">
                            <button class="btn btn-primary" type="button" disabled>
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>

                    </div> <!-- end card-body -->
                </div>

                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<script>
function uploadCSV() {
    let fileInput = $('#fileinput')[0].files[0];
    let nombre_login = $("#nombre_login").val();
    let curp_login = $("#curp_login").val();
    let matricula = $("#matricula").val();
    if (curp_login == '') {
        Swal.fire("Error", "Es requerido ingresar el CURP", "error");
        return;
    }
    if (nombre_login == '') {
        Swal.fire("Error", "Es requerido ingresar el Nombre", "error");
        return;
    }
    if (matricula == '') {
        Swal.fire("Error", "Es requerido ingresar la matricula", "error");
        return;
    }

    if (!fileInput) {
        Swal.fire("Error", "Es requerido el archivo PDF", "error");
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
            formData.append('id_dependencia', <?= $dependencia ?>);
            formData.append('nombre_login', nombre_login);
            formData.append('curp_login', curp_login);
            formData.append('matricula', matricula);
            $('#btn_load').show();
            $('#btn_entrar').hide();
            $.ajax({
                url: '<?= base_url('/index.php/Login/index') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (!response.error) {
                        Swal.fire("Carga correcta", "Se te contactara en 5 dias habiles, via correo electronico", "success");
                    } else {
                        Swal.fire("Error", "Hubo un problema al procesar el archivo.", "error");
                        console.log("Error: " + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire("Error", "Favor de llamar al Administrador", "error");
                },
                complete: function () {
                    $('#btn_load').hide();
                    $('#btn_entrar').show();
                    $('#fileinput').val('');;
                    $("#nombre_login").val('');
                    $("#curp_login").val('');
                    $("#matricula").val('');
                    
                }
            });
        }
    });
}
</script>