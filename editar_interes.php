<?php
	//create a new session
  	include_once('session.php');
  	//connect to database
  	include_once('connection_db.php');

	// creates the edit record form

	// since this form is used multiple times in this file, I have made it a function that is easily reusable
	function renderForm($id, $intereses_personales, $hobbies, $error) {

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
	      <li><a href="ver_informacion.php">Ver Información Proyectos</a></li>
	      <li><a href="crear_profesor.php">Añadir Profesor</a></li>
	      <li><a href="crear_interes.php">Añadir Interes Personal</a></li>
	      <li><a class="active" href="crear_interes.php">Editar Interes Personal</a></li>
	      <li><a href="logout.php">Cerrar Sesión</a></li>
	    </ul>
		<?php

			// if there are any errors, display them
			if ($error != '') {
				echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
			}
		?>
		<div id="elemento">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>"/>

				<div>
					<p><strong>ID:</strong> <?php echo $id; ?></p>
					<label for="pname">Interes personal</label>
	        		<input type="text" name="intereses_personales" value="<?php echo $intereses_personales; ?>"/><br/>

	        		<label for="cname">Hobbies</label>
	        		<input type="text" name="hobbies" value="<?php echo $hobbies; ?>"/><br/>

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

			$intereses_personales = mysql_real_escape_string(htmlspecialchars($_POST['intereses_personales']));

			$hobbies = mysql_real_escape_string(htmlspecialchars($_POST['hobbies']));

			// check that nombre_proyecto/id_curso fields are both filled in
			if ($intereses_personales == '' || $hobbies == '') {
				// generate error message
				$error = 'ERROR: Por favor llene todos los campos!';

				//error, display form
				renderForm($id, $intereses_personales, $hobbies, $error);
			} else {
				// save the data to the database

				$sql = "UPDATE `preferencias` SET `intereses_personales`= '$intereses_personales',`hobbies`= '$hobbies' WHERE `id_preferencia` ='$id'";

				if ($connection->query($sql) === TRUE) {
				    echo "Record updated successfully";
				    // once saved, redirect back to the view page
					header("Location: administrador.php");
				} else {
				    echo "Error updating record: " . $connection->error;
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
			$sql = "SELECT * FROM `preferencias` WHERE id_preferencia = '$id'";
          	$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_array($result);

			// check that the 'id' matches up with a row in the databse

			if($row) {
				// get data from db

				$intereses_personales = $row['intereses_personales'];

				$hobbies = $row['hobbies'];
				
				// show form
				renderForm($id, $intereses_personales, $hobbies, '');
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