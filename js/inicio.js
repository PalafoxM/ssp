var ini = window.ssa || {};

ini.inicio = (function () {
    return {
        
        abrirVentanaPdf: function(idTurno) {
            var pdfUrl = base_url + "index.php/Inicio/pdfTurno?id_turno=" + idTurno;
            var opcionesVentana = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=800';
            window.open(pdfUrl, '_blank', opcionesVentana);
        },
        obtenerNombreMes: function(indiceMes) {
            var meses = [
              "enero", "febrero", "marzo", "abril", "mayo", "junio",
              "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
            ];
            return meses[indiceMes];
          },
        calculaFecha: function(valor,dias){
            var fechaReferencia = new Date(valor); 
            var fechaActual = new Date();
            var diferenciaMilisegundos = fechaActual - fechaReferencia;
            var diferenciaDias = Math.floor(diferenciaMilisegundos / (1000 * 60 * 60 * 24));
            var diasParaVerificar = dias;
            if (diferenciaDias >= diasParaVerificar) {
                return true;
            } else {
                return false;
            }
        },
        
        formatterAccionesTurno: function(value,row){
            let accion = ``;
            accion += `<button type="button" onclick="ini.inicio.abrirVentanaPdf(${row.id_turno})" class="btn btn-warning" title="Mostrar"><i class="mdi mdi-file-pdf"></i> </button>`
            accion += `<button type="button"  class="btn btn-secondary" title="Modificar" style="margin-left:5px"><i class="mdi mdi-lead-pencil"></i> </button>`
                // return `<button type="button" onclick="ini.inicio.abrirVentanaPdf(${row.id_turno})" class="btn btn-info"><i class="mdi mdi-file-pdf"></i> </button>`;
            return accion;
        },
        formatterTruncaTexto:function(value, row) {
            if(value === null) return "";
            var maxLength = 30;
            var truncatedValue = value.length > maxLength ? value.substring(0, maxLength) + '...' : value;
            return '<span data-toggle="tooltip" title="' + value + '">' + truncatedValue + '</span>';
        },
        formatteStatus: function(value, row){
            // TODO lo se es una mala practica hacer esto pero en este caso me es de mucha ayuda I'm sorry
            // opcion 1  
            // if(value ==1){
            //     let clase = ini.inicio.calculaFecha(row.fecha_recepcion, 10) ? '#fa5c7c' : (ini.inicio.calculaFecha(row.fecha_recepcion, 5)) ? '#f9bc0d': '#47d420';
            //     let titulo = ini.inicio.calculaFecha(row.fecha_recepcion, 10) ? 'Vencido' :ini.inicio.calculaFecha(row.fecha_recepcion, 5) ? 'Por vencer':'En proceso';
            //     return `<button type="button" class="btn" style="background:${clase}; color:#1D438A;" data-toggle="tooltip" title="${titulo}">En proceso </button>`;
            // }
            // if(value ==2){
            //     return '<button type="button" class="btn" style="background:#baddfd;color:#1D438A;" data-toggle="tooltip" title="Resuelta">Resuelta</button>';
            // }
            // opcion 2  
            if (value === '1') {
                let opciones = {
                    10: { clase: '#fa5c7c', titulo: 'Vencido' },
                    5: { clase: '#f9bc0d', titulo: 'Por vencer' },
                    default: { clase: '#47d420', titulo: 'En proceso' }
                };
                let key = ini.inicio.calculaFecha(row.fecha_recepcion, 10) ? 10 : ini.inicio.calculaFecha(row.fecha_recepcion, 5) ? 5 : 'default';
                let { clase, titulo } = opciones[key];
                return `<button type="button" class="btn" style="background:${clase}; color:#1D438A;" data-toggle="tooltip" title="${titulo}">${titulo}</button>`;
            }
            if (value === '2') {
                return '<button type="button" class="btn" style="background:#baddfd;color:#1D438A;" data-toggle="tooltip" title="Resuelta">Resuelta</button>';
            }     
        },
        formattFechaRecepcion: function(value,row){
           
            var fechaOriginalString = value;
            var fechaOriginal = new Date(fechaOriginalString);
            fechaOriginal.setMinutes(fechaOriginal.getTimezoneOffset());
            var dia = fechaOriginal.getDate();
            var mes = ini.inicio.obtenerNombreMes(fechaOriginal.getMonth()); // Sumar 1 al índice del mes
            var año = fechaOriginal.getFullYear();
            var nuevoFormato = dia + " de " + mes + " de " + año;
            return '<strong>' + nuevoFormato + '</strong>';
        }
        
        
    }
})();