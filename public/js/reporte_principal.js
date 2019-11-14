
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

$(document).on("click", "#generar-reporte", function() {
    // Inicializar variables
    var ciclo = '';
    var cicloInicio = '';
    var cicloFin = '';
    var escuela = $("#select-filtro-escuela").val();
    var estado = $("#select-filtro-estado").val();
    var periodo = $("#select-filtro-periodo").val();

    if(periodo == 'un_ciclo'){
        var ciclo = $("#select-filtro-ciclo").val();
        console.log(ciclo);
    }
    if(periodo == 'mas_ciclo'){
       var cicloInicio = $("#select-filtro-cicloInicio").val();
       var cicloFin = $("#select-filtro-cicloFin").val();
       console.log(cicloInicio, cicloFin);
    }
    console.log(estado, escuela, periodo);

    //Comparar fechas. 
    var params = {
        escuela: escuela,
        estado: estado,
        periodo: periodo,
        ciclo: ciclo,
        cicloInicio: cicloInicio,
        cicloFin: cicloFin,
    };

    console.log(params);

    axios.get("/reporte/generar/estados", {

        params: params

    }).then(response => {

        console.log(response.data.mensaje);

        if(response.data.mensaje=='Error_ciclo'){
            Swal.fire({
                type: 'error',
                title: '¡Alto!',
                text: 'El ciclo de inicio tiene que ser menor que el ciclo fin.',
            })
        }else{
            Swal.fire({
                type: 'success',
                title: 'Reporte:',
                text: 'Generado con éxito!:',
            })
          
            window.location.href = "/reporte/generar/estadosPdf?escuela="+escuela+"&estado="+estado+"&periodo="+periodo+"&ciclo="+ciclo+"&cicloInicio="+cicloInicio+"&cicloFin="+cicloFin;
        
        }
    

});
})