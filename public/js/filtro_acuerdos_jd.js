var lenguaje_datatable;
$(document).ready(function() {
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
    // Al cargar la página que la tabla esté sin información
    cargarDataTable();


    // Cargar datos a la tabla
    cargarDatosAcuerdos();
});

$(document).on("click", "#btn-filtro-buscar", function() {
    cargarDatosAcuerdos();
});

// Al dar click en buscar que se limpien los campos de codigo y nombre y se regresan los datos sin filtro
$(document).on("click", "#btn-filtro-limpiar-busqueda", function() {
    $("#txt-filtro-fecha").val("");
    $("#txt-filtro-nombre").val("");
    cargarDatosAcuerdos();
});

function cargarDatosAcuerdos() {
    // Inicializamos las variables a utilizar
    var nombre = '';
    var fecha = '';
    //Obtenemos los datos
    var txt_filter_nombre = $("#txt-filtro-nombre").val();
    var txt_filter_fecha = $("#txt-filtro-fecha").val();
    console.log(txt_filter_nombre);
    console.log(txt_filter_fecha);
    // Validamos que los imputs contengan o no informacion
    if (txt_filter_nombre != undefined || txt_filter_nombre != '') {
        nombre = txt_filter_nombre;
    }

    if (txt_filter_fecha != undefined || txt_filter_fecha != '') {
        fecha = txt_filter_fecha;
    }
    // Parametros que se enviaran a la peticion de los datos.
    var params = {
        nombre: nombre,
        fecha: fecha,
    }

    //ahora ejecutamos la peticion AJAX

    axios.get('/todos/acuerdos/ver/jd', {
        params: params
    }).then(response => {
        console.log(response.data);
        if (response.data.length > 0) {
            $("#table-filtro-acuerdos").DataTable({
                "destroy": true,
                "processing": true,
                "data": response.data,
                "ordering": false,
                "pageLength": 10,
                "columns": [
                    { 'data': 'nombre' },
                    { /*'data': 'fecha'*/
                    sorteable: false,
                    'data':function (data, type, full, meta){
                        var texto = data.fecha;
                        return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                      }
                },
                    {
                        sorteable: false,
                        "render": function(data, type, full, meta) {
                            //url del documento a mostrar o descargar
                            var path = full.url;
                            console.log(path);
                            // esta funcion lo que hace es reiniciar la url y fija la
                            //url de donde se encuetra los archivos
                            axios.defaults.baseURL = '';
                            var htmlButtons = `<a href='/acuerdos/${path}'  target="_blank" >Visualizar</a>`;
                            return htmlButtons;
                        }
                    },
                ],
                "columnDefs": [
                    { "width": "70", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "15%", "targets": 2 },
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

// Cargar el DataTable sin ningún dato
function cargarDataTable() {
    var table = $("#table-filtro-acuerdos").DataTable({
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
