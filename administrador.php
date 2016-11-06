<?php 
  include_once('session.php');
  include_once ('connection_db.php');  

  $connection = db_connect();

  //When user press the submit button
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //user name and password sent from form
    
    $nombreProyecto = mysqli_real_escape_string($connection, $_POST['pname']);
    $selectNewCurso = mysqli_real_escape_string($connection,$_POST['newCurso']);
    $descripcionProyecto = mysqli_real_escape_string($connection,$_POST['descripcion']);
    $selectTipoProyecto = mysqli_real_escape_string($connection,$_POST['tipo']);
    $selectTecnologia = implode(',', $_POST['check_list']);
    $duracionProyecto = mysqli_real_escape_string($connection,$_POST['pduracion']);
    
    // Query to insert data
    $sql = "INSERT INTO `proyecto`(`nombre_proyecto`, `id_curso`, `descripcion`, `tipo_proyecto`, `tecnología_usada`, `duración`, `imagen`) VALUES ('$nombreProyecto','$selectNewCurso','$descripcionProyecto', '$selectTipoProyecto', '$selectTecnologia', '$duracionProyecto','imagen')";

    // Insert the data if the query its ok
    if ($connection->query($sql) === TRUE) {
        echo "<div class='success'>El proyecto se ha creado correctamente</div>";
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
    <link rel="stylesheet" type="text/css" href="style/estilo_general.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $("#newCurso").change(function() {
                // showform is the id of the other select box 
                if ($(this).val() == "nuevo") {
                    $("#showform").show();
                }else{
                    $("#showform").hide();
                } 
            });
        });
    </script>
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
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>

    <div style="margin-left:18%;padding:1px 16px;height:1000px;">
      <h1>Administrador - Víctor Saborío Hernández</h1>
      <form action="" method="post">
        <label for="pname">Nombre del Proyecto</label>
        <input type="text" id="pname" name="pname"><br>

        <label for="cname">Curso</label>
        <div class="select_style">
          <select id="newCurso" name="newCurso">
            <?php 
              $sql = "SELECT id_curso,nombre_curso FROM curso";
              $result = mysqli_query($connection,$sql);
              while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                                                 
                 echo "<option value='".$row['id_curso']."'>".$row['nombre_curso']."</option>";
              }
            ?>
            <option value="nuevo">Nuevo Curso</option>
          </select>
          <span></span>
        </div><br>

        <div id="showform"  style="display:none;" align="center">
            <label for="nombreCurso">Nombre del Curso</label><br>
            <input type="text" name="nombreCurso" placeholder="Nombre del curso"><br>
            <label for="nombreCurso">Día del Curso</label><br>
            <input type="text" name="diaCurso" placeholder="Lunes, Martes,etc"><br>
            <label for="Horario">Horario del Curso</label><br>
            <input type="text" name="horarioCurso" placeholder="Ej 13:00 - 15:00"><br>
            <label for="Horario">Profesor del curso</label><br>
            <input type="text" name="profesorCurso" placeholder="Juancho Salazar"><br>
            <button type="button" >Agregar Curso</button>
        </div><br>


        <label>Descripción</label>
        <textarea name="descripcion" placeholder="Descripción del proyecto" ></textarea><br>

        <label>Tipo Proyecto</label><br>
        <input type="radio" checked="checked" value="investigacion" name="tipo"> Investigación<br>
        <input type="radio" value="proyecto" name="tipo"> Proyecto Programado<br>
        <input type="radio" value="individual" name="tipo"> Individual<br>
        <input type="radio" value="grupal" name="tipo"> Grupal<br>

        <br><label>Tecnologías utilizadas</label><br>
        <input type="checkbox" checked="checked" value="php" name="check_list[]"> PHP<br>
        <input type="checkbox" value="css" name="check_list[]"> CSS<br>
        <input type="checkbox" value="js" name="check_list[]"> Javascript<br>
        <input type="checkbox" value="mysql" name="check_list[]"> MySQL<br>

        <br><label>Duración del proyecto(cantidad de días) *Solamente acepta números</label>
        <input type="number" id="pduracion" name="pduracion"> <br><br>
        <div align="center">
          <button class="button">Aceptar</button>
        </div>
          
      </form>
    </div>

  </body>
</html>

