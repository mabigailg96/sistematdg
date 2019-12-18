
$(document).ready(function(){

    

});






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
    var estado = $("#select-filtro-estado").val();
    indiceEstado = document.getElementById("select-filtro-estado").selectedIndex;
    var periodo = $("#select-filtro-periodo").val();
    indicePeriodo = document.getElementById("select-filtro-periodo").selectedIndex;
    if((indiceEstado==null || indiceEstado==0) || (indicePeriodo==null || indicePeriodo==0)){
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: 'Seleccione todos los parametros necesarios.',
        })
        window.location.href = "/reporte/principal/escuela";
    }
    
    else if(periodo == 'un_ciclo'){
        var ciclo = $("#select-filtro-ciclo").val();
        indiceCiclo = document.getElementById("select-filtro-ciclo").selectedIndex;
        if(indiceCiclo==null || indiceCiclo==0){
            Swal.fire({
                type: 'error',
                title: '¡Alto!',
                text: 'Seleccione todos los parametros necesarios.',
            })
            window.location.href = "/reporte/principal/escuela";
        }else{
            //Comparar fechas. 
    var params = {
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
          
            window.location.href = "/reporte/generar/escuela?estado="+estado+"&periodo="+periodo+"&ciclo="+ciclo+"&cicloInicio="+cicloInicio+"&cicloFin="+cicloFin;
        
        }
    
    

});

        }
        
            
        console.log(ciclo);
    }
    else{
       var cicloInicio = $("#select-filtro-cicloInicio").val();
       indiceCicloInicio = document.getElementById("select-filtro-cicloInicio").selectedIndex;
       var cicloFin = $("#select-filtro-cicloFin").val();
       indiceCicloFin = document.getElementById("select-filtro-cicloFin").selectedIndex;
    }
       if((indiceCicloInicio==null || indiceCicloInicio==0) || (indiceCicloFin==null || indiceCicloFin==0)){
        Swal.fire({
            type: 'error',
            title: '¡Alto!',
            text: 'Seleccione todos los parametros necesarios.',
        })
        window.location.href = "/reporte/principal/escuela";
       }
       else{

      
    
    

    //Comparar fechas. 
    var params = {
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
          
            window.location.href = "/reporte/generar/escuela?estado="+estado+"&periodo="+periodo+"&ciclo="+ciclo+"&cicloInicio="+cicloInicio+"&cicloFin="+cicloFin;
        
        }
    
    

});

       }
})

$(document).on("click", "#btn-filtro-limpiar-busqueda", function() {
    $("#select-filtro-estado").val("");
    $("#select-filtro-periodo").val("");
    $("#select-filtro-ciclo").val(0);
    $("#select-filtro-cicloInicio").val(0);
    $("#select-filtro-cicloFin").val(0);

});
