<?php 
  include_once('session.php');
  include_once ('connection_db.php');  

  $connection = db_connect();

  //When user press the submit button
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['btnAgregarCurso'])) {
      $nombreCurso = mysqli_real_escape_string($connection, $_POST['nombreCurso']);
      $diaCurso = mysqli_real_escape_string($connection, $_POST['diaCurso']);
      $selectHorario = mysqli_real_escape_string($connection,$_POST['horarioCurso']);
      $profesorCurso = mysqli_real_escape_string($connection, $_POST['profesorCurso']);
      $anoCurso = mysqli_real_escape_string($connection, $_POST['anoCurso']);

      if ($nombreCurso == "" || $diaCurso == "" || $selectHorario == "" || $profesorCurso == "") {
        echo "<div class='error'>Error: Debes llenar todos los campos para crear un nuevo curso</div>";
      } else {
        $sql = "INSERT INTO `curso`(`nombre_curso`, `dia`, `hora`, `ano`, `id_profesor`) VALUES ('$nombreCurso', '$diaCurso', '$selectHorario', '$anoCurso','$profesorCurso')";
        // Insert the data if the query its ok
        if ($connection->query($sql) === TRUE) {
            echo "<div class='success'>El curso se ha creado correctamente</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
      }

    } else {
      $nombreProyecto = mysqli_real_escape_string($connection, $_POST['pname']);
      $selectNewCurso = mysqli_real_escape_string($connection,$_POST['newCurso']);
      $descripcionProyecto = mysqli_real_escape_string($connection,$_POST['descripcion']);
      $selectTipoProyecto = mysqli_real_escape_string($connection,$_POST['tipo']);
      $selectTecnologia = implode(',', $_POST['check_list']);
      $duracionProyecto = mysqli_real_escape_string($connection,$_POST['pduracion']);

      //save image to folder projects
      $folder = "images_projects/";
      move_uploaded_file($_FILES["filep"]["tmp_name"] , "$folder".$_FILES["filep"]["name"]);

      //name of the image
      $nombreImagen = $_FILES["filep"]["name"];

      $direccionTotal = "images_projects/".$nombreImagen;

      if ($nombreProyecto == "" || $selectNewCurso == "" || $descripcionProyecto == "" || !isset($selectTipoProyecto) || !isset($selectTecnologia) || $duracionProyecto == "") {
        echo "<div class='error'>Error: Debes llenar todos los campos con (*) para crear un nuevo proyecto</div>";
      } else {
        // Query to insert data
        $sql = "INSERT INTO `proyecto`(`nombre_proyecto`, `id_curso`, `descripcion`, `tipo_proyecto`, `tecnología_usada`, `duración`, `imagen`) VALUES ('$nombreProyecto','$selectNewCurso','$descripcionProyecto', '$selectTipoProyecto', '$selectTecnologia', '$duracionProyecto','$direccionTotal')";

        // Insert the data if the query its ok
        if ($connection->query($sql) === TRUE) {
            echo "<div class='success'>El Proyecto se ha creado correctamente</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
      }
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
      <li><a href="bandeja_entrada.php">Bandeja de Entrada</a></li>
      <li><a class="active" href="administrador.php">Portafolio de Proyectos</a></li>
      <li><a href="ver_informacion.php">Ver Información Proyectos</a></li>
      <li><a href="crear_profesor.php">Añadir Profesor</a></li>
      <li><a href="crear_interes.php">Añadir Interes</a></li>
      <li><a href="ver_intereses.php">Ver Interes</a></li>
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>

    <div id="elemento">
      <div class="header">
        <img src="https://emprendemiestrategia.files.wordpress.com/2012/03/portafolio1.png" alt="logo" />
        <h1>Portafolio de Proyectos</h1>
      </div>
      <br><br><br>
      <form action="" method="post" enctype="multipart/form-data">
        <label for="pname">Nombre del Proyecto *</label>
        <input type="text" id="pname" name="pname"><br>

        <label for="cname">Curso *</label>
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
            <div class="select_style">
              <select name="horarioCurso">
                <?php 
                  $sql = "SELECT id_horario, hora FROM horario";
                  $result = mysqli_query($connection,$sql);
                  while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                            
                    echo "<option value='".$row['hora']."'>".$row['hora']."</option>";
                  }
                ?>
              </select>
              <span></span>
            </div><br>
            <label for="Horario">Profesor del curso</label><br>
            <div class="select_style">
              <select name="profesorCurso">
                <?php 
                  $sql = "SELECT id_profesor, nombre_profesor FROM profesores";
                  $result = mysqli_query($connection,$sql);
                  while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                            
                    echo "<option value='".$row['id_profesor']."'>".$row['nombre_profesor']."</option>";
                  }
                ?>
              </select>
              <span></span>
            </div><br>

            <label for="Ano">Seleccione el año que recibió el curso</label><br>
            <div class="select_style">
              <select id="year" name="anoCurso"></select><span></span>
              <script type="text/javascript">
                var start = 2012;
                var end = new Date().getFullYear();
                var options = "";
                for(var year = start ; year <=end; year++){
                  options += "<option value="+ year +">" + year +"</option>";
                }
                document.getElementById("year").innerHTML = options;
              </script>             
            </div><br>
            <input type="submit" name="btnAgregarCurso" class="button" value="Crear Curso" />
        </div><br>


        <label>Descripción *</label>
        <textarea name="descripcion" placeholder="Descripción del proyecto" ></textarea><br>

        <label>Tipo Proyecto *</label><br>
        <input type="radio" value="Investigación" name="tipo"> Investigación<br>
        <input type="radio" value="Proyecto" name="tipo"> Proyecto Programado<br>
        <input type="radio" value="Individual" name="tipo"> Individual<br>
        <input type="radio" value="Grupal" name="tipo"> Grupal<br>

        <br><label>Tecnologías utilizadas *</label><br>
        <div>
          <?php 
            $sql = "SELECT nombre_tecnologia FROM tecnologias";
            $result = mysqli_query($connection,$sql);
            while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                            
              echo "<input type='checkbox' value='".$row['nombre_tecnologia']."' name='check_list[]'>".$row['nombre_tecnologia']."<br>";
            }
          ?>
        </div>

        <br><label>Duración del proyecto(cantidad de días) *Solamente acepta números</label>
        <input type="number" id="pduracion" name="pduracion"><br> 

        <label>Seleccionar imagen del proyecto</label><br>
        <input type="file" name="filep"><br><br>

        <div align="center">
          <input type="submit" name="btnSubmit"  class="button" value="Crear Proyecto" />
        </div>
          
      </form>
    </div>

  </body>
</html>

