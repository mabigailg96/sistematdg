// Declarar variables
var fecha_actual = 0;
var dia_minimo = 0;
var dia_maximo = 0;

$(document).ready(function(){
    //alert($.urlParam("nombre"));
    //alert($(".help-block").html());
    if($.urlParam("save") == 1) {
      Swal.fire(
        'Ciclo:',
        "Registrado con éxito!",
        'success'
      );
    } else if($.urlParam("save") == 0) {
      Swal.fire({
        position: 'top-end',
        type: 'error',
        title: 'Error en los datos ingresados',
        showConfirmButton: false,
        timer: 2000
      });

      var mensaje_error = '';
      mensaje_error = $.urlParam("mensaje");
      $("#mensaje_fecha").html(mensaje_error);
      $("#mensaje_fecha").css("display", "block");
    }

    history.pushState({data:true}, 'Titulo', '/ingresar/ciclo');

    // Colocar rango de fecha minimo y máximo

    fecha_actual = new Date();
    dia_minimo = (fecha_actual.getFullYear()-1) + '-01-01';
    dia_maximo = fecha_actual.getFullYear() + '-12-31';

    $("#fechaInicio").attr("min", dia_minimo);
    $("#fechaInicio").attr("max", dia_maximo);
});

// Función para saber el valor de los parametros get
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
        return null;
    }
    return decodeURI(results[1]) || 0;
}