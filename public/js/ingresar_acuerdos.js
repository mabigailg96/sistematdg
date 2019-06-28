$(document).ready(function(){
  //alert($.urlParam("nombre"));
  //alert($(".help-block").html());
  if($.urlParam("yes") == 1){
    Swal.fire(
      'Acuerdo:',
      "Registrado con éxito!",
      'success'
    );
  } else if($.urlParam("yes") == 0 || $(".help-block").html() != undefined) {
    Swal.fire({
      position: 'top-end',
      type: 'error',
      title: 'Error en los datos ingresados',
      showConfirmButton: false,
      timer: 2000
    });
    if($.urlParam("nombre") != undefined){
      $("#nombre").val($.urlParam("nombre"));
    }
  }
  history.pushState({data:true}, 'Titulo', '/ingresar/acuerdos');
});

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
