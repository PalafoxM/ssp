<?php $session = \Config\Services::session();?>
<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

<!-- LOGO -->
<a href="<?php echo base_url("/index.php/Junta/index/IjIi");?>" class="logo text-center logo-light">
    <span class="logo-lg">
        <img src="<?php echo base_url()?>/assets/images/jg.png" alt="" height="60">
    </span>
    <span class="logo-sm">
        <img src="<?php echo base_url();?>/assets/images/jg.png" alt="" height="28">
    </span>
</a>

<!-- LOGO -->
<a href="<?php echo base_url("/index.php/Junta/index/IjIi");?>" class="logo text-center logo-dark">
    <span class="logo-lg">
        <img src="<?php echo base_url();?>/assets/images/jg.png" alt="" height="16">
    </span>
    <span class="logo-sm">
        <img src="<?php echo base_url();?>/assets/images/jg.png" alt="" height="16">
    </span>
</a>

<div class="h-100" id="leftside-menu-container" data-simplebar>

    <!--- Sidemenu -->
    <ul class="side-nav">
        
        <li class="side-nav-title side-nav-item">MENÚ DEL SISTEMA</li>
<!--
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#gestion" aria-expanded="false" aria-controls="gestion" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Índice </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="gestion">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="<?= base_url("/index.php/")?>">Índice</a>
                    </li>
                </ul>
            </div>
        </li>   -->

        <?php if((int)$session->id_perfil == 1): ?>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#configuracion" aria-expanded="false" aria-controls="configuracion" class="side-nav-link">
                    <i class="uil-server"></i>
                    <span> Configuración </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="configuracion">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="<?= base_url("/index.php/Configuracion")?>">Configuración del sistema</a>
                        </li>
                    </ul>
                </div>
            </li> 
        <?php endif?> 
        
        <?php if((int)$session->id_perfil == 1): ?>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gestion" aria-expanded="false" aria-controls="gestion" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Usuarios </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gestion">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="<?= base_url("/index.php/Usuario")?>">Usuarios</a>
                        </li>
                    </ul>
                </div>
            </li> 
        <?php endif?> 
        
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#junta" aria-expanded="false" aria-controls="junta" class="side-nav-link">
                <i class="uil-meeting-board"></i>
                <span> Juntas </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="junta">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="<?= base_url("/index.php/Junta/index/IjIi")?>">Juntas activas</a>
                    </li>
                    <?php if((int)$session->id_perfil == 1): ?>
                        <li>
                            <a href="<?= base_url("/index.php/Junta/index/IjEi")?>">Juntas en construccion</a>
                        </li>
                        <li>
                            <a href="<?= base_url("/index.php/Junta/index/IjMi")?>">Juntas finalizadas</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </li>   
        
        <?php if((int)$session->id_perfil == 1): ?>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#reportes" aria-expanded="false" aria-controls="reportes" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>Reportes</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="reportes">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/Junta/reporteComentarios') ?>"> Reporte de comentarios</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/Junta/reporteVotaciones') ?>"> Reporte de votaciones</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/Junta/reporteVisualizaciones') ?>"> Reporte de visualizaciones</a>
                        </li>
                    </ul>
                </div>
            </li>   
        <?php endif?> 
        
    </ul>
    <div class="help-box text-white text-left" style="font-size: 80%; position: fixed; bottom: 0;">
<!--        <a href="javascript: void(0);" class="float-end close-btn text-white">
            <i class="mdi mdi-close"></i>
        </a>-->
        <h5 class="mt-3"><small>Diseño Conceptual</small></h5>
        <ul class="mb-3 list-unstyled">
            <li>Dra. Elia Lara Lona</li>
        </ul>
        <h5 class="mt-3"><small>Contenido</small></h5>
        <ul class="mb-3 list-unstyled">
            <li>Dra. Yessica Mireles Zavala</li>
            <li>Lic. Miriam Leticia Huerta Rosas</li>
            <li>Lic. Abel Eduardo García Conejo</li>
        </ul>
        <h5 class="mt-3"><small>Desarrollo</small></h5>
        <ul class="mb-3 list-unstyled">
            <li>Ing. Juan Pablo Barrientos Martínez</li>
            <li>Ing. Jonathan H. Rodríguez Salazar</li>
        </ul>
<!--        <p class="mb-3">Dra. Yessica Mireles Zavala</p>
        <p class="mb-3">Lic. Miriam Huerta</p>
        <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>-->
    </div>
    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->