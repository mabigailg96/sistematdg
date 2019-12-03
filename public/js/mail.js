$(document).ready(function() {



    if ($.urlParam("save") == 1) {
        Swal.fire(
            'Correo:',
            "El mensaje ha sido enviado con exito",
            'success'
        );
    } else if ($.urlParam("save") == 0 || $(".help-block").html() != undefined) {

        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Error al enviar correo no hay conexion ',
            showConfirmButton: false,
            timer: 2000
        });
    }

    history.pushState({ data: true }, 'Titulo', '/correo/crear');

});

$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    return decodeURI(results[1]) || 0;
}
