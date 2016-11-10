<?php 
  include_once('session.php');
  include_once ('connection_db.php'); 

  $connection = db_connect();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/estilo_bandejaentrada.css">
    <link rel="stylesheet" type="text/css" href="styles/estilo_general.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  </head>
  <body>
    <ul>
      <br>
      <div align="center"> 
        <div class="avatar">
        </div><br>
      </div>
      <li><a class="active" href="bandeja_entrada.php">Bandeja de Entrada</a></li>
      <li><a href="administrador.php">Portafolio de Proyectos</a></li>
      <li><a href="edit_infopersonal.php">Información personal</a></li>
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>

    <div style="margin-left:18%;padding:1px 16px;height:1000px;">
      <h1>Administrador - Víctor Saborío Hernández</h1>
          <br>
          <table align="center" class="demo">
              <caption>Bandeja de Entrada</caption>
              <tr>
              <th>Nombre</th>
              <th>Apellido</th> 
              <th>Correo Electrónico</th>
              <th>Tipo Consulta</th>
              <th>¿Desea que lo llamen?</th>
              <th>Teléfono</th>
              <th>Consulta</th>
            </tr>
            <?php 
              $sql = "SELECT nombre_contacto, apellido_contacto, email, tipo_consulta, llamar_telefono, telefono_contacto, consulta FROM `contacto`";
              $result = mysqli_query($connection, $sql);


              if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                    foreach($row as $key=>$value) {
                      echo '<td>',$value,'</td>';
                    }
                    echo '</tr>';
                  }
              } else {
                  echo "0 results";
              }
            ?>
          </table>
    </div>
  </body>
</html>

