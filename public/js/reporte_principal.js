
$(document).ready(function(){

    cargarSelectEscuela();

});




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


function periodoOnChange(sel) {
    if (sel.value=="un_ciclo"){
         divC = document.getElementById("select-un-ciclo");
         divC.style.display = "";

         divT = document.getElementById("select-mas-ciclo");
         divT.style.display = "none";

    }else{

         divC = document.getElementById("select-mas-ciclo");
         divC.style.display="";

         divT = document.getElementById("select-un-ciclo");
         divT.style.display = "none";
    }
}