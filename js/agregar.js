var st = window.ssa || {};

st.agregar = (function () {
    return {
        
        agregarTurno: function(){
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
                            Swal.fire("Usuario correcto!", "eso es tokio", "success");
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
        cancelarTurno: function(){
            Swal.fire({
                title: "¿Está seguro de que desea cancelar?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Si",
                
              }).then((result) => {
                if (result.isConfirmed) {
                    $("#formAgregarTurno")[0].reset();
                    window.location.href = base_url + "index.php/Inicio";
                } else if (result.isDenied) {
                  Swal.fire("Ok", "", "info");
                }
              });
               
           
        }
        
    }
})();