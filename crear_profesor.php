<?php 
  include_once('session.php');
  include_once ('connection_db.php');  

  $connection = db_connect();

  //When user press the submit button
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreProfesor = mysqli_real_escape_string($connection, $_POST['nombreProfesor']);

    $sql = "INSERT INTO `profesores`(`nombre_profesor`) VALUES ('$nombreProfesor')";
      // Insert the data if the query its ok
    if ($connection->query($sql) === TRUE) {
      echo "<div class='success'>El profesor se ha añadido correctamente</div>";
    } else {
      echo "Error: " . $sql . "<br>" . $connection->error;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/estilo_administrador.css">
    <link rel="stylesheet" type="text/css" href="styles/estilo_general.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  </head>

  <body>
    <ul>
      <br>
      <div align="center"> 
        <div class="avatar">
        </div><br>
      </div>
      <li><a href="bandeja_entrada.php">Bandeja de Entrada</a></li>
      <li><a href="administrador.php">Portafolio de Proyectos</a></li>
      <li><a href="ver_informacion.php">Ver Información Proyectos</a></li>
      <li><a class="active" href="crear_profesor.php">Añadir Profesor</a></li>
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>

    <div id="elemento">
      <h1>Administrador - Víctor Saborío Hernández</h1>
      <form action="" method="post" enctype="multipart/form-data">
        <label for="pname">Nombre del Profesor</label>
        <input type="text" id="nombreProfesor" name="nombreProfesor"><br>
        <div align="center">
          <input type="submit" name="btnSubmit"  class="button" value="Agregar Profesor" />
        </div>
          
      </form>
    </div>

  </body>
</html>

