$(document).ready(function(){
    //alert($.urlParam("nombre"));
    //alert($(".help-block").html());
    if($.urlParam("save") == 0){

        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Cambie el nombre del archivo.',
            showConfirmButton: false,
            timer: 3000
        });

        var URLactual = window.location;
        //alert(URLactual.href);
        //alert(URLactual.href.indexOf("?", 0));
        var nueva_cadena = URLactual.href.substr(0, URLactual.href.indexOf("?", 0));
        //alert(nueva_cadena);
    
        history.pushState({data:true}, 'Titulo', nueva_cadena);
    }

  });
  
  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null) {
         return null;
      }
      return decodeURI(results[1]) || 0;
  }
  