// Declarar variables globales
var lenguaje_datatable;

$(document).ready(function() {
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

    $("#table-students").DataTable({
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

    $("#table-advisers-internal").DataTable({
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

    $("#table-advisers-external").DataTable({
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

    $("#table-historial").DataTable({
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
});

// Función para abandonar el TDG
$(document).on("click", "#btn-abandonar-tdg", function() {

    Swal.fire({
        title: 'Un momento...',
        text: "¿Seguro que desea abadonar el TDG?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, abandonar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var params = {
                tdg_id: $("#tdg-id").html(),
            };

            console.log(params);

            axios.get("/abandonar/student/tdg", {

                params: params

            }).then(response => {

                console.log(response.data);

                // Mostrar mensaje de éxito de que todo ha sido registrado
                Swal.fire({
                    type: 'success',
                    title: 'Abandonado!:',
                    text: 'El presente TDG ha sido abandonado.!:',
                })
                .then(function(){
                    $("#lbl-estado-oficial").html(response.data.tdg.estado_oficial);
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
        }
    })

});

// Boton de imprimir
$(document).on("click", "#btn-imprimir-tdg", function(){
    window.location.href = "/imprimir/detalle/tdg/"+$(this).attr("value");
});
$(document).ready(function(){
    $("#printButton").click(function(){
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.printableArea").printArea( options );
    });
});
