<?php  $session = \Config\Services::session();    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    
<style>
    .neon {
        display: inline-block;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        border: none;
        font: normal 20px/normal "Warnes", Helvetica, sans-serif;
        color: rgba(255,255,255,1);
        text-decoration: normal;
        text-align: center;
        -o-text-overflow: clip;
        text-overflow: clip;
        white-space: pre;
        text-shadow: 0 0 10px rgba(255,255,255,1) , 0 0 20px rgba(255,255,255,1) , 0 0 30px rgba(255,255,255,1) , 0 0 40px #ff00de , 0 0 70px #ff00de , 0 0 80px #ff00de , 0 0 100px #ff00de ;
        -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
        -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
        -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
        transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
       
    }

    .neon:hover {
    text-shadow: 0 0 10px rgba(255,255,255,1) , 0 0 20px rgba(255,255,255,1) , 0 0 30px rgba(255,255,255,1) , 0 0 40px #00ffff , 0 0 70px #00ffff , 0 0 80px #00ffff , 0 0 100px #00ffff ;
    }
    body{
        background-color: #d1d7d9;
    }
    section{
        border: 2px solid darkgray;
        padding: 20px;
        margin-top: 10px;
    }
    .enLiniea{
        display: flex;
        align-items: stretch;
    }
    .item {
        flex-grow: 4; /* default 0 */
    }
    table {
            border-collapse: collapse;
            width: 100%;
        }
    th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

    /* Estilo para todas las opciones */
    .opciones {
        font-weight: bold;
        color:black ;
    }

    /* Estilo para las dos primeras opciones en el select */
    .primeras2 {
        font-weight: bold;
        color: blue;
    }
    .primeras2:hover{
        color:#d1d7d9;
    }
    .icono{
        font-weight: bold;
        color:yellow;
    }
