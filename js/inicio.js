var ini = window.ssa || {};

ini.inicio = (function () {
    return {
        
        abrirVentanaPdf: function(id) {
            var pdfUrl = base_url + "index.php/Inicio/pdfDependencia?id_practicante=" + id;
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
        
        formatterAcciones: function(value,row){
     
            let Botones = "<div class='contenedor'>" ;

            switch (row.valido) {
                case '2':
                    Botones += "<button onclick='ini.inicio.editarArchivo("+row.id_documento+")' class='btn btn-warning' title='Modificar Archivo' style='margin-left:5px'><i class='mdi mdi-lead-pencil'></i> </button>";
                    break;
                case '1':
                    Botones += "<i class='mdi mdi-check' style='color: green; font-size: 1.2rem;'></i>";
                    break;
                case '0':
                    Botones += "<i class='mdi mdi-help' style='color: grey; font-size: 1.2rem;'></i>";
                    break;
              
            }
        
            Botones += "</div>";
            return Botones;
        },
        editarArchivo: function(id_documento)
        {
            Swal.fire({
                title: "<strong>Subir Nuevo Archivo</strong>",
                icon: "info",
                html: `<input type='file' id="fileinput" class="form-control" >`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    let fileInput = $('#fileinput')[0].files[0];

                    if (!fileInput) {
                        Swal.fire("Error", "Es requerido el archivo PDF", "error");
                        return;
                    }
                    Swal.fire({
                        title: "Atención",
                        text: "Se enviará el archivo, ¿Desea proceder?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Proceder"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('file', fileInput);
                            formData.append('id_documento', id_documento);
                            $.ajax({
                                url: base_url + "index.php/Usuario/editarArchivo",
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log(response);
                                    if (!response.error) {
                                        Swal.fire("Genial", "El archivo se cargó correctamente.", "success");
                                        $('#documentoPracticante').bootstrapTable('refresh');
                                        
                                    } else {
                                        Swal.fire("Error", "Hubo un problema al procesar el archivo.", "error");
                                        console.log("Error: " + response.error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                    Swal.fire("Error", "Favor de llamar al Administrador", "error");
                                }
                            });
                        }
                    });
                }
            });
        },
        formatterAccionesTurno: function(value,row){
            let accion = "<div class='contenedor'>"+
                "<button type='button' onclick='ini.inicio.deleteUsuario("+ row.id_usuario+")' class='btn btn-danger' title='Mostrar'><i class='mdi mdi-delete'></i> </button>"+
                "<button type='button' data-bs-toggle='modal' data-bs-target='#modalAltaParticipante'  onclick='ini.inicio.getUsuario("+ row.id_usuario+")'  class='btn btn-warning' title='Modificar' style='margin-left:5px'><i class='mdi mdi-lead-pencil'></i> </button>"+
                "</div>";
            return accion;
        },
        formatterAccionesPracticante: function(value,row){
            let accion = "<div class='contenedor'>"+
                "<button type='button' onclick='ini.inicio.abrirVentanaPdf("+ row.id_practicante +")' class='btn btn-primary' title='Mostrar PDF'><i class='mdi mdi-file-pdf'></i> </button>"+
                "<a href="+base_url+"index.php/Inicio/formulario/"+ row.id_practicante+"/1/ type='button' class='btn btn-secondary' title='Editar'><i class='mdi mdi-border-color'></i> </a>"+
                "<button type='button' onclick='ini.inicio.eliminarPracticante("+ row.id_practicante+")' class='btn btn-danger' title='Eliminar'><i class='mdi mdi-delete'></i> </button>"+
                "</div>";
            return accion;
        },
        formatterTruncaTexto:function(value, row) {
            if(value === null) return "";
            var maxLength = 30;
            var truncatedValue = value.length > maxLength ? value.substring(0, maxLength) + '...' : value;
            return '<span data-toggle="tooltip" title="' + value + '">' + truncatedValue + '</span>';
        },
        formatteStatusResultadoTurno:function(value,row){
            if (value === '1') {
                return '<span  title="CON RESULTADO">CON RESULTADO</span>';
            }else if (value ==='2'){
                return '<span  title="SIN RESULTADO">SIN RESULTADO</span>';
            }else if (value ==='3'){
                return '<span  title="AMBOS">AMBOS</span>';
            }else{
                return '<span  title="SIN RESULTADO">SIN RESULTADO</span>';
            }
        },
        formatteStatus: function(value, row){
        
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
        },
        formattAcciones: function(value,row){
            let Botones = "<div class='contenedor'>" +
            "<button type='button' class='btn btn-danger' title='Remover' id='remover' onclick='ini.inicio.deleteUsuario(" + row.id_usuario + ")'><i class='mdi mdi-account-off'></i></button>" +
            "<button type='button' title='Editar' data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='btn btn-warning' onclick='ini.inicio.getUsuario(" + row.id_usuario + ")'><i class='mdi mdi-account-edit'></i></button>" +
            "</div>";
           return Botones;
        },
        reportesMensuales: function(value,row)
        {
            return `<a href=${base_url+row.ruta_relativa} target="_blank" title='Ver' 
                                class='btn btn-info'>
                            <i class='mdi mdi-file-pdf'></i>
                        </a>`;
        },
        accionesPracticanteDocumento: function(value,row)
        {
            let Botones = `<div class='contenedor'>`;
            
            Botones +=`<button type='button' title='Ver' 
                                data-bs-toggle='modal' 
                                data-bs-target='#bs-example-modal-lg' 
                                class='btn btn-info' 
                                onclick='ini.inicio.getDocumento(${row.id_usuario})'>
                            <i class='mdi mdi-file-pdf'></i>
                        </button>`;
            Botones += (row.visible == '1')? `
                        <button type='button' title='Subir reporte' 
                                class='btn btn-warning' 
                                onclick='ini.inicio.subirReporte(${row.id_usuario})'>
                            <i class='mdi mdi-file-pdf'></i>
                        </button>
                        <button type='button' title='Eliminar' 
                                        class='btn btn-danger' 
                                        onclick='ini.inicio.eliminarDocumento(${row.id_usuario})'>
                                    <i class='mdi mdi-delete'></i>
                                </button>
                              `:'';
             
           Botones += `</div>`;
        return Botones;
        },
        subirReporte: function(id)
        {
            Swal.fire({
                title: "<strong>Subir Reporte Mensual</strong>",
                icon: "info",
                html: `<input type='file' id="reporte" class="form-control" accept=".pdf" >`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    let fileInput = $('#reporte')[0].files[0];

                    if (!fileInput) {
                        Swal.fire("Error", "Es requerido el archivo PDF", "error");
                        return;
                    }
                    Swal.fire({
                        title: "Atención",
                        text: "Se enviará el reporte mensual, ¿Desea proceder?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Proceder"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('file', fileInput);
                            formData.append('id_practicante', id);
                            $.ajax({
                                url: base_url + "index.php/Usuario/reporteMensual",
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log(response);
                                    if (!response.error) {
                                        Swal.fire("Genial", response.respuesta  , "success");
                                        window.location.href = `${base_url}index.php/Inicio/reportes`;
                                        
                                        $('#documentoPracticante').bootstrapTable('refresh');
                                        
                                    } else {
                                        Swal.fire("Error", response.respuesta, "error");
                                        console.log("Error: " + response.error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                    Swal.fire("Error", "Favor de llamar al Administrador", "error");
                                }
                            });
                        }
                    });
                }
            });
        },
        accionesEstatusDocumento: function(value,row)
        {
            let Botones = `<div class='contenedor'>`;
            if (row.visible == '1') {
                Botones += '<span class="badge bg-success" title="ACTIVO">ACTIVO</span>';
            }else{
                Botones += '<span class="badge bg-danger" title="BAJA">BAJA</span>';
            }
            return Botones;
        },
        eliminarDocumento: function(id)
        {
            Swal.fire({
                title: "Se eliminara el registro",
                text: "Esta seguro de eliminar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceder"
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "index.php/Usuario/deleteUsuario",
                        dataType: "json",
                        data:{id_usuario:id},
                        success: function(data) {
                            if (data) {
                                console.log(data);
                                $('#tableUsuario').bootstrapTable('refresh');
                                Swal.fire({
                                    title: "Exito",
                                    text: "Se elimino correctamente",
                                    icon: "success"
                                  });
                            } else {
                                Swal.fire("info", "No se encontraron datos del usuario.", "info");
                            }
                        },
                        error: function() {
                            Swal.fire("info", "No se encontraron datos del usuario.", "info");
                        }
                    });
               
                }
              });
        },
        getDocumento: function(id_usuario){
        
            const documentMap = {
                'curp_archivo': document.getElementById('document-curp'),
                'fiscal_archivo': document.getElementById('document-fiscal'),
                'comprobante': document.getElementById('document-comprobante'),
                'edo_cuenta': document.getElementById('document-edo_cuenta'),
                'identificacion': document.getElementById('document-identificacion'),
                'acta': document.getElementById('document-acta'),
                'constancia': document.getElementById('document-constancia'),
                'facultativo': document.getElementById('document-facultativo'),
                'escolares': document.getElementById('document-escolares')
            };
    
            $.ajax({
                url: base_url + "index.php/Usuario/getDocumento",
                type: "POST",
                dataType: "json",
                data: { id_usuario: id_usuario },
                success: function(response) {
                    Object.values(documentMap).forEach(element => element.innerHTML = '');
    
                    if (response && response.length > 0) {
                        response.forEach(doc => {
                            const targetElement = documentMap[doc.nombre_documento]; // Busca el elemento en el mapeo
                            if (targetElement) {
                                // Determina el ícono adicional según el valor de `doc.valido`
                                let validationIcon = '';
                                if (doc.valido == 0) {
                                    validationIcon = `
                                        <a data-bs-dismiss="modal" onclick="ini.inicio.validarDocumento(${doc.id_documento})" style="margin-left: 10px; cursor:pointer;" title="Pendiente de validación">
                                            <i class="mdi mdi-help" style="color: grey; font-size: 1.2rem;"></i>
                                        </a>`;
                                } else if (doc.valido == 1) {
                                    validationIcon = `
                                        <a data-bs-dismiss="modal" onclick="ini.inicio.validarDocumento(${doc.id_documento})" style="margin-left: 10px;" title="Documento válido">
                                            <i class="mdi mdi-check" style="color: green; font-size: 1.2rem;cursor:pointer;"></i>
                                        </a>`;
                                } else if (doc.valido == 2) {
                                    validationIcon = `
                                        <a data-bs-dismiss="modal" onclick="ini.inicio.validarDocumento(${doc.id_documento})" style="margin-left: 10px;" title="Documento inválido">
                                            <i class="mdi mdi-close-thick" style="color: red; font-size: 1.2rem;cursor:pointer;"></i>
                                        </a>`;
                                }
                        
                                // Actualiza el contenido dinámicamente
                                targetElement.innerHTML = `
                                    <a href="${base_url + doc.ruta_relativa}" target="_blank" style="margin-left: 10px;" title="Visualizar PDF">
                                        <i class="mdi mdi-file-pdf" style="${(doc.valido==1)?'color: green;':(doc.valido==2)?'color: red;':'color: grey;'} font-size: 1.2rem;"></i>
                                    </a>
                                    ${validationIcon}
                                `;
                            }
                        });
                        
                    } 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(`Error(s): ${textStatus}`);
                    documentList.innerHTML = '<li class="list-group-item text-danger">Error al cargar los documentos.</li>';
                },
            });
        },
        validarDocumento: function(id_documento){
            var myModal = new bootstrap.Modal(document.getElementById('bs-example-modal-lg'));
            myModal.hide();
            Swal.fire({
                title: "Validación de Documento",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                denyButtonText: `Denegar`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    ini.inicio.cambioEstatusDocumento(1, id_documento);
                  //Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.close(); // Cierra el primer modal
                    ini.inicio.cambioEstatusDocumento(2, id_documento);
               
                }
              });
        },
        archivo: function(value, row)
        {
            let Botones = "<div class='contenedor'>" ;
            Botones += "<a href="+base_url+row.ruta_relativa+" target='_blank' type='button'  title='Aprobado' class='btn btn-info'><i class='mdi mdi-file'></i></a>";
            Botones += "</div>";
        return Botones;
        },
        estatusDocumento: function(value, row)
        {
            let Botones = "<div class='contenedor'>" ;

        switch (row.valido) {
            case '1':
                Botones += "<span title='Aprobado' style='color:green;'>Aprobado</span>";
                break;
            case '2':
                Botones += "<span title='Aprobado' style='color:red;'>Rechazado</span>";
                break;
            case '0':
                Botones += "<span title='Aprobado' style='color:grey;'>Pendiente</span>";
                break;
          
        }
    
        Botones += "</div>";
        return Botones;
        },
        cambioEstatusDocumento: function(id, id_documento)
        {
         if(id == 2){

            Swal.fire({
                title: "<strong>Motivo de la declinación del archivo</strong>",
                icon: "info",
                html: `<textarea id="comentarios" class="form-control" placeholder="Escriba su comentario aquí"></textarea>`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                const comentario = document.getElementById("comentarios").value.trim();       
                if (comentario === "") {
                    Swal.fire("Error", "El comentario no puede estar vacío.", "error");
                    return;
                }
                const data = { id,id_documento, comentario };
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Usuario/guardarComentarioDoc",
                    dataType: "json",
                    data:data,
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            Swal.fire("¡Hecho!", "Se guardo el comentario correctamente.", "success")
                           
                        } else {
                            Swal.fire("Error", "Error al guardar comentario.", "error");
                        }
                        $('#table').bootstrapTable('refresh');
                    },
                    error: function() {
                        Swal.fire("Error", "Error al guardar comentario.", "error")
                    }
                });
            }
               
            });
         }else{
            $.ajax({
                url: base_url + "index.php/Usuario/guardarComentarioDoc",
                type: "post",
                dataType: "json",
                data: {id, id_documento},
                success: function (response) {
                    if (response.error) {
                        Swal.fire("Atención", response.respuesta, "warning");
                        return false;
                    }
                    Swal.fire("Correcto", "Registro exitoso", "success");
                    $('#table').bootstrapTable('refresh');
                       // window.location.href = `${base_url}index.php/Usuario`;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("error(s):" + jqXHR);
                },
            });
         }
       
        },
        estudianteCV: function(value, row) {
            let Botones = "<div class='contenedor'>" +
                "<a href='" + base_url + row.ruta_absoluta + "' target='_blank' type='button' title='Ver' class='btn btn-warning'><i class='mdi mdi-file-pdf'></i></a>" +
  
                "<a onclick='ini.inicio.comentario(" + row.id_archivo_cv + ")' type='button' title='Comentario' class='btn btn-info'><i class='mdi mdi-android-messages'></i></a>";
            // Determinar el botón basado en id_archivo_cv
            switch (row.estatus) {
                case '1':
                    Botones += "<a type='button' onclick='ini.inicio.modalAlta()' title='Aprobado' class='btn btn-success'><i class='mdi mdi-check'></i></a>";
                    break;
                case '2':
                    Botones += "<a type='button' onclick='ini.inicio.modalCerrar()' title='Rechazado' class='btn btn-danger'><i class='mdi mdi-close-thick'></i></a>";
                    break;
                case '0':
                    Botones += "<a type='button' onclick='ini.inicio.estatus("+ row.id_archivo_cv + ")' title='Sin estado' class='btn btn-secondary'><i class='mdi mdi-help'></i></a>";
                    break;
              
            }
          
        
            Botones += "</div>";
            return Botones;
        },
        modalCerrar: function()
        {
            Swal.fire("Atención", "El practicante fue rechazado, favor de revisar los comentarios", "info");
        },
        modalAlta: function()
        {

            var myModal = new bootstrap.Modal(document.getElementById('modalAltaParticipante'));
            myModal.show();

        },
        estatus: function(id_archivo_cv){
            Swal.fire({
                title: "Estatus del estudiante.",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                denyButtonText: `Rechazar`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    ini.inicio.cambioEstatus(1, id_archivo_cv);
                  //Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    ini.inicio.cambioEstatus(2, id_archivo_cv);
                 // Swal.fire("Changes are not saved", "", "info");
                }
              });
        },
        cambioEstatus: function(id, id_archivo_cv)
        {
          $.ajax({
              url: base_url + "index.php/Usuario/cambioEstatus",
              type: "post",
              dataType: "json",
              data: {id, id_archivo_cv},
              success: function (response) {
                  if (response.error) {
                      Swal.fire("Atención", response.respuesta, "warning");
                      return false;
                  }
                  Swal.fire("Correcto", "Registro exitoso", "success");
                  $('#table').bootstrapTable('refresh');
                     // window.location.href = `${base_url}index.php/Usuario`;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  console.log("error(s):" + jqXHR);
              },
          });
        },
        comentario: function(id_archivo_cv) {
            Swal.fire({
                title: "<strong>Agregue un comentario</strong>",
                icon: "info",
                html: `<textarea id="comentarioInput" class="form-control" placeholder="Escriba su comentario aquí"></textarea>`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    const comentario = document.getElementById("comentarioInput").value.trim();       
                    if (comentario === "") {
                        Swal.fire("Error", "El comentario no puede estar vacío.", "error");
                        return;
                    }
                    const data = { id_archivo_cv, comentario };
                    $.ajax({
                        type: "POST",
                        url: base_url + "index.php/Usuario/guardarComentario",
                        dataType: "json",
                        data:data,
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                Swal.fire("Éxito", "Se guardo el comentario correctamente.", "success")
                               
                            } else {
                                Swal.fire("Error", "Error al guardar comentario.", "error");
                            }
                            $('#table').bootstrapTable('refresh');
                        },
                        error: function() {
                            Swal.fire("Error", "Error al guardar comentario.", "error")
                        }
                    });
                }
            });
        },
        
        getUsuario: function(id){
            
            $.ajax({
                type: "POST",
                url: base_url + "index.php/Usuario/getUsuario",
                dataType: "json",
                data:{id_usuario:id},
                success: function(data) {
                    if (data) {
                        console.log(data);
                        
                        $('#staticBackdropLabel').text('Editar Usuario');
                        $('#editar').val('1');
                        $('#id_usuario').val(data.id_usuario);
                        $('#contrasenia').val(data.curp);
                        $('#confir_contrasenia').val(data.curp);
                        $('#nombre').val(data.nombre);
                        $('#curp').val(data.curp);
                        $('#primer_apellido').val(data.primer_apellido);
                        $('#segundo_apellido').val(data.segundo_apellido);
                        $('#id_sexo').val(data.id_sexo).change();
                        $('#id_dependencia').val(data.id_dependencia).change();
                        $('#correo').val(data.correo);
                        $('#id_perfil').val(data.id_perfil);

                    } else {
                        Swal.fire("info", "No se encontraron datos del usuario.", "info");
                    }
                },
                error: function() {
                    Swal.fire("info", "No se encontraron datos del usuario.", "info");
                }
            });
        },
        eliminarPracticante: function(id){
            Swal.fire({
                title: "Se eliminara el registro",
                text: "Esta seguro de eliminar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceder"
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "index.php/Usuario/eliminarPracticante",
                        dataType: "json",
                        data:{id_practicante:id},
                        success: function(data) {
                            if (data) {
                                console.log(data);
                                $('#table').bootstrapTable('refresh');
                                Swal.fire({
                                    title: "Exito",
                                    text: "Se elimino correctamente",
                                    icon: "success"
                                  });
                            } else {
                                Swal.fire("info", "No se encontraron datos del usuario.", "info");
                            }
                        },
                        error: function() {
                            Swal.fire("info", "No se encontraron datos del usuario.", "info");
                        }
                    });
               
                }
              });
 
        },
        deleteUsuario: function(id){
            Swal.fire({
                title: "Se eliminara el registro",
                text: "Esta seguro de eliminar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceder"
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "index.php/Usuario/deleteUsuario",
                        dataType: "json",
                        data:{id_usuario:id},
                        success: function(data) {
                            if (data) {
                                console.log(data);
                                $('#table').bootstrapTable('refresh');
                                Swal.fire({
                                    title: "Exito",
                                    text: "Se elimino correctamente",
                                    icon: "success"
                                  });
                            } else {
                                Swal.fire("info", "No se encontraron datos del usuario.", "info");
                            }
                        },
                        error: function() {
                            Swal.fire("info", "No se encontraron datos del usuario.", "info");
                        }
                    });
               
                }
              });
 
        },
        updateUsuario: function(){
                $('#formUsuario').submit(function(event) {
                    event.preventDefault();

                    var formData = $(this).serialize();
                    console.log(formData);
                    
                    // var params = new URLSearchParams(formData);
                    // var editar = params.get('editar');

                    // console.log('Valor de editar:', editar);
                    //    if( editar===1 ){

                    //    }     
                    $.ajax({
                        url: base_url + "index.php/Usuario/UpdateUsuario",
                        type: "post",
                        dataType: "json",
                        data: formData,
                        beforeSend: function () {
                            // element.disabled = true;
                            $('#btnGuardar').prop('disabled', true);
                        },
                        complete: function () {
                            // element.disabled = false;
                            $('#btnGuardar').prop('disabled', false);
                        },
                        success: function (response, textStatus, jqXHR) {
                            if (response.error) {
                                Swal.fire("Atención", response.respuesta, "warning");
                                return false;
                            }
                            Swal.fire("Correcto", "Registro exitoso", "success");
                                window.location.href = `${base_url}index.php/Usuario`;
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log("error(s):" + jqXHR);
                        },
                    });

                });
        },
      
        limpiaModal:function(){
            $('#formUsuario')[0].reset();
            $('#id_clues').val('').change();
            $('#staticBackdropLabel').text('Agregar Usuario');
            $('#id_usuario').prop('disabled', true);
            $('#editar').prop('disabled', false);
            $('#editar').val(1);
            $("#contrasenia").prop("readonly", false);
        },


        
        
    }
})();