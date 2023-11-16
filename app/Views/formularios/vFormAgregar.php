<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
</head>
<style>
    section{
        border: 2px solid darkgray;
        padding: 20px;
        margin-top: 10px;
    }
</style>
<body>
    <div class=" mt-3">
        <form id="agregarTurno" name="agregarTurno" >
            <div class="row">
                <!-- seccion izquierdo incio -->
                <div class="col-md-6">
                    <section>
                        <h3>DATOS DE LA INVITACIÓN</h3>
                        <div class="mb-3">
                            <label for="example-select" class="form-label">ASUNTO</label>
                            <select class="form-select form-control-sm" id="example-select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="example-date" class="form-label">FECHA PETICION</label>
                            <input class="form-control form-control-sm" id="example-date" type="date" name="date">
                        </div>

                        <div class="mb-3">
                            <label for="example-date" class="form-label">FECHA RECEPCION</label>
                            <input class="form-control form-control-sm" id="example-date" type="date" name="date">
                        </div>
                    
                        <div class="mb-3">
                            <label for="simpleinput" class="form-label">TITULO</label>
                            <input type="text" id="simpleinput" class="form-control form-control-sm">
                        </div>

                        <div class="mb-3">
                            <label for="simpleinput" class="form-label">NOMBRE</label>
                            <input type="text" id="simpleinput" name="example-text" class="form-control form-control-sm" placeholder="NOMBRE">
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
                    </section>
                </div>
                <!-- seccion izquierdo fin-->
                <!-- seccion derecha incio -->
                <div class="col-md-6">
                    <section>
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
                    </section>
                    <section>
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
                    </section>
                    <section>
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
                    </section>
                </div>    
                <!-- seccion derecha fin -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <section>
                        <div class="mb-3">
                            <label for="example-textarea" class="form-label">RESULTADO DEL TURNO</label>
                            <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3" 
                                placeholder="Tiene un limite 225 caracteres."></textarea>
                        </div>
                    </section>
                </div>
                <div class="col-md-6">
                    <section>
                        <div class="mb-3">
                            <label for="example-select" class="form-label">TRAMITO</label>
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
                    </section>
                </div>
            </div>
            <div class="row text-right justify-content-center mt-3 mb-3">   
                <div class="col-md-2">
                    <button class="btn btn-primary d-inline " type="submit"><i class="mdi mdi-content-save"></i> Guardar </button>
                    <button class="btn btn-danger d-inline " type="button"><i class="mdi mdi-content-save-off-outline"></i> Cancelar </button>
                </div>
            </div>
        </form>    
    </div>
<script>
    //   $(document).ready(function() {
    //        st.agregar.hola();
    //     });
</script>
</body>
</html>