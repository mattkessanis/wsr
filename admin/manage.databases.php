<?php
	// SET DEFAULT TIMEZONE (Redundant without session)
	date_default_timezone_set("Australia/Sydney");

	// DATABASE ACCESS
	$dbhost = 'localhost';
	$dbuser = 'delegate';
	$dbpass = '.@database';
	$dbname = 'database';

	// PREPARE THE QUERY
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
		//echo "Attempting Connection!<br>";		// DEBUG ONLY

	if (mysqli_connect_errno()) {
		printf("Connect failed : %s\n", mysqli_connect_error());
		exit();
	} else {
		//echo "CONNECTED!<br>";					// DEBUG ONLY
	}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/manage.css">
		<!--[if lt IE 9]><script src="html5shiv.min.js"></script><![endif]-->
	</head>
	<body align="center">
		<div class="db-list">
			<table class="table">
				<thead class="table-head">
					<tr>
						<th>Available Schemas</th>
					</tr>
				</thead>
				<tbody class="table-body">
			<?php
			// Database List
	    	if( $result = $mysqli->query("SHOW DATABASES") ) {
//	    	if( $result = $mysqli->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA") ) {

				while ( $row = $result->fetch_assoc() ) {
					//print_r($row);
					echo "\n\t\t\t\t";
					echo '<tr onclick="window.document.location=\'manage.tables.php?schema='.$row['Database'].'\';">';
					
					echo "\n\t\t\t\t\t";
					echo '<td>';
					
					echo "\n\t\t\t\t\t";
					echo $row['Database'];
					
					echo "\n\t\t\t\t\t";
					echo '</td>';
					
					echo "\n\t\t\t\t";
					echo '</tr>';
				}
			}
			else {
				// if there are no records in the database, display an alert message
				echo ' [!] ERROR: No results to display. [!] <br>';
			}
			
			// CLOSE DATABASE CONNECTION
			$mysqli->close();
			
			?>
				</tbody>
			</table>
		</div>
	</body>
</html>

