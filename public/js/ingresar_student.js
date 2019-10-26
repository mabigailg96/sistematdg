/* Funcion de mensaje de carga:
-> primero se verifica que exista un documento cargado en el formulario
despues de verificado despliega el mensaje de carga, mientras se cargan
todos los estudiantes. */
$(document).ready(function() {

    cargarSelectEscuela();

    if ($.urlParam("save") == 1) {
        Swal.fire(
            'Estudiantes:',
            "Registrado con éxito!",
            'success'
        );
    } else if ($.urlParam("save") == 0 || $(".help-block").html() != undefined) {

        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Error en los datos ingresados',
            showConfirmButton: false,
            timer: 2000
        });
    }

    history.pushState({ data: true }, 'Titulo', '/ingresar/estudiantes');

});



/* Funcion que despliega un mensaje de exito
   cuando se cargaron todos los estudiantes
   a la base de datos desde el excel.
 */

// Función para llenar el select con los nombres de escuela
function cargarSelectEscuela() {
    // Función de axios para hacer la consulta
    axios.get('/todos/colleges')
        .then(response => {
            //console.log(response);

            // Llenar el select con los elementos traidos
            response.data.forEach(element => {
                $("#escuela_id").append(new Option(element.escuela, element.id));
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
        })
}

$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    return decodeURI(results[1]) || 0;
}