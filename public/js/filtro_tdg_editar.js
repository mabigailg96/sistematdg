// Declarar variables globales
var lenguaje_datatable;

$(document).ready(function(){
    // Variable del idioma para la datatable
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

    // Cargar lista de escuela
    cargarSelectEscuela();
      

    // Cargar datos a la tabla
    //cargarDatosTdg();
});

$(document).on("change", "#select-filter-accion", function(){
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
    $("#select-filtro-escuela").val(0);
    $("#select-filter-accion").val(0);
    cargarDataTable();
});

// Función para llenar la tabla TDG
function cargarDatosTdg() {

    // Inicializar variables
    var codigo = '';
    var nombre = '';

    // Obtener valores de los input
    var txt_filter_codigo = $("#txt-filtro-codigo").val();
    var txt_filter_nombre = $("#txt-filtro-nombre").val();
    var filter_escuela_id = $("#select-filtro-escuela").val();
    var filter_accion = $("#select-filter-accion").val();

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
        codigo: codigo,
        nombre: nombre,
        accion: filter_accion,
    };

    //console.log(params);

    // Ejecutar petición ajax
    axios.get('/todos/tdg/editar', {
        params: params
    }).then(response => {
        console.log(response.data);
        
        if(response.data.length > 0){
            // Llenar la tabla con los resultados traidos de la peticion
            $("#table-filtro-tdgs").DataTable({
        
                "destroy": true,
                "processing": true,
                "data": response.data,
                "ordering": false,
                "pageLength": 10,
                "columns": [

                    { 'data': '0.codigo' },
                    { 'data': '0.nombre' },
                    { 'data': '0.ciclo' },
                    { 'data': '0.escuela' },
                    //{ 'data': 'escuela' },
                    //{ 'data': 'escuela' },

                    { sortable: false,
                        "render": function ( data, type, full, meta ) {
                            // Id del TDG
                            var id = full[0].id;
                            //console.log(id);
                            // Concatenar ruta para el formulario

                            var htmlButton = '';

                            if (filter_accion == 'deshabilitar') {
                                htmlButton = `<a  class="btn btn-danger" onclick="eliminar()" role="button" val="${id}">Deshabilitar</a>`;
                            } else if (filter_accion == 'editar_grupo') {
                                htmlButton = `<a  href="#" role="button" val="${id}">Editar grupo</a>`;
                            }else if (filter_accion == 'editar_nombre'){
                                htmlButton = `<a  href="/editar/nombre/${id}" role="button" val="${id}">Editar nombre</a>`;
                            }
                            

                            return htmlButton;
                        }
                    },

                    // El ejemplo de código del filtro de solicitudes

                    /*
                    { 'data': '0.codigo' },
                    { 'data': '0.nombre' },
                    { 'data': '0.ciclo' },
                    { sortable: false,
                    "render": function ( data, type, full, meta ) {
                        // Id del TDG
                        var id = full[0].id;
                        console.log(id);
                        // Concatenar ruta para el formulario
                        if(tipo_solicitud == 'cambio_de_nombre'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/nombre/${id}">Seleccionar</a>`;
                        } else if(tipo_solicitud == 'prorroga'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/${tipo_solicitud}/${id}">Seleccionar</a>`;
                        } else if(tipo_solicitud == 'extension_de_prorroga'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/${tipo_solicitud}/${id}">Seleccionar</a>`;
                        } else if(tipo_solicitud == 'prorroga_especial'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/${tipo_solicitud}/${id}">Seleccionar</a>`;
                        } else if(tipo_solicitud == 'nombramiento_de_tribunal'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/tribunal/${id}">Seleccionar</a>`;
                        }else if(tipo_solicitud == 'ratificacion_de_resultados'){
                            // Acá se le va a concatenar dependiendo de que tipo de solicitud es
                            var htmlButtons = `<a href="/ingresar/solicitud/${id}">Seleccionar</a>`;
                        } 
                        return htmlButtons;
                    }
                },*/
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
function eliminar(id) {

         var id=id;
      Swal.fire({
        title: '¿Está seguro de deshabilitarlo?',
        text: "No se puede revertir está opción!",
        type:'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirmado',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
           
           
                window.location.href="/deshabilitar/tdg/${id}";
          Swal.fire(
            'Deshabilitado',
            'Fue deshabilitado con éxito',
            'success')
         
        } 
      })
}
// Función para llenar el select con los nombres de escuela
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
    });
}