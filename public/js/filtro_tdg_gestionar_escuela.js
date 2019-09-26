// Declarar variables globales
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

    // Al cargar la página que la tabla esté sin información
    cargarDataTable();
      

    // Cargar datos a la tabla
    cargarDatosTdg();
});

// Al dar click en buscar que se actualicé la tabla
$(document).on("click", "#btn-filtro-buscar", function(){
    cargarDatosTdg();
});

// Al dar click en buscar que se limpien los campos de codigo y nombre y se regresan los datos sin filtro
$(document).on("click", "#btn-filtro-limpiar-busqueda", function(){
    $("#txt-filtro-codigo").val("");
    $("#txt-filtro-nombre").val("");
    $("#select-filter-estado").val("null");
    cargarDatosTdg();
    $("#select-filter-estado").val("");
});


// Función para llenar la tabla TDG
function cargarDatosTdg() {

    // Inicializar variables
    var codigo = '';
    var nombre = '';

    // Obtener valores de los input
    var txt_filter_codigo = $("#txt-filtro-codigo").val();
    var txt_filter_nombre = $("#txt-filtro-nombre").val();
    var filter_escuela_id = $("#filtro-escuela_id").val();
    var filter_estado_oficial = $("#select-filter-estado").val();

    // Validar si los input no continen nada
    if(txt_filter_codigo != undefined || txt_filter_codigo != '') {
        codigo = txt_filter_codigo;
    }

    if(txt_filter_nombre != undefined || txt_filter_nombre != '') {
        nombre = txt_filter_nombre;
    }

    // Parametros a enviar a la perticion de datos
    var params = {
        escuela_id: filter_escuela_id,
        estado_oficial: filter_estado_oficial,
        codigo: codigo,
        nombre: nombre,
    };

    //console.log(params);

    // Ejecutar petición ajax
    axios.get('/todos/tdg/gestionar/escuela', {
        params: params
    }).then(response => {
        //console.log(response.data);
        if(response.data.length > 0){
            // Llenar la tabla con los resultados traidos de la peticion
            $("#table-filtro-tdgs").DataTable({
                "destroy": true,
                "processing": true,
                "data": response.data,
                "ordering": false,
                "pageLength": 10,
                "columns": [
                    { 'data': 'codigo' },
                    { 'data': 'nombre' },
                    { sortable: false,
                        "render": function ( data, type, full, meta ) {
                            // En caso de que traiga un valor null
                            var etiqueta = full.estado_oficial;
                            if(etiqueta == null) {
                                return 'Recien ingresado';
                            } else {
                                return etiqueta;
                            }
                    }},
                    { sortable: false,
                    "render": function ( data, type, full, meta ) {
                        // Id del TDG
                        var id = full.id;
                        var htmlButtons = `<a href="/ver/detalle/tdg/escuela/${id}">Ver detalles</a>`;

                        return htmlButtons;
                    }},
                ],
                "info": false,
                "searching": false,
                "ordering": false,
                "lengthChange": false,
                "language": lenguaje_datatable,
            });
        } else if(response.data.length == 0) {
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

// Cargar el DataTable sin ningún dato
function cargarDataTable(){
    var table = $("#table-filtro-tdgs").DataTable({
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
