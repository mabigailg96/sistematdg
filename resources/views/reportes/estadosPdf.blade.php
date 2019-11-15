<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/minerva.png">
      </div>
      <h1>{{$titulo}}</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>Reporte</span> Reporte de Trabajos de Graduación {{$estado}}</div>
        <div><span>Escuela</span>{{$college->nombre_completo}} </div>
        <div><span>Fecha</span> {{$fecha}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Código</th>
            <th class="desc">Nombre</th>
            <th>Escuela</th>
            <th>Ciclo</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach($consulta as $tdg)
          <tr>
            <td class="service">{{$tdg->codigo}}</td>
            <td class="desc">{{$tdg->nombre}}</td>
            <td class="unit">{{$tdg->escuela}}</td>
            <td class="qty">{{$tdg->ciclo}}</td>
            
          </tr>
          @endforeach
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
         
         
         
        </tbody>
      </table>
    </main>
    <footer>
      Reporte de trabajos de graduación para la Facultad de Ingeniería y Arquitectura.
    </footer>
  </body>
</html>