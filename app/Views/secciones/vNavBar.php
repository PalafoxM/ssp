<!-- Topbar Start -->
<?php $session = \Config\Services::session(); ?>

<div class="navbar-custom topnav-navbar-dark">
    <ul class="list-unstyled topbar-menu float-end mb-0">      
        
        <li class="dropdown notification-list d-lg-none">
            <div id="titulo">
                <h3>SISTEMA DE TURNOS 2.0</h3>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="<?php echo base_url();?>/assets/images/user.png"  class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name"><?php echo $session->get('nombre_completo');?></span>
                    <!-- <span class="account-position"><?php //echo $session->get('dsc_perfil');?></span> -->
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                
                <!-- item-->
                <!-- <a href="#" onClick="saeg.general.cambiar_foto_perfil();" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>Subir foto de perfil</span>
                </a> -->
                <!-- item-->
                <a href="<?php echo base_url()?>index.php/Login/cerrar" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Salir</span>
                </a>

            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">

        <div id="titulo">
            <h4>SISTEMA DE TURNOS 2.0</h4>
        </div>
        
    </div>
</div>
<!-- end Topbar - -->
<!-- <div id="mdl_subir_foto_perfil" class="modal fade"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form action="javascript:;" id="frmDocumentoSustituir" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Subir foto de perfil</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">    
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">                                
                            <strong>!Atención! - </strong> El nombre del documento no debe contener caracteres raros. ej: #$%¡?#"!"*¨[]
                        </div>                                            
                        <div class="col-md-12">
                                <label for="input_doc_foto">Subir foto de perfil</label>      
                                <div class="file-loading">                      
                                    <input id="input_doc_foto" name="input_doc_foto" type="file" class="file"  data-theme="fas"> 
                                </div>                               
                        </div>                        
                                                                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </form>
        </div>
    </div>
</div> -->

<script>        
    $("#input_doc_foto").fileinput({
        language: 'es',
        uploadUrl: base_url + '/index.php/Usuario/SubirFotoPerfil', //SubiendoDocumentoSustituir
        enableResumableUpload: true,
        resumableUploadOptions: {
            // uncomment below if you wish to test the file for previous partial uploaded chunks
            // to the server and resume uploads from that point afterwards
            // testUrl: "http://localhost/test-upload.php"
        },                        
        maxFileCount: 1,
        //allowedFileTypes: ['image'],    // allow only images
        maxFileSize: 1000,
        showCancel: true,
        //initialPreviewAsData: true,
        //overwriteInitial: false,
        // initialPreview: [],          // if you have previously uploaded preview files
        // initialPreviewConfig: [],    // if you have previously uploaded preview files
        //theme: 'fa5',
        //deleteUrl: "http://localhost/file-delete.php",
        allowedFileExtensions: ['jpg','jpeg','png','JPG','PNG']
    }).on('fileuploaded', function(event, previewId, index, fileId) {
        console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);            
    }).on('fileuploaderror', function(event, data, msg) {
        console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);
    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
        console.log('File Batch Uploaded', preview, config, tags, extraData);
        Swal.fire("", "Se subió correctamente su foto de perfil", "success");
        $('#mdl_subir_foto_perfil').modal('hide');
        document.location.reload(true);
        //sass.repositorio.carga_docucumentos_repositorio();
    });
</script><!-- /.modal-dialog -->