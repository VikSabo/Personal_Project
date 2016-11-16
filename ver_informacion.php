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
        <img src="http://www.itaimich.org.mx/images/ver.png" alt="logo" />
        <h1>Información de Proyectos</h1>
    </div><br><br>
	<?php

		//create a new session
	  	include_once('session.php');
	  	//connect to database
	  	include_once('connection_db.php');
		$start=0;
		$limit=4;

		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$start=($id-1)*$limit;
		}
		else{
			$id=1;
		}
		//Fetch from database first 10 items which is its limit. For that when page open you can see first 10 items. 
		$query = mysqli_query($connection,"select * from `proyecto` LIMIT $start, $limit");

	?>
	<table border='1' cellpadding='10'>
  		<tr>
          <th>ID</th>
          <th>Nombre Proyecto</th>
          <th>Descripción</th> 
          <th>Tipo Proyecto</th>
          <th>Tecnología Usada</th>
          <th>Duración</th>
          <th>Imagen</th>
        </tr>
	<?php
		//print 10 items
		while($result = mysqli_fetch_array($query))
		{
			echo "<tr>";

	        echo '<td>' . $result['id_proyecto'] . '</td>';

	        echo '<td>' . $result['nombre_proyecto'] . '</td>';

	        echo '<td>' . $result['descripcion'] . '</td>';

	        echo '<td>' . $result['tipo_proyecto'] . '</td>';

	        echo '<td>' . $result['tecnología_usada'] . '</td>';

	        echo '<td>' . $result['duración'] . '</td>';

	        echo '<td>' . $result['imagen'] . '</td>';

	        echo '<td><a href="editar_proyecto.php?id=' . $result['id_proyecto'] . '">Editar</a></td>';

	        echo '<td><a href="eliminar_proyecto.php?id=' . $result['id_proyecto'] . '" class="delete">Eliminar</a></td>';

	        echo "</tr>";
		}
	?>
	</table>
	<div class="pagination clearfix">
	<?php
		//fetch all the data from database.
		$rows = mysqli_num_rows(mysqli_query($connection,"select * from `proyecto`"));
		//calculate total page number for the given table in the database 
		$total=ceil($rows/$limit);
		if($id>1)
		{
			//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
			echo "<a href='?id=".($id-1)."'>Anterior</a>";
			//echo "<a href='?id=".($id-1)."' class='button'>Anterior</a>";
		}
		if($id!=$total)
		{
			////Go to previous page to show next 10 items.
			echo "<a href='?id=".($id+1)."'>Siguiente</a>";
			//echo "<a href='?id=".($id+1)."' class='button'>Siguiente</a>";
		}
	?>
	<?php
	//show all the page link with page number. When click on these numbers go to particular page. 
			for($i=1;$i<=$total;$i++)
			{
				if($i==$id) { 
					echo "<a href='#'>".$i."</a>"; 
				}
				else { 
					echo "<a href='?id=".$i."'>".$i."</a>"; 
				}
			}
	?>
	</div>
</div>
</body>
</html>