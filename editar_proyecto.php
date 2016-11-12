<?php
	//create a new session
  	include_once('session.php');
  	//connect to database
  	include_once('connection_db.php');

	// creates the edit record form

	// since this form is used multiple times in this file, I have made it a function that is easily reusable
	function renderForm($id, $nombre_proyecto, $id_curso, $descripcion, $tipo_proyecto, $tecnologia_usada, $duracion, $imagen, $error) {

		$connection = db_connect();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit Record</title>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="styles/estilo_general.css">
		<link rel="stylesheet" type="text/css" href="styles/estilo_administrador.css">
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
	      <li><a href="logout.php">Cerrar Sesión</a></li>
	    </ul>
		<?php

			// if there are any errors, display them
			if ($error != '') {
				echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
			}
		?>
		<div style="margin-left:18%;padding:1px 16px;height:1000px;">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>"/>

				<div>
					<p><strong>ID:</strong> <?php echo $id; ?></p>
					<label for="pname">Nombre del Proyecto</label>
	        		<input type="text" name="nombre_proyecto" value="<?php echo $nombre_proyecto; ?>"/><br/>

	        		<label for="cname">Curso</label>
	        		<input type="text" name="id_curso" value="<?php echo $id_curso; ?>"/><br/>
			        
	        		<label for="cname">Descripción</label>
	        		<textarea name="descripcion"><?php echo $descripcion; ?></textarea><br>

	        		<label for="cname">Tipo Proyecto</label>
	        		<input type="text" name="tipo_proyecto" value="<?php echo $tipo_proyecto; ?>"/><br/>


	        		<label for="cname">Tecnología Usada</label>
	        		<input type="text" name="tecnologia_usada" value="<?php echo $tecnologia_usada; ?>"/><br/>

	        		<label for="cname">Duración</label>
	        		<input type="text" name="duracion" value="<?php echo $duracion; ?>"/><br/>

	        		<label for="cname">Imagen</label>
	        		<input type="text" name="imagen" value="<?php echo $imagen; ?>"/><br/>

					<input type="submit" class="button" name="submit" value="Modificar">
				</div>
			</form>
		</div>
	</body>
</html>

<?php

}
	// check if the form has been submitted. If it has, process the form and save it to the database
	if (isset($_POST['submit'])) {
		// confirm that the 'id' value is a valid integer before getting the form data
		if (is_numeric($_POST['id'])) {
			// get form data, making sure it is valid
			$id = $_POST['id'];

			$nombre_proyecto = mysql_real_escape_string(htmlspecialchars($_POST['nombre_proyecto']));

			$id_curso = mysql_real_escape_string(htmlspecialchars($_POST['id_curso']));

			$descripcion = mysql_real_escape_string(htmlspecialchars($_POST['descripcion']));

			$tipo_proyecto = mysql_real_escape_string(htmlspecialchars($_POST['tipo_proyecto']));

			$tecnologia_usada = mysql_real_escape_string(htmlspecialchars($_POST['tecnologia_usada']));

			$duracion = mysql_real_escape_string(htmlspecialchars($_POST['duracion']));

			$imagen = mysql_real_escape_string(htmlspecialchars($_POST['imagen']));

			// check that firstname/lastname fields are both filled in
			if ($nombre_proyecto == '' || $id_curso == '') {
				// generate error message
				$error = 'ERROR: Por favor llene todos los campos!';

				//error, display form
				renderForm($id, $nombre_proyecto, $id_curso, $descripcion, $tipo_proyecto, $tecnologia_usada, $duracion, $imagen, $error);
			} else {
				// save the data to the database

				$sql = "UPDATE `proyecto` SET `nombre_proyecto`= '$nombre_proyecto',`id_curso`= '$id_curso',`descripcion`= '$descripcion',`tipo_proyecto`= '$tipo_proyecto',`tecnología_usada`='$tecnologia_usada',`duración`='$duracion',`imagen`='$imagen' WHERE id_proyecto='$id'";

				if ($connection->query($sql) === TRUE) {
				    echo "Record updated successfully";
				    // once saved, redirect back to the view page
					header("Location: ver_informacion.php");
				} else {
				    echo "Error updating record: " . $conn->error;
				}
			}
		} else {
			// if the 'id' isn't valid, display an error
			echo 'Error!';
		}
	} else {
		// if the form hasn't been submitted, get the data from the db and display the form

		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

		if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
			// query db
			$id = $_GET['id'];
			$sql = "SELECT * FROM `proyecto` WHERE id_proyecto = '$id'";
          	$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_array($result);

			// check that the 'id' matches up with a row in the databse

			if($row) {
				// get data from db

				$nombre_proyecto = $row['nombre_proyecto'];

				$id_curso = $row['id_curso'];

				$descripcion = $row['descripcion'];

				$tipo_proyecto = $row['tipo_proyecto'];

				$tecnologia_usada = $row['tecnología_usada'];

				$duracion = $row['duración'];

				$imagen = $row['imagen'];
				
				// show form
				renderForm($id, $nombre_proyecto, $id_curso, $descripcion, $tipo_proyecto, $tecnologia_usada, $duracion, $imagen, '');
			} else {
				// if no match, display result
				echo "No existe resultados!";
			}
		} else {
			// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
			echo 'Error!';
		}
	}
?>