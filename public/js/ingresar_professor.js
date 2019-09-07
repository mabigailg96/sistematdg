$(document).ready(function(){

  // Ocultar formularios al cargar la página
  $("#formulario-excel").collapse("hide");
  $("#formulario-individual").collapse("hide");

  if($.urlParam("save") == 1) {
    Swal.fire(
      'Docentes:',
      "Registrado con éxito!",
      'success'
    );
  } else if($.urlParam("save") == 0 || $(".help-block").html() != undefined) {

    $(".help-block").closest(".collapse").collapse("show");

    Swal.fire({
      position: 'top-end',
      type: 'error',
      title: 'Error en los datos ingresados',
      showConfirmButton: false,
      timer: 2000
    });
  }

  history.pushState({data:true}, 'Titulo', '/ingresar/profesores');
});

// Simbolo de carga al subir datos
$(document).on("click", "#btn-formulario-excel", function(){
  if($("#file").val().length > 0 ){

    Swal.fire(
      'Registrando a los docentes',
    );
    Swal.showLoading();
  }
});

// Mostrar formulario para importar docentes mediantes archivo de excel
$(document).on("click", "#btn-formulario-excel", function(){
  $("#formulario-individual").collapse("hide");
  $("#formulario-excel").collapse("toggle");
});


// Mostrar formulario para importar docentes mediantes formulario individual
$(document).on("click", "#btn-formulario-individual", function(){
  $("#formulario-excel").collapse("hide");
  $("#formulario-individual").collapse("toggle");
});


//funcion para obtener los parametros de la url.
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
