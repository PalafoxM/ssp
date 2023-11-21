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
               
           
        },
        saveTempccp: function(){
            // $('#cpp').on('change', function() {
            //     // Obtener los valores seleccionados
            //     var selectedValues = $(this).val();

            //     // Limpiar la tabla
            //     $('#selectedValuesTable tbody').empty();

            //     // Mostrar los valores seleccionados en la tabla
            //     if (selectedValues && selectedValues.length > 0) {
            //         selectedValues.forEach(function(value) {
            //             $('#selectedValuesTable tbody').append('<tr><td>' + value + '</td></tr>');
            //         });
            //     } else {
            //         $('#selectedValuesTable tbody').append('<tr><td>No values selected</td></tr>');
            //     }
            // });
            $('#cpp').on('change', function() {
                // Obtener los valores y textos de las opciones seleccionadas
                var selectedValues = $(this).val();
                var selectedTexts = $('#cpp option:selected').map(function() {
                    return $(this).text();
                }).get();

                // Actualizar la tabla
                updateTable(selectedValues, selectedTexts);
            });

            // Función para actualizar la tabla
            function updateTable(values, texts) {
                // Limpiar la tabla
                $('#selectedValuesTable tbody').empty();
                $('#selectedValuesTable1 tbody').empty();

                // Mostrar los valores y textos seleccionados en la tabla
                if (values && values.length > 0) {
                    for (var i = 0; i < values.length; i++) {
                        $('#selectedValuesTable tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                        $('#selectedValuesTable1 tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                    }
                } else {
                    $('#selectedValuesTable tbody').append('<tr><td colspan="2">No values selected</td></tr>');
                    $('#selectedValuesTable1 tbody').append('<tr><td colspan="2">No values selected</td></tr>');
                }
            }
        },
        saveTempIndicacion: function(){
            $('#indicacion').on('change', function() {
                // Obtener los valores y textos de las opciones seleccionadas
                var selectedValues = $(this).val();
                var selectedTexts = $('#indicacion option:selected').map(function() {
                    return $(this).text();
                }).get();
                updateTable(selectedValues, selectedTexts);
            });

            // Función para actualizar la tabla
            function updateTable(values, texts) {
                // Limpiar la tabla
                $('#selectedValuesIndicacion tbody').empty();
                $('#selectedValuesIndicacion1 tbody').empty();

                // Mostrar los valores y textos seleccionados en la tabla
                if (values && values.length > 0) {
                    for (var i = 0; i < values.length; i++) {
                        $('#selectedValuesIndicacion tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                        $('#selectedValuesIndicacion1 tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                    }
                } else {
                    $('#selectedValuesIndicacion tbody').append('<tr><td colspan="2">No values selected</td></tr>');
                    $('#selectedValuesIndicacion1 tbody').append('<tr><td colspan="2">No values selected</td></tr>');
                }
            }
        }
        
    }
})();