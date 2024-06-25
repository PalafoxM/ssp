<div class="card">
    <div class="car-body">
        <h4 class="m-3">BUSQUEDA POR FECHAS</h4>
        <div class="container mt-5">
        <form id="formReporte">
        <div class="row g-2">    
            <?php 
             $fechaActual = date('d/m/Y');
            ?>
            <div class="mb-3 position-relative col-md-2"  id="datepicker4">
                <label class="form-label">FECHA INICIAL  <i class='mdi mdi-calendar'></i></label>
                <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4" id="fecha_inicio" name="fecha_inicio" placeholder="DD/MM/AAAA" value="">
            </div>

            <div class="mb-3 position-relative col-md-2" id="datepicker5">
                <label class="form-label">FECHA FINAL <i class='mdi mdi-calendar'></i></label>
                <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker5" id="fecha_final" name="fecha_final" placeholder="DD/MM/AAAA" value="<?php echo $fechaActual; ?>">
            </div>

            
            <div class="mb-3 col-md-3">
                <label for="resultado_turno" class="form-label">RESULTADO DE TURNO</label>
                <select id="resultado_turno" name="resultado_turno" class="form-select">
                    <option value="">Seleccione</option>
                        <?php foreach ($cat_resultado_turno->data as $item): ?>
                            <option value="<?php echo $item->id_resultado_turno; ?>"><?php echo $item->descripcion; ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label for="estatus" class="form-label">ESTATUS</label>
                <select id="estatus" name="estatus" class="form-select">
                    <option value="">Seleccione</option>
                        <?php foreach ($cat_estatus->data as $item): ?>
                            <option value="<?php echo $item->id_estatus; ?>"><?php echo $item->dsc_status; ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-2 ">
                <label for="btnGuardar" class="form-label"></label>
                <button type="submit" class="btn btn-primary form-control mt-1" id="btnGuardar">Mostrar</button>     
            </div>
        </div> 
        <!-- Fecha_Recepcion -->
        </form>
        </div>
    </div>
</div>
<table
        id="table"
        data-locale="es-MX"
        data-toolbar="#toolbar"
        data-toggle="table"
        data-search="true"
        data-search-highlight="true"
        data-pagination="true"
        data-page-list="[10, 25, 50, 100, all]"
        data-sortable="true"
        data-show-refresh="true"
        data-header-style="headerStyle"
        data-url="<?=base_url("/index.php/Reportes/getPrincipal")?>">
        <thead>
            <tr>
                <th data-field="id_turno" data-width="20" data-sortable="true" class="text-center">FOLIO</th>
                <th data-field="fecha_recepcion" data-width="20" data-sortable="true" data-formatter="ini.reportes.formattFechaRecepcion">FECHA RECEPCION</th>
                <th data-field="solicitante_nombre" data-width="100" data-sortable="true">REMITENTE</th>
                <th data-field="solicitante_razon_social" data-width="50" data-sortable="true">RAZON SOCIAL</th>
                <th data-field="resumen" data-width="100" data-sortable="true"  data-formatter="ini.reportes.formatterTruncaTexto" data-tooltip="true">SINTESIS ASUNTO</th>
                <th data-field="resultado_turno" data-width="100" data-sortable="true" data-formatter="ini.reportes.formatterTruncaTexto" data-tooltip="true">RESULTADO TURNO</th>
                <th data-field="id_estatus" data-width="20" data-sortable="true" data-formatter="ini.reportes.formatteStatus" class="text-center" >ESTATUS</th>
            </tr>
        </thead>
    </table>  
<link href="<?php echo (base_url('/assets/bootstrap-table-master/dist_/bootstrap-table.min.css'));?>" rel="stylesheet">
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/bootstrap-table.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/tableExport.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/bootstrap-table-locale-all.min.js');?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-table-master/dist_/extensions/export/bootstrap-table-export.min.js');?>"></script>
<script>
    $(document).ready(function(){
        $('#fecha_inicio').datepicker({
            format: 'dd-mm-yyyy',
            language: 'es',
            autoclose: true,
            container: '#datepicker4',
            endDate: '0d', // Esto limita la selección a fechas hasta el día de hoy inclusive.
        });
        $('#fecha_final').datepicker({
            format: 'dd-mm-yyyy',
            language: 'es',
            autoclose: true,
            container: '#datepicker5',
            endDate: '0d', // Esto limita la selección a fechas hasta el día de hoy inclusive.
        });
    });
</script>