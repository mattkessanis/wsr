<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Record creation agent for database management - Version 1.02
 * <domain>/manage.newrecord.php
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
	

	// PARAMETERS:
	// table, row
	if ( isset($_POST['table'], $_POST['row'])) {
		echo "<p>" . "Table and Row are set" . "</p>";

		if ( is_numeric( $_POST['row'] ) ) {
			echo "<p>" . "Row is numeric" . "</p>";
			$table 		= $_POST['table'];
			$row 		= $_POST['row'];
			$timestamp 	= date('[Y m d G:i:s]');

			if ($table == '' || $row == '') {
				echo "<p>" . "ERROR: Table or Row unknown!" . "</p>";
			}
			else {
				echo "<p>" . "Write to text file" . "</p>";

				$historyfile = 'manage.history.txt';
				$handle = fopen($historyfile, 'a') or die('Cannot open file:  '.$historyfile);
				$data = "\nNEW_RECORD\t".$table."\t".$row."\t".$timestamp."\n";
				fwrite($handle, $data);
				fclose($handle);

				// Insert row at row X: increment all rows from row X by +1
				if ($stmt = $mysqli->prepare("UPDATE `database`.`" . $table . "` SET `id` = id+1 WHERE ID>=" . $row . " order by id desc")) {
					$stmt->execute();
				}
				else {
					echo "ERROR: Could not prepare SQL statement, to shift all records down.";
				}
				$stmt->close();


				// Insert row at row X: insert new empty record at row X
				if ($stmt2 = $mysqli->prepare("INSERT INTO `database`.`" . $table . "` (`id`) VALUES ('" . $row . "')")) {
					$stmt2->execute();

					echo "SUCCESS: INSERT THE NEW RECORD.";
				}
				else {
					echo "ERROR: Could not prepare SQL statement. INSERT THE NEW RECORD.";
				}
				$stmt2->close();



			}
		}
		else if ( $_POST['row'] == 'append' ) {
			echo "<p>" . "APPEND" . "</p>";
			$table 		= $_POST['table'];
			$timestamp 	= date('[Y m d G:i:s]');
			$newRow		= "";
			
			// Insert row at end: determine last row id
			if ($result = $mysqli->query("SELECT `id` FROM `database`.`" . $table . "` ORDER BY `id` DESC LIMIT 1")) {
				if ($fetchrow = $result->fetch_row()) {
					echo "<p>Row fetched: " . $fetchrow[0] . "</p>";
					$newRow = $fetchrow[0] + 1;
					echo "<p>New Row At : " . $newRow . "</p>";
				}
				else {
					echo "ERROR: Could not prepare SQL statement, to fetch row.";
				}
			}
			else {
				echo "ERROR: Could not prepare SQL statement, to get last row id.";
			}
			$result->close();
			
			echo "<p>" . "New Row ID resolved" . "</p>";
			
			
			if ($table == '' || $newRow == '') {
				echo "<p>" . "ERROR: Table or Row unknown!" . "</p>";
			}
			else {
				echo "<p>" . "Write to text file" . "</p>";
				
				$historyfile = 'manage.history.txt';
				$handle = fopen($historyfile, 'a') or die('Cannot open file:  '.$historyfile);
				$data = "\nNEW_RECORD\t".$table."\t".$newRow."\t".$timestamp."\n";
				fwrite($handle, $data);
				fclose($handle);

				// Insert row at row X: insert new empty record at row X
				if ($stmt = $mysqli->prepare("INSERT INTO `database`.`" . $table . "` (`id`) VALUES ('" . $newRow . "')")) {
					$stmt->execute();
				}
				else {
					//echo "ERROR: Could not prepare SQL statement. INSERT THE NEW RECORD.";
				}
				$stmt->close();
			}
		}
		else {
			//echo "Error! Row key is invalid!";
		}
	}
	else {
		//echo "Error! Arguments not set!";
	}
?>