</style>
<body>
    <div class=" mt-3">
        <form id="formAgregarTurno" name="formAgregarTurno" >
            <div class="row">
                <!-- seccion izquierdo incio -->
                <div class="col-md-12 ">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>DATOS GENERALES</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="asunto" class="form-label">ASUNTO</label>
                                    <select class="form-select form-control-sm " id="asunto" name="asunto"  >
                                            <option value="">SELECCCIONE..</option>
                                        <?php foreach ($cat_asuntos as $opcion) : ?>
                                            <option value="<?= $opcion->id_asunto ?>"><?= strtoupper($opcion->dsc_asunto) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               
                                    <div class="mb-3 position-relative" id="datepicker1">
                                        <label class="form-label">FECHA PETICIÓN</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker1" id="fecha_peticion" name="fecha_peticion" placeholder="dd/mm/dddd">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="mb-3 position-relative" id="datepicker2">
                                        <label class="form-label">FECHA PETICIÓN</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker2" id="fecha_recepcion" name="fecha_recepcion" placeholder="dd/mm/dddd">
                                    </div>
                                    
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                               
                                    <div class="mb-3">
                                        <label for="titulo_inv" class="form-label">TITULO</label>
                                        <input type="text" id="titulo_inv" name="titulo_inv" class="form-control form-control-sm">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="nombre_t" class="form-label">NOMBRE</label>
                                        <input type="text" id="nombre_t" name="nombre_t" class="form-control form-control-sm" placeholder="NOMBRE">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="primer_apellido" class="form-label">PRIMER APELLIDO</label>
                                        <input type="text" id="primer_apellido" name="primer_apellido" class="form-control form-control-sm" placeholder="PRIMER APELLIDO">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="segundo_apellido" class="form-label">SEGUNDO APELLIDO</label>
                                        <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control form-control-sm" placeholder="SEGUNDO APELLIDO">
                                    </div>
                                  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cargo_inv" class="form-label">CARGO</label>
                                    <input type="text" id="cargo_inv" name="cargo_inv" class="form-control form-control-sm" placeholder="CARGO">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="razon_social_inv" class="form-label">RAZON SOCIAL</label>
                                    <input type="text" id="razon_social_inv" name="razon_social_inv" class="form-control form-control-sm" placeholder="RAZON SOCIAL">
                                </div>
                            </div>
                        </div>
                            <div class="mb-3">
                                <label class="form-label">SINTESIS ASUNTO</label>
                                <textarea name="resumen" id="resumen" data-toggle="maxlength" class="form-control" maxlength="225" rows="5" 
                                    placeholder="Tiene un limite 225 caracteres."></textarea>
                            </div>
                        </div>    
                    </div><!--end card -->
                </div>
                <!-- seccion izquierdo fin-->
                <!-- seccion derecha incio -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>TURNAR A:</h3>
                            <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="nombre_turno" class="form-label">NOMBRE</label>
                                    <select class="select2 form-select form-control-sm" id="nombre_turno" name="nombre_turno">
                                    <option value="">SELECCCIONE..</option>
                                        <?php foreach ($turnado as $opcion) : ?>
                                            <option value="<?= $opcion->id_destinatario ?>"><?= strtoupper($opcion->nombre_destinatario ." ". $opcion->cargo) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="dependencia" class="form-label">DEPENDENCIA</label>
                                    <input type="text" id="dependencia" name="dependencia" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check form-checkbox-success mt-4">
                                    <input type="checkbox" class="form-check-input" id = "confirmacion" name = "confirmacion" checked>
                                    <label class="form-check-label" for="confirmacion">CONFIRMACIÓN</label>
                                </div>
                            </div><!--END CARD -->
                        </div>
                    </div>
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <!-- <h3>CON COPIA PARA:</h3>
                            <!-- Info Header Modal -->
                                <!--<button  type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_cpp">AGREGAR</button> -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3>CON COPIA PARA:</h3>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_cpp"> <i class="dripicons-plus icono"></i> AGREGAR</button>
                                </div>
                                <div id="modal_cpp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-full-width">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-info">
                                                <h4 class="modal-title" id="info-header-modalLabel">CON COPIA PARA:</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                               <div class="mb-3">
                                                    <label for="cpp" class="form-label">NOMBRES</label> <small class=""><strong>Nota:</strong> puedes seleccionar todos los nombres que necesites:</small>
                                                    <select class="form-select form-control-sm select2" id="cpp" name="cpp[]" multiple="multiple">
                                                    <option ></option>
                                                    <?php $count = 0; ?>
                                                        <?php foreach ($turnado as $opcion) : ?>
                                                            <option value="<?= $opcion->id_destinatario ?>" <?php echo ($count < 2) ? 'class="primeras2"' :'class="opciones"' ?>>
                                                                <?= strtoupper($opcion->nombre_destinatario ." ". $opcion->cargo) ?>
                                                            </option>
                                                            <?php $count++; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div> 
                                                        

                                                <div class="container">
                                                    <table id="selectedValuesTable">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>NOMBRE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">CERRAR</button>
                                                <!-- <button type="button" class="btn btn-info">GUARDAR</button> -->
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- tablas con nombres  -->
                                <div class="container">
                                <table id="selectedValuesTable1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            
                        </div>
                    </div><!--END CARD -->
                    <div class="card"><!--init card -->
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3>INDICACIONES:</h3>
                            <!-- Full width modal -->
                            <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_indicacion"><i class="dripicons-plus icono"></i> AGREGAR</button>
                        </div>    
                            <div id="modal_indicacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="fullWidthModalLabel">AGREGAR INDICACIONES:</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="indicacion1" class="form-label">SELECCIONE</label>
                                                <select class="form-select form-control-sm select2" id="indicacion" name="indicacion[]" multiple="multiple">
                                                <option value="">SELECCCIONE..</option>
                                                    <?php foreach ($cat_indicaciones as $opcion) : ?>
                                                        <option value="<?= $opcion->id_indicacion ?>"><?= strtoupper($opcion->dsc_indicacion) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                                <div class="container">
                                                    <table id="selectedValuesIndicacion">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>NOMBRE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CERRAR</button>
                                            <!-- <button type="button" class="btn btn-primary">GUARDAR</button> -->
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div class="container">
                                <table id="selectedValuesIndicacion1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                        
                        </div>
                    </div><!--END CARD -->
                    </div>    
                <!-- seccion derecha fin -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="tramito" class="form-label">TRAMITÓ</label>
                                        <span class="form-control form-control-sm" ><?php echo strtoupper(htmlspecialchars($nombre_completo)); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firma_turno" class="form-label">FIRMA DEL TURNO</label>
                                        <select class="form-select form-control-sm select2" id="firma_turno" name = "firma_turno" >
                                        <!-- <option value="">SELECCCIONE..</option> -->
                                            <option></option>
                                            <?php foreach ($firmaTurno as $opcion) : ?>
                                                <option value="<?= $opcion->id_destinatario ?>"><?=  strtoupper($opcion->nombre_destinatario) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">ESTATUS</label>
                                        <select class="form-select form-control-sm " id="status" name="status">
                                                <!-- <option value="">SELECCCIONE..</option> -->
                                            <option></option>
                                            <?php foreach ($cat_estatus as $opcion) : ?>
                                                <?php
                                                    $selected = ($opcion->id_estatus == 1) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $opcion->id_estatus ?>" <?= $selected ?>>
                                                    <?= strtoupper($opcion->dsc_status) ?>
                                                </option>
                                                <!-- <option value="<?= $opcion->id_estatus ?>"><?=  strtoupper($opcion->dsc_status) ?></option> -->
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div><!--END CARD -->    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="resultado_turno" class="form-label">RESULTADO DEL TURNO</label>
                                <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="5" 
                                    placeholder="Tiene un limite 225 caracteres." id="resultado_turno" name="resultado_turno"></textarea>
                            </div>
                        </div>
                    </div><!--END CARD -->
                </div>
            </div>
            <!-- <div class="row text-right justify-content-center mt-3 mb-3">    -->
                <div class="row mb-5 ">
                    <div class="col-md-12 text-center ">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save"></i> Guardar </button>
                        <button class="btn btn-danger" type="button" onclick="st.agregar.cancelarTurno();"><i class="mdi mdi-content-save-off-outline" id="cancelarTurno" ></i> Cancelar </button>
                    </div>
                </div>
            <!-- </div> -->
        </form>    
    </div>
<script>
    $(document).ready(function(){
        st.agregar.saveTempccp();
        st.agregar.saveTempIndicacion();
        $('#nombre_turno').select2();
        $('#indicacion1').select2();
        $('#indicacion2').select2();
        $('#indicacion3').select2();
        $('#indicacion4').select2();
        $('#tramito').select2();
        $('#firma_turno').select2({
            placeholder: "SELECCCIONE..",
        });
        $('#status').select2({
            placeholder: "SELECCCIONE..",
        });
        $('#cpp').select2({
            dropdownParent: $("#modal_cpp") ,
            placeholder: "SELECCCIONE..",
            templateResult: function (data) {    
                if (!data.element) {
                return data.text;
                }
                var $element = $(data.element);
                var $wrapper = $('<span></span>');
                $wrapper.addClass($element[0].className);
                $wrapper.text(data.text);
                return $wrapper;
            }
        });
        $('#indicacion').select2({dropdownParent: $("#modal_indicacion") });

        
       
       
    });
</script>
</body>
</html>