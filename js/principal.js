var saeg = window.ssa || {};

saeg.principal = (function () {
    return {
        cargar_documento: function () {
            $("#frmDocumento").submit(function (event) {
                //disable the default form submission                
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: base_url + '/index.php/Principal/SubiendoDocumento',
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    //data: $("#frmAsuntoEntradaNuevo").serialize(),
                    success: function (response, textStatus, jqXHR) {
                        //console.log(response);
                        if(response == 'correcto'){
                            Swal.fire("", "Se agregó correctamente el logotipo", "success");
                            location.reload();
                        }else{
                            Swal.fire("Error", response, "warning");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error');
                        console.log('error:' + textStatus, errorThrown);
                    }
                });
                event.preventDefault();
                event.stopImmediatePropagation();
            });
        },
        login: function(){
            $("#login").submit(function (e) {
                e.preventDefault();                
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Login/validar_usuario",
                    data: $(this).serialize(),
                    dataType: "html",
                    success: function (response) {
                        console.log(response);
                        if(response == 'correcto'){
                            Swal.fire("Bienvenido!", "ingresando...", "success");
                            window.location.href = base_url + "index.php/Inicio";                           
                        }else{
                            Swal.fire("Usuario incorrecto!", "Favor de verificar sus credenciales de acceso", "error");                            
                            return false;
                        } 
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire("Error!", textStatus, errorThrown, "error");  
                        console.log('error:' + textStatus, errorThrown);
                    }
                });
            });
        },
        formParticipante: function(){
            $("#formParticipante").submit(function (e) {
                e.preventDefault();         
                $('#btn_guardar').hide();      
                $('#btn_load').show();      
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Principal/guardarParticipantes",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.error == false){
                            Swal.fire("Éxito", response.respuesta, "success");
                            window.location.href = base_url + "index.php/Inicio"               
                        }else{
                            Swal.fire("Error", response.respuesta , "error"); 
                            $('#btn_guardar').show();      
                            $('#btn_load').hide();  
                        } 
                    
                    },
                    error: function (response,jqXHR, textStatus, errorThrown) {
                        var res= JSON.parse (response.responseText);
                       //  console.log(res.message);
                        Swal.fire("Error", '<p> '+ res.message + '</p>');  
                   }
                });
            });
        },
        cargaMasiva: function(){
      
            Swal.fire({
                title: "<strong>Subir Archivo CSV</strong>",
                icon: "info",
                html: ` <input type='file' id="reporte" class="form-control" accept=".csv">`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    let fileInput = $('#reporte')[0].files[0];

                    if (!fileInput) {
                        Swal.fire("Error", "Es requerido el archivo CSV", "error");
                        return;
                    }
        
                    Swal.fire({
                        title: "Atención",
                        text: "Se cargará masivamente, ¿Desea proceder?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Proceder"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#btn_caragMasiva").hide();
                            $("#btn_load").show();
                            let formData = new FormData();
                            formData.append('file', fileInput);
                            $.ajax({
                                url: base_url + "index.php/Usuario/subirReporte",
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log(response);
                                    if (!response.error) {
                                        Swal.fire("Éxito", response.respuesta, "success");
                                        $('#tableProyectos').bootstrapTable('refresh');
                                    } else {
                                        Swal.fire("Error", response.respuesta, "error");
                                        console.log("Error: " + response.error);
                                    }
                                },
                                complete: function(){
                                    $("#btn_caragMasiva").show();
                                    $("#btn_load").hide();
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
        formPracticante: function(){
            $("#formParticipante").submit(function (e) {
                e.preventDefault();         
                $('#btn_guardar').hide();      
                $('#btn_load').show();      
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Principal/guardarPracticante",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.error == false){
                            Swal.fire("Éxito", response.respuesta, "success");
                            window.location.href = base_url + "index.php/Inicio/practicantes"
                            
                        }else{
                            Swal.fire("Error", response.respuesta , "error"); 
                        } 
                        $('#btn_guardar').show();      
                        $('#btn_load').hide();  
                    },
                    error: function (response,jqXHR, textStatus, errorThrown) {
                        var res= JSON.parse (response.responseText);
                       //  console.log(res.message);
                        Swal.fire("Error", '<p> '+ res.message + '</p>');  
                   }
                });
            });
        },
        formCargaParticipante: function(){
            $("#formCargaParticipante").submit(function (e) {
                e.preventDefault();         
                $('#btn_guardar').hide();      
                $('#btn_load').show();  
                let formData = new FormData(this); 
                console.log(formData);   
 
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Principal/guardarCargaParticipante",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                               // Mostrar los mensajes de éxito o error
                    if (response.error) {
                        Swal.fire("Error", response.message, "error");
                    } else {
                        Swal.fire("Éxito", response.message, "success");
                        $("#formCargaParticipante")[0].reset(); // Limpia el formulario
                         window.location.href = base_url + "index.php/Inicio/listaDocumento"
                    }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error:", textStatus, errorThrown);
                        Swal.fire("Error", "Ocurrió un problema al guardar los datos.", "error");
                    },
                    complete: function () {
                        // Restaurar el botón de guardar
                        $("#btn_guardar").show();
                        $("#btn_load").hide();
                    },
                });
            });
        },
        
    }
})();