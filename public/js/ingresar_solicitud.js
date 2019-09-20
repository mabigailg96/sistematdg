$(document).ready(function(){
  //alert($.urlParam("nombre"));
  //alert($(".help-block").html());
  if($.urlParam("save") == 1){
    Swal.fire(
      'Solicitud: '+ $.urlParam("tipo")+' ',
      "Envíada con éxito!",
      'success'
    );
  } else if($.urlParam("save") == 0 || $(".help-block").html() != undefined) {
    Swal.fire({
      position: 'top-end',
      type: 'error',
      title: 'Ya rebaso los límites para la prórroga',
      showConfirmButton: false,
      timer: 2000
    });
  }
  history.pushState({data:true}, 'Titulo', '/listar/tdg/solicitudes');
});

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
