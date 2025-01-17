<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 fw-bold">Sube tu CV</h4>
                            <p class="text-muted mb-4">Documento en formato PDF</p>
                        </div>
                       
                            <div class="logout-icon m-auto">
                                <div class="mb-3">
                                    <label for="fileinput" class="form-label">Selecciona archivo</label>
                                    <input type="file" id="fileinput" name="fileinput" class="form-control" accept=".pdf">
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center" id="btn_entrar">
                                <button class="btn btn-primary" onclick="uploadCSV()"><i class="mdi mdi-upload"></i> Subir
                                </button>
                            </div>
                       

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

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
            $.ajax({
                url: '<?= base_url('/index.php/Login/index') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (!response.error) {
                        Swal.fire("Éxito", "El archivo se cargó correctamente.", "success");
                    } else {
                        Swal.fire("Error", "Hubo un problema al procesar el archivo.", "error");
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
</script>