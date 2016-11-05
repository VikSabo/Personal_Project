<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/estilo_administrador.css">
  </head>
  <body>
    <ul>
      <br>
      <div align="center"> 
        <div class="avatar">
        </div><br>
      </div>
      <li><a href="inbox.html">Bandeja de Entrada</a></li>
      <li><a class="active" href="administrador.html">Portafolio de Proyectos</a></li>
      <li><a href="edit_infopersonal.html">Información personal</a></li>
    </ul>

    <div style="margin-left:18%;padding:1px 16px;height:1000px;">
      <h1>Administrador - Víctor Saborío Hernández</h1>
      <form action="" method="post">
        <label for="pname">Nombre del Proyecto</label>
        <input type="text" id="pname" name="pname"><br>
        <label for="cname">Curso</label>
        <input type="text" id="cname" name="cname"><br>
        <label>Descripción</label>
        <textarea>Aquí va el texto</textarea><br>
        <label>Tipo Proyecto</label><br>
        <input type="radio" checked="checked" value="investigacion" name="tipo"> Investigación<br>
        <input type="radio" value="proyecto" name="tipo"> Proyecto Programado<br>
        <input type="radio" value="individual" name="tipo"> Individual<br>
        <input type="radio" value="grupal" name="tipo"> Grupal<br>
        <label>Tecnologías utilizadas</label><br>
        <input type="checkbox" checked="checked" value="php"> PHP<br>
        <input type="checkbox" value="css"> CSS<br>
        <input type="checkbox" value="js"> Javascript<br>
        <input type="checkbox" value="mysql"> MySQL<br>
        <label>Duración del proyecto(cantidad de días) *Solamente acepta números</label>
        <input type="number" id="pduracion" name="pduracion"> <br><br>
        <div align="center">
          <button class="button">Aceptar</button>
        </div>
          
      </form>
    </div>

    <footer>
        &copy; Copyright - Víctor Saborío H<br>
        Instituto Tecnológico de Costa Rica 2016
    </footer>  

  </body>
</html>

