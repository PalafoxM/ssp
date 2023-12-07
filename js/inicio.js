var ini = window.ssa || {};

ini.inicio = (function () {
    return {
        
        abrirVentanaPdf: function(idTurno) {
            var pdfUrl = base_url + "index.php/Inicio/pdfTurno?id_turno=" + idTurno;
            var opcionesVentana = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=800';
            window.open(pdfUrl, '_blank', opcionesVentana);
        },
        formatterAccionesTurno: function(value,row){
            let accion = ``;
            accion += `<button type="button" onclick="ini.inicio.abrirVentanaPdf(${row.id_turno})" class="btn btn-info" title="Mostrar"><i class="mdi mdi-file-pdf"></i> </button>`
            accion += `<button type="button"  class="btn btn-primary ml-1" title="Modificar"><i class="mdi mdi-lead-pencil"></i> </button>`
                // return `<button type="button" onclick="ini.inicio.abrirVentanaPdf(${row.id_turno})" class="btn btn-info"><i class="mdi mdi-file-pdf"></i> </button>`;
            return accion;
        },
        formatterTruncaTexto:function(value, row) {
            var maxLength = 20;
            var truncatedValue = value.length > maxLength ? value.substring(0, maxLength) + '...' : value;
            return '<span data-toggle="tooltip" title="' + value + '">' + truncatedValue + '</span>';
        },
        formatteStatus: function(value, row){
            // 
            if(value ==1){
                
                return '<button type="button" class="btn btn-success "data-toggle="tooltip" title="En proceso"><i class="mdi mdi-flag"></i></button>';
            }
            if(value ==2){
                return '<button type="button" class="btn btn-info" data-toggle="tooltip" title="Resuelta"><i class="mdi mdi-flag" ></i></button>';
            }
        }
        
        
    }
})();