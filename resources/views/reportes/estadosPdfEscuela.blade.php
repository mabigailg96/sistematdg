<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte TDG FIA</title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      
      <h1>
      <div id="logo">
        <img src="img/minerva.png">
      </div>
      Universidad de El Salvador
      <br>
      Facultad de Ingeniería y Arquitectura
      <br>
      Reporte de trabajos de graduación con estado de: {{$estado}}
      <br>
      @if($college=='Todas las escuelas')
      Todas las escuelas
      @else
      Escuela de: {{$college->nombre_completo}}
      @endif
      </h1>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Código</th>
            <th class="desc">Nombre</th>
            <th>Ciclo</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach($consulta as $tdg)
          <tr>
            <td class="service">{{$tdg->codigo}}</td>
            <td class="desc">{{$tdg->nombre}}</td>
            <td class="qty">{{$tdg->ciclo}}</td>
            
          </tr>
          @endforeach

        </tbody>
      </table>
    </main>
    <footer>
      Reporte de trabajos de graduación para la Facultad de Ingeniería y Arquitectura.
    </footer>
  </body>
</html>