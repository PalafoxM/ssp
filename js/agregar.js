var st = window.ssa || {};

st.agregar = (function () {
    return {
        sha256: function(str) {
            var buffer = new TextEncoder("utf-8").encode(str);
            return crypto.subtle.digest("SHA-256", buffer).then(function(hash) {
                return Array.prototype.map.call(new Uint8Array(hash), function(x) {
                    return ('00' + x.toString(16)).slice(-2);
                }).join('');
            });
        },
        agregarTurno: function(){
            $("#formAgregarTurno").submit(function (e) {
                e.preventDefault(); 
                var formData = $("#formAgregarTurno").serialize();
              
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/Agregar/guardaTurno",
                    data:formData,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if(response.respuesta.error){
                            Swal.fire("error", "Solicite apoyo al area de sistemas");
                        }
                        Swal.fire("success", "Se guardo con Éxito");
                        $("#formAgregarTurno")[0].reset();
                        $('#asunto, #nombre_turno, #cpp, #indicacion, #firma_turno').val(null).trigger('change');
                        var pdfUrl = base_url + "index.php/Inicio/pdfTurno?id_turno=" + response.respuesta.id_turno;
                        var opcionesVentana = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=800';
                        window.open(pdfUrl, '_blank', opcionesVentana);
                        window.location.href = base_url + "index.php/Inicio";
                    },
                    error: function (response,jqXHR, textStatus, errorThrown) {
                         var res= JSON.parse (response.responseText);
                        //  console.log(res.message);
                         Swal.fire("Error", '<p> '+ res.message + '</p>');  
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
        saveTempNombreTurno: function(){
            $('#nombre_turno').on('change', function() {
                // Obtener los valores y textos de las opciones seleccionadas
                var selectedValues = $(this).val();
                var selectedTexts = $('#nombre_turno option:selected').map(function() {
                    return $(this).text();
                }).get();
                updateTable(selectedValues, selectedTexts);
            });

            // Función para actualizar la tabla
            function updateTable(values, texts) {
                // Limpiar la tabla
                $('#selectedValuesNombreTurno tbody').empty();
                $('#selectedValuesNombreTurno1 tbody').empty();

                // Mostrar los valores y textos seleccionados en la tabla
                if (values && values.length > 0) {
                    for (var i = 0; i < values.length; i++) {
                        $('#selectedValuesNombreTurno tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                        $('#selectedValuesNombreTurno1 tbody').append('<tr><td>' + values[i] + '</td><td>' + texts[i] + '</td></tr>');
                    }
                } else {
                    $('#selectedValuesNombreTurno tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
                    $('#selectedValuesNombreTurno1 tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
                }
            }
        },
        saveTempccp: function(){
            
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
                    $('#selectedValuesTable tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
                    $('#selectedValuesTable1 tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
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
                    $('#selectedValuesIndicacion tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
                    $('#selectedValuesIndicacion1 tbody').append('<tr><td colspan="2">No hay elementos seleccionados</td></tr>');
                }
            }
        },
        validarEntrada:function(input) {
            var resumen = input.val();
            var regex = /^[a-zA-Z0-9\s.,!?()-]+$/;
            $pattern = "/^([a-zA-ZáéíóúüñÁÉÍÓÚÜÑ 0-9]+)$/";
            if (resumen.length > 0 && resumen.length <= 600 && regex.test(resumen)) {
              input.removeClass("invalid-input");
              return true;  
            } else {
              input.addClass("invalid-input");
              return false;
              
            }
          },
          // convioerte todo los de los inputs a mayusculas
          toUpperCase:function(element){
            element.value = element.value.toUpperCase();
        }
        
    }
})();