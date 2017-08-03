<?php

	// ACCESS THE SERVER
	include 'config_noconnect.php';

	// PARAMETERS:
	// table, row, col, newvalue
	if ( isset($_POST['table'], $_POST['row'], $_POST['col'], $_POST['newvalue'] )) {
		if ( is_numeric( $_POST['row'] ) ) {
			$table 		= $_POST['table'];
			$row 		= $_POST['row'];
			$col 		= $_POST['col'];
			$newvalue 	= $_POST['newvalue'];
			$oldvalue	= $_POST['oldvalue'];
			$timestamp 	= date('[Y m d G:i:s]');

			if ($table == '' || $row == '' || $col == '') {
				$error = 'ERROR: Please fill in all required fields!';
			}
			else {
				$historyfile = "manage.history.txt";
				$handle = fopen($historyfile, 'a') or die("Cannot open file:  ".$historyfile);
				$data = "\nMODIFIED\t".$table."\t".$row."\t".$col."\t".$timestamp."\nOLD:\t".$oldvalue."\nNEW:\t".$newvalue."\n";
				fwrite($handle, $data);
				fclose($handle);
			
				if ($stmt = $mysqli->prepare("UPDATE " . $table . " SET `" . $col . "` = ? WHERE ID=?")) {
					$stmt->bind_param("si", $newvalue, $row);
					$stmt->execute();
				}
				else {
					//echo "ERROR: Could not prepare SQL statement. NEW RECORD.";
				}
			}
		}
		else {
			//echo "Error! Key is not a number!";
		}
	}
	else {
		//echo "Error! Arguments not set!";
	}
?>





