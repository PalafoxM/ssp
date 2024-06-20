<style>
   .imagenLogin{
    max-width:50%;
    height: auto;
   
}

   @media only screen and (max-width: 1600px) {
        .imagenLogin img{
            width:65%;
           
        }  
    }
   @media only screen and (max-width: 1400px) {
    #txtTitulo{
            display:none;
        }  
    }
</style>
<link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet" type="text/css"  />
<div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box" >
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start ">
                            
                            <a href="#" class="logo-light text-center imagenLogin ">
                                <span><img src="<?php echo base_url();?>/assets/images/st4.png" alt="Logo" class="img-fluid"></span>
                            </a>
                        </div>

                        <div class="text-center " id="txtTitulo">
                        <h2 class="mt-0" style="color: #069">Sistema de Turnos 2.0</h2>
                        <p class="text-muted mb-4">Ingrese usuario y contraseña</p>
                        <!-- <span id="tamanioPantalla" style="color:red"></span> -->

                        </div>
                        <!-- form -->
                        <form id="login" name="login" autocomplete="off">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input class="form-control" type="text" id="usuario" name="usuario" required="" placeholder="Ingresa tu usuario">
                            </div>
                            <div class="mb-3">
                                <!--<a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Recuperar contraseña</small></a>-->
                                <label for="contrasenia" class="form-label">Contraseña</label>
                                <input class="form-control" type="password" required="" id="contrasenia" name="contrasenia" placeholder="Ingresa tu contraseña">
                            </div>
                            
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Entrar </button>
                            </div>
                        </form>
                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-left">
                <div class="auth-user-testimonial">
                    <img src="<?php echo base_url().'/assets/images/logo2_blanco.png'?>" alt width="183px" height="80px">
                    <img src="<?= base_url("/assets/images/Logo DGPyD.png")?>" alt  height="60px">
                    <img src="<?= base_url("/assets/images/DTIC-8.png")?>" alt  height="60px">
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <script>
            saeg.principal.login();
            // // Función para actualizar el tamaño de pantalla en el span
            //     function actualizarTamanioPantalla() {
            //         // Obtener el ancho y alto de la pantalla
            //         var anchoPantalla = window.innerWidth;
            //         var altoPantalla = window.innerHeight;

            //         // Mostrar los valores en el span
            //         var spanTamanioPantalla = document.getElementById("tamanioPantalla");
            //         spanTamanioPantalla.textContent = "Ancho: " + anchoPantalla + "px, Alto: " + altoPantalla + "px";
            //     }

            //     // Llamar a la función inicialmente para mostrar el tamaño de pantalla actual
            //     actualizarTamanioPantalla();

            //     // Agregar un evento de cambio de tamaño para actualizar dinámicamente el tamaño de pantalla
            //     window.addEventListener("resize", actualizarTamanioPantalla);
        </script>