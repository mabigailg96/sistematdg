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