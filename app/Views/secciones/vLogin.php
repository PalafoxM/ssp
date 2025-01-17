 <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-xxl-4 col-lg-5">
                 <div class="card">

                     <!-- Logo -->
                     <div class="card-header pt-4 pb-4 text-center bg-primary">
                         <a href="index.html">
                             <span><img src="<?php echo base_url();?>assets/images/logo.png" alt="" height="18"></span>
                         </a>
                     </div>

                     <div class="card-body p-4">

                         <div class="text-center w-75 m-auto">
                             <h4 class="text-dark-50 text-center pb-0 fw-bold">Ingresar</h4>
                             <p class="text-muted mb-4">INGRESAR SU CREDENCIALES DE ACCESO</p>
                         </div>

                         <form id="login" name="login" autocomplete="off">

                             <div class="mb-3">
                                 <label for="curp" class="form-label">CURP</label>
                                 <input class="form-control" type="text" id="curp" name="usuario" required=""
                                     placeholder="CURP">
                             </div>

                             <div class="mb-3">
                                 <a href="pages-recoverpw.html" class="text-muted float-end"><small>Olvide mi
                                         contraseña?</small></a>
                                 <label for="contrasenia" class="form-label">CONTRASEÑA</label>
                                 <div class="input-group input-group-merge">
                                     <input type="password" id="contrasenia" name="contrasenia" class="form-control"
                                         placeholder="Enter your password">
                                     <div class="input-group-text" data-password="false">
                                         <span class="password-eye"></span>
                                     </div>
                                 </div>
                             </div>

                             <div class="mb-3 mb-3">
                                 <div class="form-check">
                                     <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                     <label class="form-check-label" for="checkbox-signin">Recordarme</label>
                                 </div>
                             </div>

                             <div class="mb-3 mb-0 text-center" id="btn_entrar">
                                 <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Entrar
                                 </button>
                             </div>

                         </form>
                     </div> <!-- end card-body -->
                 </div>
                 <!-- end card -->

                 <div class="row mt-3">
                     <div class="col-12 text-center">
                         <p class="text-muted">No tengo Cuenta? <a href="pages-register.html"
                                 class="text-muted ms-1"><b>Sign Up</b></a></p>
                     </div> <!-- end col -->
                 </div>
                 <!-- end row -->

             </div> <!-- end col -->
         </div>
         <!-- end row -->
     </div>
     <!-- end container -->
 </div>
 <script>
saeg.principal.login();
 </script>