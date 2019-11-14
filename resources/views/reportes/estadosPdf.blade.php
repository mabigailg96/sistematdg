<html>
<head>
   <title>informe superpuzzles</title>
   <link rel="STYLESHEET" type="text/css" href="estilo.css">
   <link rel="STYLESHEET" type="text/css" href="estilo_imprimir.css" media="print">
</head>

<body>

<div id="contenedor">
    <div id="cabecera">
      Superpuzzles
    </div>
   <div id="logo">
       <img src="logo.gif">
   </div>
   <div id="cuerpo">
    <div id="lateral">
    <ul>
       <li><a href="#">Enlace 1</a>
       <li><a href="#">Vínculo 2</a>
    </ul>
    </div>
    <div id="derecha">
       <div id="principal">
       <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Escuela</th>
                <th>Ciclo</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($consulta as $tdg)
            <tr>
                <td>{{ $tdg->codigo }}</td>
                <td>{{ $tdg->nombre }}</td>
                <td>{{ $tdg->escuela }}</td>
                <td class="text-right">{{ $tdg->ciclo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
       </div>
    </div>
   </div>
    <div id="pie">
    © 2005 DesarrolloWeb.com
    </div>
</div>

</body>
</html> 