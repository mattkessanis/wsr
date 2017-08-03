<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Record deletion agent for database management - Version 3.08
 * <domain>/manage.delete.php
															*/

	// SET UP DYNAMIC REFERENCE
	$internal = realpath(__DIR__).DIRECTORY_SEPARATOR;
	if (dirname($_SERVER['ORIG_PATH_INFO']) == "\\") {
		$external = "http://".$_SERVER['HTTP_HOST']."/";
	}
	else {
		$external = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['ORIG_PATH_INFO'])."/";
	}

	// ACCESS THE SERVER
	include $internal.'config.php';

	// confirm that the 'id' variable has been set
	if ( isset($_POST['table'], $_POST['row']) && is_numeric($_POST['row']) ) {

		// get the 'id' variable from the URL
		$id 	= $_POST['row'];
		$table 	= $_POST['table'];
		$timestamp 	= date('[Y m d G:i:s]');

		$historyfile = 'manage.history.txt';
		$handle = fopen($historyfile, 'a') or die('Cannot open file:  '.$historyfile);
		$data = "\nDELETED\t".$table."\t".$id."\t".$timestamp."\n";
		fwrite($handle, $data);
		fclose($handle);
					
		// delete record from database
		if ($stmt = $mysqli->prepare("DELETE FROM " . $table . " WHERE ID = ? LIMIT 1") ) {
			$stmt->bind_param("i",$id);
			$stmt->execute();
			$stmt->close();
		}

		else {
			echo "ERROR: could not prepare SQL statement.";
		}
		
		$mysqli->close();

		// redirect user after delete is successful
		//header("Location: manage.view.php");

	}

	else {
		// if the 'id' variable isn't set, redirect the user
		//header("Location: manage.view.php");
	}

?>