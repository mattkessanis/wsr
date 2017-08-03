<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Table view/selection for database management - Version 2.01
 * <domain>/manage.tables.php
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
	
	// WRITE THE HEAD CODE
	include $internal.'headcode.php';
	
	// BEGIN:	PAGE SPECIFIC DEPENDANCIES
?>
	
<?php
	// END:		PAGE SPECIFIC DEPENDANCIES
	
	// WRITE THE HEAD CODE
	include $internal.'header.php';
	
	// BEGIN:	PAGE SPECIFIC BODY OBJECTS
?>

		<h1>View Tables</h1>

		<?php
			// Interactions
			echo '<p>';
			echo '	<a href="javascript:document.location.reload(true)">Refresh Page</a>';
			echo '</p>';

	    	// display records in a table
			echo '<table class="database" cellpadding="3">';
			echo "\n\t\t" . '<th class="database"> Tables in the Database </th>';
			echo "\n\t\t" . '<th class="database"> Access </th>';

	    	// set table headers
	    	if( $result = $mysqli->query("SHOW TABLES") ) {
	        		
				// Cycle through each column
				while ( $row = $result->fetch_assoc() ) {
					echo "\n\t" . '<tr class="database">';
					echo "\n\t\t" . '<td class="database">' . $row['Tables_in_database'] . '</td>';
					echo "\n\t\t" . '<td class="database"><a href="manage.view-paginated.php?table=' . $row['Tables_in_database'] . '&page=1">Access Database</a></td>';
					echo "\n\t" . '</tr>';
				}
			}
			else {
				// if there are no records in the database, display an alert message
				echo ' [!] ERROR: No results to display. [!] <br>';
			}
			echo '</table>';
		?>

<?php
	// END:		PAGE SPECIFIC BODY OBJECTS
	
	// WRITE THE FOOT CODE
	include $internal.'footcode.php';
?>
