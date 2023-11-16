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
        }
        
    }
})();