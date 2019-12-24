var id_docente;
$(document).ready(function(){


    validacionesIniciales();

});

/*
    Inicio para docente director
*/
// Función para que al escribir en input se autocomplete
$("#txt-buscar-docente_director").autocomplete({
    source: function(request, respond) {
        var params = {
            input: $('#txt-buscar-docente_director').val(),
            escuela_id: $('#escuela-id').html()
        };

        var lista = [];
        //console.log(params);

        axios.get("/todos/profesores/asignaciones", {

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

// Al hacer click en el botón agregar docente director se agrega al resumen de la parte inferior y se bloquea input
$(document).on("click", "#btn-agregar-docente_director", function(){
    var valor_recoger = $("#txt-buscar-docente_director").val();
    var codigo_subcadena = valor_recoger.split(',');

    if (valor_recoger != "" && codigo_subcadena[0].length > 1) {
        var params = {
            input: codigo_subcadena[0],
            escuela_id: $('#escuela-id').html()
        };

        //console.log(params);

        axios.get("/todos/profesores/asignaciones", {

            params: params

        }).then(response => {

            //console.log(response.data);
            if (response.data.length == 1) {

                var es_asesor_interno = false;
                for (var i = 0; i < $(".lbl-asesor_interno").toArray().length; i++){
                    if ($(".lbl-asesor_interno:eq("+i+")").attr("value") == response.data[0].id) {
                        es_asesor_interno = true;
                    }
                }

                if (!es_asesor_interno) {
                    $("#txt-buscar-docente_director").attr("disabled", true); 
                    $(this).attr("disabled", true); 
                    var concatenar = response.data[0].codigo+', '+response.data[0].nombre+' '+response.data[0].apellido;
                    $("#txt-buscar-docente_director").val(concatenar); 
                    $("#lbl-docente_director").html('<br>• '+concatenar+` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="btn-quitar-docente_director" class="close float-none"><span class="oi oi-circle-x" title="Quitar docente director" aria-hidden="true" style="color:red"></span></button>`);
                    $("#lbl-docente_director").attr("value", response.data[0].id);
                } else {
                    $("#txt-buscar-docente_director").val(""); 
                    // Mensaje de error en caso de que sea el mismo registro que el docente director
                    Swal.fire({
                        type: 'error',
                        title: '¡Alto!',
                        text: 'El docente director no puede ser también el asesor interno.',
                    });
                }
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'No se ha podido tomar el docente, por favor verifique datos.',
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
});

// Función para que regresé a seleccionar el docente director al quitarlo del resumen
$(document).on("click", "#btn-quitar-docente_director", function(){
    $("#txt-buscar-docente_director").attr("disabled", false); 
    $("#btn-agregar-docente_director").attr("disabled", false); 
    $("#txt-buscar-docente_director").val(""); 
    $("#lbl-docente_director").html("");
    $("#lbl-docente_director").attr("value", "");
});

/*
    Para estudiantes
*/

// Función para que al escribir en input se autocomplete
$("#txt-buscar-estudiante").autocomplete({
    source: function(request, respond) {
        var params = {
            input: $('#txt-buscar-estudiante').val(),
            escuela_id: $('#escuela-id').html()
        };

        var lista = [];
        //console.log(params);

        axios.get("/todos/estudiantes/asignaciones", {

            params: params

        }).then(response => {

            //console.log(response.data);
            response.data.forEach(element => {
                lista.push(element.carnet+', '+element.nombres+' '+element.apellidos);
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


// Al hacer click en el botón agregar integrante se agrega al resumen de la parte inferior y se bloquea input al llegar al limite
$(document).on("click", "#btn-agregar-estudiante", function(){
    if ($(".lbl-estudiante").toArray().length <= 4) {
        var valor_recoger = $("#txt-buscar-estudiante").val();
        var codigo_subcadena = valor_recoger.split(',');
    
        if (valor_recoger != "" && codigo_subcadena[0].length > 1) {
            var params = {
                input: codigo_subcadena[0],
                escuela_id: $('#escuela-id').html()
            };
    
            //console.log(params);
    
            axios.get("/todos/estudiantes/asignaciones", {
    
                params: params
    
            }).then(response => {
    
                //console.log(response.data);
                if (response.data.length == 1) {
                    var ya_seleccionado = false;
                    for (var i = 0; i < $(".lbl-estudiante").toArray().length; i++){
                        if ($(".lbl-estudiante:eq("+i+")").attr("value") == response.data[0].id) {
                            ya_seleccionado = true;
                        }
                    }

                    if (!ya_seleccionado) {
                        if ($(".lbl-estudiante").toArray().length == 4) {
                            $("#txt-buscar-estudiante").attr("disabled", true);
                            $(this).attr("disabled", true);

                            Swal.fire({
                                type: 'info',
                                title: 'Información:',
                                text: 'Haz llegado al número máximo (5) de integrantes.',
                            });
                        } else {
                            $("#txt-buscar-estudiante").attr("disabled", false);
                            $(this).attr("disabled", false); 
                        }
                        var concatenar = response.data[0].carnet+', '+response.data[0].nombres+' '+response.data[0].apellidos;

                        $("#lbl-estudiantes").html($("#lbl-estudiantes").html()+`<p class="lbl-estudiante" value="${response.data[0].id}">• `+concatenar+` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" value="${response.data[0].id}" class="close float-none btn-quitar-estudiante"><span class="oi oi-circle-x" title="Quitar integrante" aria-hidden="true" style="color:red"></span></button></p>`);
                    } else {
                        Swal.fire({
                            // Mensaje para indicar de que ya se ha agregado este interno
                            type: 'error',
                            title: '¡Alto!',
                            text: 'Ya se ha seleccionado este estudiante.',
                        });
                    }

                } else {
                    // Mensaje de error en caso de que no se hayan seleccionado bien los datos
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'No se ha podido agregar el integrante, por favor verifique datos.',
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
        $("#txt-buscar-estudiante").attr("disabled", false); 
        $("#btn-agregar-estudiante").attr("disabled", false); 
        // Mensaje de error para decir que ya no puede agregar más de integrantes
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: 'Ya haz llegado al límite legal máximo de 5 integrantes.',
        });
    }

    $("#txt-buscar-estudiante").val("");
});

// Función para que regresé a seleccionar el estudiante al quitarlo del resumen
$(document).on("click", ".btn-quitar-estudiante", function(){
    $("#txt-buscar-estudiante").attr("disabled", false); 
    $("#btn-agregar-estudiante").attr("disabled", false); 
    $("#txt-buscar-estudiante").val(""); 
    $(this).parent(".lbl-estudiante").remove();
});

/*
    Inicio para asesor interno
*/
// Función para que al escribir en input se autocomplete
$("#txt-buscar-asesor_interno").autocomplete({
    source: function(request, respond) {
        var params = {
            input: $('#txt-buscar-asesor_interno').val(),
            escuela_id: $('#escuela-id').html()
        };

        var lista = [];
        //console.log(params);

        axios.get("/todos/profesores/asignaciones", {

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

// Al hacer click en el botón agregar asesor interno se agrega al resumen de la parte inferior y se bloquea input al llegar al limite
$(document).on("click", "#btn-agregar-asesor_interno", function(){
    if ($(".lbl-asesor_interno").toArray().length <= 6) {
        var valor_recoger = $("#txt-buscar-asesor_interno").val();
        var codigo_subcadena = valor_recoger.split(',');
    
        if (valor_recoger != "" && codigo_subcadena[0].length > 1) {
            var params = {
                input: codigo_subcadena[0],
                escuela_id: $('#escuela-id').html()
            };
    
            //console.log(params);
    
            axios.get("/todos/profesores/asignaciones", {
    
                params: params
    
            }).then(response => {
    
                //console.log(response.data);
                if (response.data.length == 1) {
                    if (response.data[0].id != $("#lbl-docente_director").attr("value")) {

                        var ya_seleccionado = false;
                        for (var i = 0; i < $(".lbl-asesor_interno").toArray().length; i++){
                            if ($(".lbl-asesor_interno:eq("+i+")").attr("value") == response.data[0].id) {
                                ya_seleccionado = true;
                            }
                        }
    
                        if (!ya_seleccionado) {
                            if ($(".lbl-asesor_interno").toArray().length == 6) {
                                $("#txt-buscar-asesor_interno").attr("disabled", true);
                                $(this).attr("disabled", true);
    
                                Swal.fire({
                                    type: 'info',
                                    title: 'Información:',
                                    text: 'Haz llegado al número máximo (7) de asesores internos.',
                                });
                            } else {
                                $("#txt-buscar-asesor_interno").attr("disabled", false);
                                $(this).attr("disabled", false); 
                            }
                            var concatenar = response.data[0].codigo+', '+response.data[0].nombre+' '+response.data[0].apellido;
                            $("#lbl-asesores_internos").html($("#lbl-asesores_internos").html()+`<p class="lbl-asesor_interno" value="${response.data[0].id}">• `+concatenar+` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" value="${response.data[0].id}" class="close float-none btn-quitar-asesor_interno"><span class="oi oi-circle-x" title="Quitar asesor interno" aria-hidden="true" style="color:red"></span></button></p>`);
                        } else {
                            // Mensaje para indicar de que ya se ha agregado este asesor interno
                            Swal.fire({
                                type: 'error',
                                title: '¡Alto!',
                                text: 'Ya se ha seleccionado este asesor interno.',
                            });
                        }

                    } else {
                        // Mensaje de error en caso de que sea el mismo registro que el docente director
                        Swal.fire({
                            type: 'error',
                            title: '¡Alto!',
                            text: 'El asesor interno no puede ser el mismo que el docente director.',
                        });
                    }

                } else {
                    // Mensaje de error en caso de que no se hayan seleccionado bien los datos
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'No se ha podido agregar el asesor interno, por favor verifique datos.',
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

    $("#txt-buscar-asesor_interno").val("");
});

// Función para que regresé a seleccionar el asesor interno al quitarlo del resumen
$(document).on("click", ".btn-quitar-asesor_interno", function(){
    $("#txt-buscar-asesor_interno").attr("disabled", false); 
    $("#btn-agregar-asesor_interno").attr("disabled", false); 
    $("#txt-buscar-asesor_interno").val(""); 
    $(this).parent(".lbl-asesor_interno").remove();
});

/*
    Inicio para asesor externo
*/

// Función para tomar el valor de los dosinput de nombre y apellido y agregarlo a la parte inferior del resumen
$(document).on("click", "#btn-agregar-asesor_externo", function() {
    // Variables para recoger el valor de los input nombre y apellido de asesor externo
    var nombre_asesor_externo = $("#txt-nombre-asesor_externo");
    var apellido_asesor_externo = $("#txt-apellido-asesor_externo");

    var es_valido = true;

    if (nombre_asesor_externo.val() == "") {
        nombre_asesor_externo.addClass("is-invalid");
        es_valido = false;
    } else {
        nombre_asesor_externo.removeClass("is-invalid");
    }

    if (apellido_asesor_externo.val() == "") {
        apellido_asesor_externo.addClass("is-invalid");
        es_valido = false;
    } else {
        apellido_asesor_externo.removeClass("is-invalid");
    }

    if (es_valido) {

        if ($(".lbl-asesor_externo").toArray().length == 6) {
            nombre_asesor_externo.attr("disabled", true);
            apellido_asesor_externo.attr("disabled", true);
            $(this).attr("disabled", true);

            Swal.fire({
                type: 'info',
                title: 'Información:',
                text: 'Haz llegado al número máximo (7) de asesores externos.',
            });
        } else {
            nombre_asesor_externo.attr("disabled", false);
            apellido_asesor_externo.attr("disabled", false);
            $(this).attr("disabled", false); 
        }
        $("#lbl-asesores_externos").html($("#lbl-asesores_externos").html()+`<p class="lbl-asesor_externo">• <span class="nombre">${nombre_asesor_externo.val()}</span>&nbsp;<span class="apellido">${apellido_asesor_externo.val()}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="close float-none btn-quitar-asesor_externo"><span class="oi oi-circle-x" title="Quitar asesor externo" aria-hidden="true" style="color:red"></span></button></p>`);
        nombre_asesor_externo.val("");
        nombre_asesor_externo.removeClass("is-invalid");
        apellido_asesor_externo.val("");
        apellido_asesor_externo.removeClass("is-invalid");
    } else {
        // Mensaje para indicar que faltan llenar input para poder agregar asesor externo
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: 'Hacen falta llenar datos para registrar el asesor externo.',
        });
    }
});

// Función para que regresé a seleccionar el asesor externo al quitarlo del resumen
$(document).on("click", ".btn-quitar-asesor_externo", function(){
    $("#txt-nombre-asesor_externo").attr("disabled", false); 
    $("#txt-apellido-asesor_externo").attr("disabled", false); 
    $("#btn-agregar-asesor_externo").attr("disabled", false); 
    $(this).parent(".lbl-asesor_externo").remove();
});

/*
    Botones para guardar el grupo de TDG y de cancelar asignación
*/

$(document).on("click", "#btn-guardar-asignacion", function() {
    // Inicializar variables
    var tdg_id = $("#tdg-id").html();
    var ciclo_id = $("#ciclo_id").html();
    var profesor_id = $("#lbl-docente_director").attr("value");
    var estudiantes = $("#lbl-estudiantes").html();
    var asesores_internos = $("#lbl-asesores_internos").html();
    var asesores_externos = $("#lbl-asesores_externos").html();

    var mensaje_error = "";
    if (profesor_id == "") {
        mensaje_error += `Necesita seleccionar el docente director.\n`;
    }

    if (estudiantes == "") {
        mensaje_error += `Necesita seleccionar al menos un estudiante.\n`;
    }

    // En caso de que no haya ningún error se registra todo
    if (mensaje_error == "") {
        
        /*
            agrupar id de studiantes a eliminar en un arreglo
        */
        var students_delete_array = new Array();

        for (var i = 0; i < $(".id_estudiante").toArray().length; i++){
            var coincidencia = false;

            for (var x = 0; x < $(".lbl-estudiante").toArray().length; x++){

                if ($(".id_estudiante:eq("+i+")").html() == $(".lbl-estudiante:eq("+x+")").attr("value")){
                    coincidencia = true;
                }
            }

            if (!coincidencia) {
                students_delete_array.push($(".id_estudiante:eq("+i+")").html());
            }
        }

        //console.log(students_delete_array);

        /*
            agrupar id de studiantes que son nuevos en un arreglo
        */

        var students_new_array = new Array();

        for (var x = 0; x < $(".lbl-estudiante").toArray().length; x++){
            var coincidencia = false;

            for (var i = 0; i < $(".id_estudiante").toArray().length; i++){
            
                if ($(".lbl-estudiante:eq("+x+")").attr("value") == $(".id_estudiante:eq("+i+")").html()){
                    coincidencia = true;
                }
            }

            if (!coincidencia) {
                students_new_array.push($(".lbl-estudiante:eq("+x+")").attr("value"));
            }

        }
        
        //console.log(students_new_array);

        /*
            agrupar id de asesor interno a eliminar en un arreglo
        */
       var adviser_internal_delete_array = new Array();

       for (var i = 0; i < $(".id_asesor_interno").toArray().length; i++){
           var coincidencia = false;

           for (var x = 0; x < $(".lbl-asesor_interno").toArray().length; x++){

               if ($(".id_asesor_interno:eq("+i+")").html() == $(".lbl-asesor_interno:eq("+x+")").attr("value")){
                   coincidencia = true;
               }
           }

           if (!coincidencia) {
            adviser_internal_delete_array.push($(".id_asesor_interno:eq("+i+")").html());
           }
       }

       //console.log(adviser_internal_delete_array);

       /*
           agrupar id de studiantes que son nuevos en un arreglo
       */

       var adviser_internal_new_array = new Array();

       for (var x = 0; x < $(".lbl-asesor_interno").toArray().length; x++){
           var coincidencia = false;

           for (var i = 0; i < $(".id_asesor_interno").toArray().length; i++){
           
               if ($(".lbl-asesor_interno:eq("+x+")").attr("value") == $(".id_asesor_interno:eq("+i+")").html()){
                   coincidencia = true;
               }
           }

           if (!coincidencia) {
                adviser_internal_new_array.push($(".lbl-asesor_interno:eq("+x+")").attr("value"));
           }
       }
       
       //console.log(adviser_internal_new_array);

        /*
            agrupar id de asesores internos a eliminar y los nuevos asesores en un arreglo
        */

        var adviser_external_delete_array = new Array();
        var adviser_external_new_array = new Array();

        for (var i = 0; i < $(".lbl-asesor_externo").toArray().length; i++){

            //console.log( $(".lbl-asesor_externo:eq("+i+")").attr("value") );

            if ( $(".lbl-asesor_externo:eq("+i+")").attr("value") == undefined ) {

                var adviser_external = new Array();
                adviser_external.push($(".lbl-asesor_externo:eq("+i+")").children(".nombre").html()),
                adviser_external.push($(".lbl-asesor_externo:eq("+i+")").children(".apellido").html()),
                adviser_external_new_array.push(JSON.stringify(adviser_external));

            } else {
                var coincidencia = false;

                for (var x = 0; x < $(".lbl-asesor_externo").toArray().length; x++){

                    if ($(".id_asesor_externo:eq("+i+")").html() == $(".lbl-asesor_externo:eq("+x+")").attr("value")){
                        coincidencia = true;
                    }
                }

                if (!coincidencia) {
                    adviser_external_delete_array.push($(".id_asesor_externo:eq("+i+")").html());
                }
            }
        }

        //console.log(adviser_external_delete_array);
        //console.log(adviser_external_new_array);

        var params = {
            tdg_id: tdg_id,
            ciclo_id: ciclo_id,
            professor_id: profesor_id,
            students_delete: JSON.stringify(students_delete_array),
            students_news: JSON.stringify(students_new_array),
            advisers_internal_delete: JSON.stringify(adviser_internal_delete_array),
            advisers_internal_news: JSON.stringify(adviser_internal_new_array),
            advisers_external_delete: JSON.stringify(adviser_external_delete_array),
            advisers_external_news: JSON.stringify(adviser_external_new_array),
        };

        console.log(params);

        axios.get("/update/tdg/asignacion", {

            params: params

        }).then(response => {

            console.log(response);

            // Mostrar mensaje de éxito de que todo ha sido registrado
            Swal.fire({
                type: 'success',
                title: 'Edición:',
                text: 'Relizada con éxito!:',
            })
            .then(function(){
                window.location.href = "/listar/tdg/editar";
            });

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

    } else {
        // Mensaje para indicar que faltan selecionar docente u integrantes
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: `Hacen falta llenar datos para guardar las asignaciones.\n`+mensaje_error,
        });
    }
});

// Funcion que cancela la asignacion y retorna a la lista de TDGs
$(document).on("click", "#btn-cancelar-asignacion", function() {
    window.location.href = "/listar/tdg/editar";
});

// Función para validar los campos de ingresar
function validacionesIniciales() {
    
    // Bloquear input text para docente director

    $("#txt-buscar-docente_director").attr("disabled", true); 
    $(this).attr("disabled", true); 
    var concatenar = $("#lbl-docente_director_concatenar").html();
    $("#txt-buscar-docente_director").val(concatenar); 

    // Validar cantidad de estudiantes

    if ($("#estudiantes_length").html() >= 5) {
        $("#txt-buscar-estudiante").attr("disabled", true); 
        $("#btn-agregar-estudiante").attr("disabled", true); 
    }

    // Validar cantidad de asesores internos

    if ($("#asesores_internos_length").html() >= 7) {
        $("#txt-buscar-asesor_interno").attr("disabled", true);
        $("#btn-agregar-asesor_interno").attr("disabled", true);
    }

    // Validar cantidad de asesores externos

    if ($("#asesores_externos_length").html() >= 6) {
        $("#txt-nombre-asesor_externo").attr("disabled", true);
        $("#txt-apellido-asesor_externo").attr("disabled", true);
    }
}