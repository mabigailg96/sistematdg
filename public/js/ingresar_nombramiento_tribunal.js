// Función al cargar la página
$(document).ready(function() {
    
});

// Función para autocomplementar el input docente
$("#txt-buscar-docente").autocomplete({
    source: function(request, respond) {
        var params = {
            input: $('#txt-buscar-docente').val()
        };

        var lista = [];
        //console.log(params);

        axios.get("/todos/profesores/nombramiento/tribunal", {

            params: params

        }).then(response => {

            //console.log(response.data);
            response.data.forEach(element => {
                lista.push(element.codigo+', '+element.nombre+' '+element.apellido);
            });

            respond(lista);

        }).catch(e => {
            // Imprimir error en consola
            console.log(e);
    
            // Mostrar mensaje de error en caso de que algo haya salido mal con la consulta
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '¡Algo ha salido mal!, por favor intente más tarde.',
            });
        });
    },
});

// Función para agregar docente a la lista del tribunal
$(document).on("click", "#btn-agregar-docente", function(){
    if ($("#lista-tribunal").children(".list-group-item").toArray().length <= 2) {
        var valor_recoger = $("#txt-buscar-docente").val();
        var codigo_subcadena = valor_recoger.split(',');
    
        if (valor_recoger != "" && codigo_subcadena[0].length > 1) {
            var params = {
                input: codigo_subcadena[0]
            };
    
            //console.log(params);
    
            axios.get("/todos/profesores/nombramiento/tribunal", {
    
                params: params
    
            }).then(response => {
    
                //console.log(response.data);
                if (response.data.length == 1) {

                    var ya_seleccionado = false;

                    for (var i = 0; i < $("#lista-tribunal").children(".list-group-item").toArray().length; i++){
                        if (response.data[0].id == $("#lista-tribunal").children(".list-group-item:eq("+i+")").attr("value")) {
                            ya_seleccionado = true;
                        }
                        //console.log($("#lista-tribunal").children(".list-group-item:eq("+i+")").html());
                    }

                    if (!ya_seleccionado) {

                        if ($("#lista-tribunal").children(".list-group-item").toArray().length == 2) {
                            $("#txt-buscar-docente").attr("disabled", true);
                            $(this).attr("disabled", true);

                            Swal.fire({
                                type: 'info',
                                title: 'Información:',
                                text: 'Haz seleccionados todos los integrantes del tribunal calificador.',
                            });
                        } else {
                            $("#txt-buscar-docente").attr("disabled", false);
                            $(this).attr("disabled", false); 
                        }
                        var concatenar = response.data[0].codigo+', '+response.data[0].nombre+' '+response.data[0].apellido;
                        $("#lista-tribunal").append(`<li class="list-group-item" value="${response.data[0].id}">`+concatenar+` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" value="${response.data[0].id}" class="close float-none btn-quitar-docente"><span class="oi oi-circle-x" title="Quitar docente director" aria-hidden="true" style="color:red"></span></button></li>`);

                    } else {
                        // Mensaje de error en caso de que sea el mismo registro que los se encuentran en lista de tribunal
                        Swal.fire({
                            type: 'error',
                            title: '¡Alto!',
                            text: 'No se puede seleccionar el docente más de una vez.',
                        });
                    }

                } else {
                    // Mensaje de error en caso de que no se hayan seleccionado bien los datos
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'No se ha podido agregar el docente, por favor verifique datos.',
                    });
                }
    
            }).catch(e => {
                // Imprimir error en consola
                console.log(e);
        
                // Mostrar mensaje de error en caso de que algo haya salido mal con la consulta
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: '¡Algo ha salido mal!, por favor intente más tarde.',
                });
            });
        }
    } else {
        $("#txt-buscar-asesor_interno").attr("disabled", false); 
        $("#btn-agregar-asesor_interno").attr("disabled", false);

        // Mensaje de error para decir que ya no puede agregar más de 
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: 'Ya haz llegado al límite de máximo 7 asesores internos.',
        });
    }

    $("#txt-buscar-docente").val("");
});

// Función para que regresé a seleccionar el docente al quitarlo de la lista de tribunal
$(document).on("click", ".btn-quitar-docente", function() {
    $("#txt-buscar-docente").attr("disabled", false); 
    $("#btn-agregar-docente").attr("disabled", false); 
    $("#txt-buscar-docente").val(""); 
    $(this).parent(".list-group-item").remove();
});

$(document).on("click", "#btn-guardar", function() {
    if ($("#lista-tribunal").children(".list-group-item").toArray().length == 3) {

        var params = {
            tdg_id: $("#tdg-id").html(),
        };

        console.log(params);

        axios.get("/guardar/solicitud/tribunal", {
                
            params: params

        }).then(response => {

            // Ajax anadidado para recuperar el valor del id
            console.log(response.data.id);

            for (var i = 0; i < $("#lista-tribunal").children(".list-group-item").toArray().length; i++){

                var params = {
                    professor_id: $("#lista-tribunal").children(".list-group-item:eq("+i+")").attr("value"),
                    request_tribunal_id: response.data.id,
                };
    
                axios.get("/guardar/tribunal/profesor", {
            
                    params: params
    
                }).then(respuesta => {
    
                    //console.log(respuesta);
    
                }).catch(ex => {
                    // Imprimir error en consola
                    console.log(ex);
    
                    // Mostrar mensaje de error en caso de que algo haya salido mal con la consulta
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: '¡Algo ha salido mal!, por favor intente más tarde.',
                    });
                });

                /*if (response.data[0].id == $("#lista-tribunal").children(".list-group-item:eq("+i+")").attr("value")) {
                    ya_seleccionado = true;
                }*/
                //console.log($("#lista-tribunal").children(".list-group-item:eq("+i+")").html());
            }

            Swal.fire({
                type: 'success',
                title: 'Asignación:',
                text: 'Registrado con éxito!:',
                showConfirmButton: false,
                timer: 3000
            });

            window.location.href = "/listar/tdg/solicitudes";

        }).catch(e => {
            // Imprimir error en consola
            console.log(e);

            // Mostrar mensaje de error en caso de que algo haya salido mal con la consulta
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '¡Algo ha salido mal!, por favor intente más tarde.',
            });
        });

        /*for (var i = 0; i < $("#lista-tribunal").children(".list-group-item").toArray().length; i++){
            if (response.data[0].id == $("#lista-tribunal").children(".list-group-item:eq("+i+")").attr("value")) {
                ya_seleccionado = true;
            }
            //console.log($("#lista-tribunal").children(".list-group-item:eq("+i+")").html());
        }*/

    } else {
        // Mostrar mensaje de error en caso de que no se hayan seleccionado los 3 integrantes
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: '¡Algo ha salido mal!, por favor intente más tarde.',
        });
    }
});