<?php

	//create a new session
  	include_once('session.php');
  	//connect to database
  	include_once('connection_db.php');

  	$connection = db_connect();

	// check if the 'id' variable is set in URL, and check that it is valid
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {

		// get id value
		$id = $_GET['id'];

		// delete the entry
		$sql = "DELETE FROM `preferencias` WHERE id_preferencia=$id";

		if ($connection->query($sql) === TRUE) {
		    echo "Record deleted successfully";
			header("Location: ver_intereses.php");
		} else {
		    echo "Error deleting record: " . $connection->error;
		}
	}

	else {
		// if id isn't set, or isn't valid, redirect back to view page
		header("Location: ver_intereses.php");
	}

?>