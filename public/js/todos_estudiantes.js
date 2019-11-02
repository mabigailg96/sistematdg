var lenguaje_datatable;
$(document).ready(function() {

    cargarSelectEscuela();
    lenguaje_datatable = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    };
    //Carar con datos la data table
    cargarDataTable();
    //Cargar los datos
    cargarDatosEstudiantes();

    // if ($.urlParam("save") == 1) {
    //     Swal.fire(
    //         'Estudiantes:',
    //         "Registrado con éxito!",
    //         'success'
    //     );
    // } else if ($.urlParam("save") == 0 || $(".help-block").html() != undefined) {

    //     Swal.fire({
    //         position: 'top-end',
    //         type: 'error',
    //         title: 'Error en los datos ingresados',
    //         showConfirmButton: false,
    //         timer: 2000
    //     });
    // }

    //history.pushState({ data: true }, 'Titulo', '/ingresar/estudiantes');

});

$(document).on("click", "#btn-filtro-buscar", function() {
    cargarDatosEstudiantes();
});
// Al dar click en buscar que se limpien los campos de codigo y nombre y se regresan los datos sin filtro
$(document).on("click", "#btn-filtro-limpiar-busqueda", function() {

    $("#txt-filtro-nombre").val("");
    $("#txt-filtro-carnet").val("");
    cargarDatosEstudiantes();
});
function cargarDatosEstudiantes() {
    // Inicializamos las variables a utilizar
    var nombre = '';
    var carnet = '';
    var escuela = '';
    //Obtenemos los datos
    var txt_filter_nombre = $("#txt-filtro-nombre").val();
    console.log(txt_filter_nombre);
    var txt_filter_carnet = $("#txt-filtro-carnet").val();
    console.log(txt_filter_carnet);
    var txt_filter_escuela = $("#select-filtro-escuela").val();
    console.log(txt_filter_carnet);
    // Validamos que los imputs contengan o no informacion
    if (txt_filter_nombre != undefined || txt_filter_nombre != '') {
        nombre = txt_filter_nombre;
    }
    if (txt_filter_carnet != undefined || txt_filter_carnet != '') {
        carnet = txt_filter_carnet;
    }
    if (txt_filter_escuela != undefined || txt_filter_escuela != '') {
        escuela = txt_filter_escuela;
    }
    // Parametros que se enviaran a la peticion de los datos.
    var params = {
        nombre: nombre,
        carnet: carnet,
        escuela: escuela,
    }

      //ahora ejecutamos la peticion AJAX

      axios.get('/todos/estudiantes/ver', {
        params: params
    }).then(response => {
        console.log(response.data);
        if (response.data.length > 0) {
            $("#table-filtro-nombres-carnet").DataTable({
                "destroy": true,
                "processing": true,
                "data": response.data,
                "ordering": false,
                "pageLength": 10,
                "columns": [
                    { 'data': 'carnet' },
                    { 'data': 'nombres'},
                    { 'data': 'apellidos'},
                    {  sortable: false,
                        "render": function ( data, type, full, meta ) {

                            // Id del TDG
                            var escuela = full.escuela_id; //Cuando haga el filtro tengo que agregar [0]
                            var respuesta = " ";
                            if (escuela  == 1) {
                                return respuesta = "Civil";
                            } if( escuela  == 2){
                             return respuesta = "Industrial";
                            }if( escuela  == 3){
                                return respuesta = "Mecanica";
                               }if( escuela  == 4){
                                return respuesta = "Electrica";
                               }if( escuela  == 5){
                                return respuesta = "Quimica";
                               }if( escuela  == 6){
                                return respuesta = "Alimentos";
                               }if( escuela  == 7){
                                return respuesta = "Sistemas Informaticos";
                               }if( escuela  == 8){
                                return respuesta = "Arquitectura";
                               }else{
                                return respuesta = "Posgrados";
                               }


                            }},

                ],
                "columnDefs": [
                    { "width": "20%", "targets": 0 },
                    { "width": "20%", "targets": 1 },
                    { "width": "20%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                  ],
                "info": false,
                "searching": false,
                "ordering": false,
                "lengthChange": false,
                "language": lenguaje_datatable,
            });
        } else if (response.data.length == 0) {
            cargarDataTable();
        }
    }).catch(e => {
        // Imprimir error en consola
        console.log(e);

        // En caso de que no hayan resultados, siempre pasasr la configuración a la tabla
        cargarDataTable()

        // Mostrar mensaje de error en caso de que algo haya salido mal con la consulta
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: '¡Algo ha salido mal!, por favor intente más tarde.',
        });
    })
    }

    function cargarDataTable() {
        var table = $("#table-filtro-nombres-carnet").DataTable({
            "destroy": true,
            "processing": true,
            "ordering": false,
            "pageLength": 10,
            "info": false,
            "searching": false,
            "ordering": false,
            "lengthChange": false,
            "language": lenguaje_datatable,
        });

        table
            .clear()
            .draw();
    }

function cargarSelectEscuela() {
    // Función de axios para hacer la consulta
    axios.get('/todos/colleges')
        .then(response => {
            //console.log(response);

            // Llenar el select con los elementos traidos
            response.data.forEach(element => {
                $("#select-filtro-escuela").append(new Option(element.escuela, element.id));
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
