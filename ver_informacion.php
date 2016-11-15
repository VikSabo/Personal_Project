<?php 
  //create a new session
  include_once('session.php');
  //connect to database
  include_once('connection_db.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/estilo_general.css">
    <link rel="stylesheet" type="text/css" href="styles/estilo_administrador.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $("a.delete").click(function(e){
            if(!confirm('Estas seguro que desea eliminar esta información?')){
                e.preventDefault();
                return false;
            }
            return true;
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
      <li><a href="administrador.php">Portafolio de Proyectos</a></li>
      <li><a class="active" href="ver_informacion.php">Ver Información Proyectos</a></li>
      <li><a href="crear_profesor.php">Añadir Profesor</a></li>
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>

    <div id="elemento">
      <div class="header">
        <img src="https://cdn3.iconfinder.com/data/icons/stroke/53/Paper-512.png" alt="logo" />
        <h1>Ver Información Proyectos</h1>
      </div>
      <br><br><br>
      <?php 
          $sql = "SELECT * FROM `proyecto`";
          $result = mysqli_query($connection, $sql);

          echo "<table border='1' cellpadding='10'>";

          echo "<tr>
                  <th>ID</th>
                  <th>Nombre Proyecto</th>
                  <th>Descripción</th> 
                  <th>Tipo Proyecto</th>
                  <th>Tecnología Usada</th>
                  <th>Duración</th>
                  <th>Imagen</th>
                </tr>";

          // loop through results of database query, displaying them in the table

          while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            // echo out the contents of each row into a table

            echo "<tr>";

            echo '<td>' . $row['id_proyecto'] . '</td>';

            echo '<td>' . $row['nombre_proyecto'] . '</td>';

            echo '<td>' . $row['descripcion'] . '</td>';

            echo '<td>' . $row['tipo_proyecto'] . '</td>';

            echo '<td>' . $row['tecnología_usada'] . '</td>';

            echo '<td>' . $row['duración'] . '</td>';

            echo '<td>' . $row['imagen'] . '</td>';

            echo '<td><a href="editar_proyecto.php?id=' . $row['id_proyecto'] . '">Editar</a></td>';

            echo '<td><a href="eliminar_proyecto.php?id=' . $row['id_proyecto'] . '" class="delete">Eliminar</a></td>';

            echo "</tr>";
          }
          // close table>

          echo "</table>";
      ?>
    </div>
  </body>
</html>

