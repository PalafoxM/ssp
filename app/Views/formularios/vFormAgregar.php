<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    
<style>
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
</style>
<body>
    <div class=" mt-3">
        <form id="formAgregarTurno" name="formAgregarTurno" >
            <div class="row">
                <!-- seccion izquierdo incio -->
                <div class="col-md-12 ">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>DATOS DE LA INVITACIÓN</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="asunto" class="form-label">ASUNTO</label>
                                    <select class="form-select form-control-sm " id="asunto" name="asunto"  >
                                            <option value="">SELECCCIONE..</option>
                                        <?php foreach ($cat_asunto as $opcion) : ?>
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
                                            <option value="<?= $opcion->id ?>"><?= strtoupper($opcion->nombre ." ". $opcion->cargo) ?></option>
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
                            <h3>CON COPIA PARA:</h3>
                            <!-- Info Header Modal -->
                                <button  type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_cpp">AGREGAR</button>
                                <div id="modal_cpp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-full-width">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-info">
                                                <h4 class="modal-title" id="info-header-modalLabel">CON COPIA PARA:</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                               <div class="mb-3">
                                                    <label for="cpp" class="form-label">NOMBRE 1</label>
                                                    <select class="form-select form-control-sm select2" id="cpp" name="cpp[]" multiple="multiple">
                                                    <option value="">SELECCCIONE..</option>
                                                        <?php foreach ($cppNombre as $opcion) : ?>
                                                            <option value="<?= $opcion->id ?>"><?= strtoupper($opcion->nombre ." ". $opcion->cargo) ?></option>
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
                            <!-- <div class="mb-3">
                                <label for="cpp1" class="form-label">NOMBRE 1</label>
                                <select class="form-select form-control-sm" id="cpp1" name="cpp1">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($cppNombre as $opcion) : ?>
                                        <option value="<?= $opcion->id ?>"><?= strtoupper($opcion->nombre ." ". $opcion->cargo) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->
                            <!-- <div class="mb-3">
                                <label for="cpp2" class="form-label">NOMBRE 2</label>
                                <select class="form-select form-control-sm" id="cpp2" name="cpp2">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($cppNombre as $opcion) : ?>
                                        <option value="<?= $opcion->id ?>"><?= strtoupper($opcion->nombre ." ". $opcion->cargo) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">NOMBRE 3</label>
                                <input type="text" id="cpp3" name="cpp3" class="form-control form-control-sm">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">NOMBRE 4</label>
                                <input type="text" id="cpp4" name="cpp4" class="form-control form-control-sm">
                            </div> -->
                        </div>
                    </div><!--END CARD -->
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>INDICACIONES:</h3>
                            <!-- Full width modal -->
                            <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_indicacion">INDICACIONES:</button>
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
                                                    <?php foreach ($indicacion as $opcion) : ?>
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
                            <!-- <div class="mb-3">
                                <label for="indicacion1" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm select2" id="indicacion1" name="indicacion1">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($indicacion as $opcion) : ?>
                                        <option value="<?= $opcion->id_indicacion ?>"><?= strtoupper($opcion->dsc_indicacion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="indicacion2" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm select2" id="indicacion2" name="indicacion2">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($indicacion as $opcion) : ?>
                                        <option value="<?= $opcion->id_indicacion ?>"><?= strtoupper($opcion->dsc_indicacion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="indicacion3" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm select2" id="indicacion3" name="indicacion3">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($indicacion as $opcion) : ?>
                                        <option value="<?= $opcion->id_indicacion ?>"><?= strtoupper($opcion->dsc_indicacion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="indicacion4" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm select2" id="indicacion4" name="indicacion4">
                                <option value="">SELECCCIONE..</option>
                                    <?php foreach ($indicacion as $opcion) : ?>
                                        <option value="<?= $opcion->id_indicacion ?>"><?= strtoupper($opcion->dsc_indicacion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->
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
                                        <select class="form-select form-control-sm select2" id="tramito" name="tramito">
                                        <option value="">SELECCCIONE..</option>
                                            <?php foreach ($tramito as $opcion) : ?>
                                                <option value="<?= $opcion->id_personal ?>"><?=  strtoupper($opcion->alias) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firma_turno" class="form-label">FIRMA DEL TURNO</label>
                                        <select class="form-select form-control-sm select2" id="firma_turno" name = "firma_turno">
                                        <option value="">SELECCCIONE..</option>
                                            <?php foreach ($firmaTurno as $opcion) : ?>
                                                <option value="<?= $opcion->id ?>"><?=  strtoupper($opcion->nombre) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">ESTATUS</label>
                                        <select class="form-select form-control-sm " id="status" name="status">
                                                <option value="">SELECCCIONE..</option>
                                            <?php foreach ($status as $opcion) : ?>
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
            <div class="row text-right justify-content-center mt-3 mb-3">   
                <div class="col-md-2">
                    <button class="btn btn-primary d-inline " type="submit"><i class="mdi mdi-content-save"></i> Guardar </button>
                    <button class="btn btn-danger d-inline " type="button" onclick="st.agregar.cancelarTurno();"><i class="mdi mdi-content-save-off-outline" id="cancelarTurno" ></i> Cancelar </button>
                </div>
            </div>
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
        $('#firma_turno').select2();
        $('#status').select2();
        // $('#cpp').select2();
        // $('#resultado_turno').maxlength({
        //     showMaxLength: false,
        //     alwaysShow: true,
        //     threshold: 10,
        //     warningClass: "label label-info",
        //     limitReachedClass: "label label-warning",
        //     placement: 'bottom',
        //     message: 'usados %charsTyped% de %charsTotal% caractares.'
            
        // });
        $('#cpp').select2({dropdownParent: $("#modal_cpp") });
        $('#indicacion').select2({dropdownParent: $("#modal_indicacion") });
    });
</script>
</body>
</html>