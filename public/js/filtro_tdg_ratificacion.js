var lenguaje_datatable;
$(document).ready(function(){
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
     // Al cargar la página que la tabla esté sin información
     cargarDataTable();

      // Cargar datos a la tabla
    cargarDatosTdgRatificacion();
  });

  $(document).on("click", "#btn-filtro-buscar", function() {
    cargarDatosTdgRatificacion();
});

$(document).on("click", "#btn-filtro-limpiar-busqueda", function() {
    $("#txt-filtro-nombre-tdg").val("");
    $("#txt-filtro-codigo-tdg").val("");
    $("#txt-filtro-escuela").val("");
    cargarDatosTdgRatificacion();
});

function cargarDatosTdgRatificacion() {
    // Inicializamos las variables a utilizar
    var nombre = '';
    var codigo = '';
    var escuela_id ='';
    //Obtenemos los datos
    var txt_filter_nombre = $("#txt-filtro-nombre-tdg").val();
    var txt_filter_codigo = $("#txt-filtro-codigo-tdg").val();
    var txt_filter_escuela = $("#txt-filtro-escuela").val();
    console.log(txt_filter_nombre);
    console.log(txt_filter_codigo);
    console.log(txt_filter_escuela);
    // Validamos que los imputs contengan o no informacion
    if (txt_filter_nombre != undefined || txt_filter_nombre != '') {
        nombre = txt_filter_nombre;
    }

    if (txt_filter_codigo != undefined || txt_filter_codigo != '') {
        codigo = txt_filter_codigo;
    }
    if (txt_filter_escuela != undefined || txt_filter_escuela != '') {
        escuela_id = txt_filter_escuela;
    }

    // Parametros que se enviaran a la peticion de los datos.
    var params = {
        nombre: nombre,
        codigo: codigo,
        escuela_id: escuela_id,
    }

    //ahora ejecutamos la peticion AJAX

    axios.get('/todos/tdg/ver/ratificacion', {
        params: params
    }).then(response => {
        console.log(response.data);
        if (response.data.length > 0) {
            $("#table-filtro-tdg-ratificacion").DataTable({
                "destroy": true,
                "processing": true,
                "data": response.data,
                "ordering": false,
                "pageLength": 10,
                "columns": [
                    { 'data': 'id' },
                    { 'data':'codigo' },
                    { 'data': 'nombre'},
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
    var table = $("#table-filtro-tdg-ratificacion").DataTable({
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

// Función para llenar el select con los nombres de escuela
function cargarSelectEscuela() {
  // Función de axios para hacer la consulta
  axios.get('/todos/colleges')
  .then(response => {
      //console.log(response);

      // Llenar el select con los elementos traidos
      response.data.forEach(element => {
          $("#txt-filtro-escuela").append(new Option(element.escuela, element.id));
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
