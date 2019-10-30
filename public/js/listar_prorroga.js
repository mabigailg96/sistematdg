$(document).ready(function(){
    //alert($.urlParam("nombre"));
    //alert($(".help-block").html());
    if($.urlParam("save") == 1){
      Swal.fire(
        'Parámetro',
        "Modificado con éxito!",
        'success'
      );
    } else if($.urlParam("save") == 0 || $(".help-block").html() != undefined) {
      Swal.fire({
        position: 'top-end',
        type: 'error',
        title: 'Error en los datos ingresados',
        showConfirmButton: false,
        timer: 2000
      });
    }
    history.pushState({data:true}, 'Titulo', '/listar/prorroga');
  });
  
  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null) {
         return null;
      }
      return decodeURI(results[1]) || 0;
  }
  