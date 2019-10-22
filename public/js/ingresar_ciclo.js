// Declarar variables
var fecha_actual = 0;
var dia_minimo = 0;
var dia_maximo = 0;
var lenguaje_datatable;

$(document).ready(function(){

    // Variable del idioma para la datatable
    lenguaje_datatable = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };


    $("#table-semesters").DataTable({
        "destroy": true,
        "processing": true,
        "ordering": false,
        "pageLength": 10,
        "paging": false,
        "info": false,
        "searching": false,
        "ordering": false,
        "lengthChange": false,
        "language": lenguaje_datatable,
    });

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