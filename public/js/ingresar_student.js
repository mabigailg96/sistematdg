$(document).ready(function(){
 if($.urlParam("save") == 1){
        Swal.fire(
          'Estudiantes:',
          "Registrados con éxito!",
          'success'
        );
      }
});

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
