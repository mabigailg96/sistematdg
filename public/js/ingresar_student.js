/* Funcion de mensaje de carga:
-> primero se verifica que exista un documento cargado en el formulario
despues de verificado despliega el mensaje de carga, mientras se cargan
todos los estudiantes. */
$(document).ready(function(){
    $("#btnCargar").click(function(){
        if($("#file").val().length > 0 ){
            if($("#escuela_id").val().length > 0){
                Swal.fire(
                'Registrando a los estudiantes',
               );
               Swal.showLoading();
            }
        }
    });
  });

  $(document).ready(function(){
    if($.urlParam("error") == 1){
           Swal.fire({
            type: 'error',
            title: 'Error en los datos ingresados, se repite un estudiante',
            showConfirmButton: false,
            timer: 4000
            }
           );
         }

     });
 $(document).ready(function(){
            if($.urlParam("save") == 1){
                   Swal.fire(
                     'Estudiantes:',
                     "Registrados con éxito!",
                     'success'
                   );
                 }
                 history.pushState({data:true}, 'Titulo', '/ingresar/estudiantes');
           });



/* Funcion que despliega un mensaje de exito
   cuando se cargaron todos los estudiantes
   a la base de datos desde el excel.
 */


$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
