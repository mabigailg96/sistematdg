$(document).ready(function(){
    $("#btnCargar").click(function(){
        if($("#file").val().length > 0 ){

                Swal.fire(
                'Registrando a los docentes',
               );
               Swal.showLoading();

        }
    });
  });

  $(document).ready(function(){
    if($.urlParam("save") == 1){
           Swal.fire(
             'Profesores:',
             "Registrados con éxito!",
             'success'
           );
         }
   });

   $(document).ready(function(){
    if($.urlParam("error") == 1){
           Swal.fire({
            type: 'error',
            title: 'Error en los datos ingresados, se repite un profesor',
            showConfirmButton: false,
            timer: 2000
            }
           );
         }
   });

   $(document).ready(function(){
    if($.urlParam("save") == 2){
           Swal.fire(
             'Profesor:',
             "Registrado con éxito!",
             'success'
           );
         }
   });
//funcion para obtener los parametros de la url.
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
