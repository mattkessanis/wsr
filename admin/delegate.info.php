<?php
	if ( isset($_POST['database'], $_POST['table'])) {
		$database 	= $_POST['database'];
		$table 		= $_POST['table'];
		
		// ACCESS THE SERVER
		include 'config_noconnect.php';

		echo "\n\t\t\t<p>Showing table info of: <u>" . $database . "." . $table . "</u><br></p>";

		// DISPLAY RECORDS IN A TABLE
		echo "\n\t\t\t"		.'<table class="table records">';
		echo "\n\t\t\t\t"		.'<thead class="table-head">';
		echo "\n\t\t\t\t\t"			.'<tr>';
		
		// GET COLUMNS
		$query_connection	= new mysqli(DB_HOST, DB_USER, DB_PASS) or die("Unable to Connect to '$dbhost'");
		$query				= "SHOW COLUMNS FROM ".$database.".".$table."";

		if($result = $query_connection->query($query)) {
			

				foreach($result->fetch_assoc() as $c => $f) {
					echo "\n\t\t\t\t\t\t";
					echo '<th>'.$c.'</th>';
				}
		
			
		}
		$query_connection->close();
		
		// END TABLE HEADER
		echo "\n\t\t\t\t\t"			.'</tr>';
		echo "\n\t\t\t\t"		.'</thead>';
		
		// START TABLE BODY
		echo "\n\t\t\t\t"		.'<tbody class="table-body">';

		// GET ROWS
		$query_connection	= new mysqli(DB_HOST, DB_USER, DB_PASS) or die("Unable to Connect to '$dbhost'");
		$query				= "SHOW COLUMNS FROM ".$database.".".$table."";

		if($result = $query_connection->query($query)) {
			while ($rows = $result->fetch_assoc()) {
				echo "\n\t\t\t\t\t"			.'<tr>';
				
				foreach($rows as $att => $dat) {
					echo "\n\t\t\t\t\t\t";
					echo '<td>'.$dat.'</td>';
				}
				
				echo "\n\t\t\t\t\t"			.'</tr>';
			}
		}
		$query_connection->close();

		// END TABLE BODY
		echo "\n\t\t\t\t"		.'</tbody>';

		// END TABLE
		echo "\n\t\t\t"		.'</table>';


	}

?>
