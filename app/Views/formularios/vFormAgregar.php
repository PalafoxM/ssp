<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
</head>
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
</style>
<body>
    <div class=" mt-3">
        <form id="formAgregarTurno" name="formAgregarTurno" >
            <div class="row">
                <!-- seccion izquierdo incio -->
                <div class="col-md-6">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>DATOS DE LA INVITACIÓN</h3>
                            <div class="mb-3">
                                <label for="asunto" class="form-label">ASUNTO</label>
                                <select class="form-select form-control-sm " id="asunto" name="asunto"  >
                                        <option value="">SELECCCIONE..</option>
                                    <?php foreach ($cat_asunto as $opcion) : ?>
                                        <option value="<?= $opcion->id_asunto ?>"><?= $opcion->dsc_asunto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="enLiniea">
                                <div class="mb-3 item">
                                    <label for="fecha_peticion" class="form-label ">FECHA PETICIÓN</label>
                                    <input class="form-control form-control-sm" id="fecha_peticion" name="fecha_peticion" type="date" >
                                </div>
                                <div class="mb-3 item">
                                    <label for="fecha_recepcion" class="form-label">FECHA RECEPCIÓN</label>
                                    <input class="form-control form-control-sm" id="fecha_recepcion" type="date" name="fecha_recepcion">
                                </div>
                            </div>
                            
                        
                            <div class="mb-3">
                                <label for="titulo_inv" class="form-label">TITULO</label>
                                <input type="text" id="titulo_inv" name="titulo_inv" class="form-control form-control-sm">
                            </div>

                            <div class="mb-3">
                                <label for="nombre_t" class="form-label">NOMBRE</label>
                                <input type="text" id="nombre_t" name="nombre_t" class="form-control form-control-sm" placeholder="NOMBRE">
                            </div>

                            <div class="mb-3">
                                <label for="example-email" class="form-label">PRIMER APELLIDO</label>
                                <input type="text" id="example-text" name="example-text" class="form-control form-control-sm" placeholder="PRIMER APELLIDO">
                            </div>
                            <div class="mb-3">
                                <label for="example-text" class="form-label">SEGUNDO APELLIDO</label>
                                <input type="text" id="example-text" name="example-text" class="form-control form-control-sm" placeholder="SEGUNDO APELLIDO">
                            </div>
                            <div class="mb-3">
                                <label for="example-text" class="form-label">CARGO</label>
                                <input type="text" id="example-text" name="example-text" class="form-control form-control-sm" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="example-text" class="form-label">RAZON SOCIAL</label>
                                <input type="text" id="example-text" name="example-text" class="form-control form-control-sm" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SINTESIS ASUNTO</label>
                                <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3" 
                                    placeholder="Tiene un limite 225 caracteres."></textarea>
                            </div>
                        </div>    
                    </div><!--end card -->
                </div>
                <!-- seccion izquierdo fin-->
                <!-- seccion derecha incio -->
                <div class="col-md-6">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>TURNAR A:</h3>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">NOMBRE</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">DEPENDENCIA</label>
                                <input type="text" id="simpleinput" class="form-control form-control-sm">
                            </div>

                            <div class="form-check form-checkbox-success mb-2">
                                <input type="checkbox" class="form-check-input" id="customCheckcolor2" checked>
                                <label class="form-check-label" for="customCheckcolor2">CONFIRMACIÓN</label>
                            </div>
                        </div><!--END CARD -->
                    </div>
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>CON COPIA PARA:</h3>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">NOMBRE 1</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">NOMBRE 2</label>
                                <input type="text" id="simpleinput" class="form-control form-control-sm">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">NOMBRE 3</label>
                                <input type="text" id="simpleinput" class="form-control form-control-sm">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">NOMBRE 4</label>
                                <input type="text" id="simpleinput" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div><!--END CARD -->
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <h3>INDICACIONES:</h3>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">SELECCIONE</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div><!--END CARD -->
                </div>    
                <!-- seccion derecha fin -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">RESULTADO DEL TURNO</label>
                                <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3" 
                                    placeholder="Tiene un limite 225 caracteres."></textarea>
                            </div>
                        </div>
                    </div><!--END CARD -->
                </div>
                <div class="col-md-6">
                    <div class="card"><!--init card -->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">TRAMITÓ</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">FIRMA DEL TURNO</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-select" class="form-label">ESTATUS</label>
                                <select class="form-select form-control-sm" id="example-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
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
      
</script>
</body>
</html>