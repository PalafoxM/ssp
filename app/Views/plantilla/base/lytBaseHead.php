<?php $session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>SSSP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">


    <!-- third party css end -->

    <!-- App css -->
    <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?php echo base_url(); ?>assets/css/app-dark.min.css" rel="stylesheet" type="text/css"
        id="dark-style" />
    <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />


    <script type="text/javascript" src="<?php echo base_url();?>assets/sweetAlert2/sweetalert2.all.min.js"></script>



    <?php if (isset($scripts)): foreach ($scripts as $js): ?>
    <script src="<?php echo base_url() . "js/{$js}.js" ?>?filever=<?php echo time() ?>" type="text/javascript"></script>
    <?php endforeach;
            endif;
        ?>

</head>



<body class="loading" data-layout="topnav"
    data-layout-config='{"layoutBoxed":false,"darkMode":false,"showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <script>
        var base_url = "<?php echo base_url();?>";
        </script>
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->


        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom topnav-navbar">
                    <div class="container-fluid">

                        <!-- LOGO -->
                        <a href="" class="topnav-logo">
                            <span class="topnav-logo-lg">
                                <img src="<?php echo base_url(); ?>assets/images/logo-light.png" alt="" height="16">

                            </span>
                            <span class="topnav-logo-sm">
                                <img src="<?php echo base_url(); ?>assets/images/logo_sm_dark.png" alt="" height="16">
                            </span>
                        </a>

                        <ul class="list-unstyled topbar-menu float-end mb-0">

                            <li class="dropdown notification-list d-xl-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                                    id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="account-user-avatar">
                                        <?php if($session->id_sexo==1): ?>
                                        <img src="<?php echo base_url(); ?>assets/images/hombre.PNG"
                                            class="rounded-circle">
                                        <?php endif ?>
                                        <?php if($session->id_sexo==2): ?>
                                        <img src="<?php echo base_url(); ?>assets/images/mujer.PNG"
                                            class="rounded-circle">
                                        <?php endif ?>

                                    </span>
                                    <span>
                                        <span class="account-user-name"> <?=  $session->nombre_completo ?> </span>
                                        <span class="account-position">
                                            <?php 
                                            switch($session->id_perfil)
                                            {
                                             case 1:
                                                echo 'ADMINISTRADOR';
                                                break;
                                             case 2:
                                                echo 'GESTOR';
                                                break;
                                             case 3:
                                                echo 'ENLACE';
                                                break;
                                             case 4:
                                                echo 'PRACTICANTE';
                                                break;

                                            }
                                            
                                            ?>
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                                    aria-labelledby="topbar-userdrop">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Bienvenido</h6>
                                    </div>
                                    <!-- item-->
                                    <a href="javascript:void(0);" onclick="cambio_contrasenia()"
                                        class="dropdown-item notify-item" data-bs-toggle='modal'
                                        data-bs-target='#modalContraseniaParticipante'>
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Cambiar contraseña</span>
                                    </a>
                                    <!-- item-->
                                    <a href="<?php echo base_url()?>index.php/Login/cerrar"
                                        class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Salir</span>
                                    </a>

                                </div>
                            </li>

                        </ul>
                        <a class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <div class="app-search dropdown">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Busqueda..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text  btn-primary" type="submit">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end Topbar -->
                <div class="topnav">
                    <div class="container-fluid">
                        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">
                                    <?php if($session->id_perfil == 2 || $session->id_perfil == 1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none" href="<?php echo base_url()?>index.php/Inicio"
                                            id="topnav-dashboards" aria-expanded="false">
                                            <i class="uil-user me-1"></i>Alta Enlace
                                        </a>
                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil == 2 || $session->id_perfil == 3 || $session->id_perfil == 1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link  arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/formulario" id="topnav-pages"
                                            aria-expanded="false">
                                            <i class="uil-plus me-1"></i>Registro
                                        </a>

                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil == 2|| $session->id_perfil == 3 || $session->id_perfil == 1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/practicantes"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="uil-check me-1"></i>Lista de Proyectos
                                        </a>

                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil != 4 ): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/estudianteCV"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="uil-file me-1"></i>Lista Curriculum Vitae
                                        </a>
                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil == 4 ): ?>
                                        
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/formulario_archivo"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="uil-file me-1"></i>Subir Archivo
                                        </a>
                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil == 4): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/listaDocumento"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="dripicons-checklist me-1"></i>Lista de Documentos
                                        </a>
                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil != 4): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/validarDocumento"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="dripicons-checklist me-1"></i>Validar Documentos
                                        </a>

                                    </li>
                                    <?php endif ?>
                                    <?php if($session->id_perfil != 4): ?>
                                    <li class="nav-item">
                                        <a class="nav-link arrow-none"
                                            href="<?php echo base_url()?>index.php/Inicio/reportes"
                                            id="topnav-components" aria-expanded="false">
                                            <i class="uil-file me-1"></i>Reportes Mensuales
                                        </a>

                                    </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

            </div>

            <div id="modalContraseniaParticipante" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullWidthModalLabel">Cambiar Contraseña</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <input type="hidden" value="0" id="editar2" name="editar">
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-4 position-relative" id="">
                                        <label for="nombre2" class="form-label">NOMBRE</label>
                                        <input type="text" autocomplete="off" class="form-control" id="nombre2"
                                            name="nombre2" placeholder="NOMBRE" disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4 position-relative" id="">
                                        <label for="primer_apellido2" class="form-label">PRIMER
                                            APELLIDO</label>
                                        <input type="text" autocomplete="off" class="form-control" id="primer_apellido2"
                                            name="primer_apellido2" placeholder="PRIMER APELLIDO" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4 position-relative" id="">
                                        <label for="segundo_apellido2" class="form-label">SEGUNDO
                                            APELLIDO</label>
                                        <input type="text" autocomplete="off" class="form-control" id="segundo_apellido2"
                                            name="segundo_apellido2" placeholder="SEGUNDO APELLIDO" disabled>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6 position-relative" id="">
                                        <label for="nueva_contrasenia" class="form-label">NUEVA CONTRASEÑA</label>
                                        <input type="password" autocomplete="off" class="form-control"
                                            id="nueva_contrasenia" name="nueva_contrasenia"
                                            placeholder="NUEVA CONTRASEÑA">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6 position-relative" id="">
                                        <label for="confirma_contrasenia" class="form-label">CONFIRMAR
                                            CONTRASEÑA</label>
                                        <input type="password" autocomplete="off" class="form-control"
                                            id="confirma_contrasenia" name="confirma_contrasenia"
                                            placeholder="CONFIRMAR CONTRASEÑA">
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="modal-footer" id="btn_guardar2">
                            <button type="button" class="btn btn-light" id="closeModalButton"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="" class="btn btn-primary" onclick="actualizar()">Actualizar</button>

                        </div>
                        <div class="modal-footer" style="display:none" id="btn_load2">
                            <button class="btn btn-primary" type="button" disabled>
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script>
            function cambio_contrasenia() {

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
            }

            function actualizar() {
                $('#btn_guardar2').hide();
                $('#btn_load2').show();
                let nueva_contrasenia = $("#nueva_contrasenia").val();
                let confirma_contrasenia = $("#confirma_contrasenia").val();

                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Opciones/actualizarContrasenia",
                    dataType: "json",
                    data: {
                        'nueva_contrasenia': nueva_contrasenia,
                        'confirma_contrasenia': confirma_contrasenia,
                        'id_usuario': <?= $session->id_usuario ?>
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.error) {
                            // Mensaje de error proveniente del backend
                            Swal.fire("Error", data.respuesta, "error");
                        } else {
                            // Mensaje de éxito
                            Swal.fire("¡Hecho!", data.respuesta, "success");
                            window.location.href = `${base_url}index.php/Login/cerrar`;
                        }
                        $('#btn_guardar2').show();
                        $('#btn_load2').hide();
                    },
                    error: function(xhr, status, error) {
                        // Convierte responseText en un objeto JSON
                        let response;
                        try {
                            response = JSON.parse(xhr.responseText); // Intenta parsear la respuesta
                        } catch (e) {
                            console.error("Error al parsear la respuesta: ", e);
                            response = {
                                message: "Ocurrió un error desconocido."
                            }; // Mensaje por defecto en caso de fallo
                        }

                        // Maneja el mensaje del servidor
                        const message = response.message || "Error desconocido";
                        console.log(message);

                        // Mostrar mensajes y manejar botones
                        $('#btn_guardar2').show();
                        $('#btn_load2').hide();
                        Swal.fire("Error", message, "error");
                    }

                });
            }
            </script>