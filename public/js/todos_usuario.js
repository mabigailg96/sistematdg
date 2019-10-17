$(document).ready(function() {

    if ($.urlParam("save") == 1) {
        Swal.fire(
            'Usuario:',
            "Registrado con éxito!",
            'success'
        );
    } else if ($.urlParam("save") == 2) {

        Swal.fire(
            'Usuario:',
            "Modificado con éxito!",
            'success'
        );
    }

    history.pushState({ data: true }, 'Titulo', '/todos/usuarios/sistema');
});

$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    return decodeURI(results[1]) || 0;
}