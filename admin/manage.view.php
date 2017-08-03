<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Entire view for database management - Version 2.03
 * <domain>/manage.view.php
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
		<script src="<?php echo $external; ?>manage.edit.js" type="text/javascript"></script>

<?php
	// END:		PAGE SPECIFIC DEPENDANCIES
	
	// WRITE THE HEAD CODE
	include $internal.'header.php';
	
	// BEGIN:	PAGE SPECIFIC BODY OBJECTS
?>

		<h1>View Records (All)</h1>

		<?php
			if ( isset($_GET['table']) ) {
				$activetable = $_GET['table'];
			}
			else {
				header('location:manage.tables.php');
			}
		
			// ACTIONS
			echo "\n\t\t" . '<p>';
			if ( $activetable != 'languages' ) {
				$newRow		= "";

				$lastrow = $mysqli->query("SELECT `id` FROM `database`.`" . $activetable . "` ORDER BY `id` DESC LIMIT 1");
				if ($lastrow) {
						$fetchrow = $lastrow->fetch_row();
						$newRow = $fetchrow[0] + 1;
						echo "\n\t\t\t" . '<a href="#" onClick="addRow(\'' . $newRow . '\');">Add New Record</a>';
				}
				else {
					echo "ERROR: Could not prepare SQL statement, to fetch row.";
				}
				$lastrow->close();
			}
			echo "\n\t\t\t" . '<a href="javascript:document.location.reload(true)">Refresh Page</a>';
			echo "\n\t\t\t" . '<a href="manage.view-paginated.php?table=' . $activetable . '&page=1">View Paginated</a> ';
			echo "\n\t\t\t" . '<a href="manage.view.php?table=' . $activetable . '">View All</a> ';
			echo "\n\t\t" . '</p>';
			
			// DISPLAY RECORDS IN A TABLE
			echo "\n\n\n\t\t";
			echo '<table id="EditTable" class="database" cellpadding="3">';
			echo "\n\t\t\t" . '<thead>';

			// SET TABLE HEADERS
			if( $result = $mysqli->query("SHOW COLUMNS FROM " . $activetable) ) {
				echo "\n\t\t\t" . '<tr class="database">';
				if ($result->num_rows != 0) {
					$column_count = $result->num_rows;
				}

				// CYCLE THROUGH EACH COLUMN
				while( $row = $result->fetch_row() ) {
					echo "\n\t\t\t\t" . '<th class="database">' . $row[0] . '</th>';
				}
				
				// CLOSE OFF TABLE HEADERS
				if ( $activetable != 'languages' ) {
					echo "\n\t\t\t\t"   . '<th class="mod"> INSERT </th>';		// Insert
					echo "\n\t\t\t\t"   . '<th class="mod"> DELETE </th>';		// Delete
				}
				echo "\n\t\t\t"     . '</tr>';
				echo "\n\t\t\t" . '</thead>';
				echo "\n\n\t"     . '';
			}

		// PAGINATED-SPECIFIC SECTION BEGIN[!]

			// NUMBER OF RESULTS DISPLAYED PER PAGE
			$per_page = 10000;
	
			// TOTAL NUMBER OF RESULTS
			if ($result = $mysqli->query("SELECT * FROM "  . $activetable . " ORDER BY id")) {
				if ($result->num_rows != 0) {
					$total_results = $result->num_rows;
			
					// ceil() ROUNDS UP THE NUMBER OF PAGES (SO REMAINDER <$per_page IS NOT EXCLUDED)
					$total_pages = ceil($total_results / $per_page);
	
					// CONFIRM 'page' VARIABLE IS SET IN THE URL (EXAMPLE: view-paginated.php?page=1)
					if (isset($_GET['page']) && is_numeric($_GET['page'])) {
						$show_page = $_GET['page'];
			
						// CONFIRM $show_page VALUE IS VALID
						if ($show_page > 0 && $show_page <= $total_pages) {
							$start 	= ($show_page -1) * $per_page;
							$end 	= $start + $per_page;
						}
						
						// $show_page IS NOT VALID: SHOW FIRST PAGE
						else {
							$start 	= 0;
							$end 	= $per_page;
						}
					}
					
					// NO PAGE SET: SHOW FIRST PAGE
					else {
						$start 	= 0;
						$end 	= $per_page;
					}
	
					// DISPLAY PAGINATION
					if ($total_pages >> 1) {
						for ($i = 1; $i <= $total_pages; $i++) {
							if (($i%10) == 1) {
								echo "\n\t\t\t<span class=\"nobr\">&nbsp;&nbsp;";
							}
							echo "\n\t\t\t\t";
							if (isset($_GET['page']) && $_GET['page'] == $i) {
								echo '<a class="thispage" href="manage.view-paginated.php?table=' . $activetable . '&page=' . $i . '">' . $i . '</a> ';
							}
							else {
								echo '<a class="pagenum" href="manage.view-paginated.php?table=' . $activetable . '&page=' . $i . '">' . $i . '</a> ';
							}
							if (($i%10) == 0) {
								echo "\n\t\t\t</span>\n";
							}
						}
					}
					echo "\n\t\t\t</span>";
					echo "</p>\n\n";
					$fields = array();	
					echo "\n\t\t\t" . '<tbody id="EditTbody">';
					
					// LOOP THROUGH QUERY RESULTS TO DISPLAY IN A TABLE
					for ($i = $start; $i < $end; $i++) {

						// BREAK IF TRYING TO SHOW RESULTS WHICH DO NOT EXIST
						if ($i == $total_results) { 
							break;
						}
			
						// RETREIVE SPECIFIC ROW
						$result->data_seek($i);
						$row = $result->fetch_row();
						while ($fieldinfo=mysqli_fetch_field($result)) {
							$fields[] = $fieldinfo->name;
						}
						
						// ECHO EACH ROW INTO THE TABLE
						if (empty($row[1]) && empty($row[2])) {
							// IF A NEW/EMPTY ROW
							echo "\n\t\t\t"     . '<tr id="' . $row[0] . '" class="rowhighlight">';
						}
						else {
							echo "\n\t\t\t"     . '<tr id="' . $row[0] . '" class="">';
						}

						// LOOP UNTIL ALL COLUMNS HAVE BEEN RETREIVED (ADAPTS TO ANY DATABASE TABLE)
						for ($c = 0; $c < $column_count; $c++) {
							if ( $c == $column_count ) {
								break;
							}
							echo "\n\t\t\t\t";

							// IF ACTIVETABLE IS 'languages': REMOVE THE EDIT FUNCTION
							if ( $activetable == 'languages' ) {
								echo '<td class="database">' . $row[$c] . '</td>';						
							}

							// ELSE: INCLUDE EDIT FUNCTION
							else {						

								// IF FIELD IS ID / PRIMARY KEY: REMOVE THE EDIT FUNCTION
								if ( $fields[$c] == 'id' ) {
									echo '<td class="database">' . $row[$c] . '</td>';
								}

								// IF FIELD IS LIMITED TO OPTIONS: EDIT FUNCTION USES CHECKBOXES
								else if ( $fields[$c] == 'ChangeType' || $fields[$c] == 'Domain' || $fields[$c] == 'EvidenceType' ) {
									$ops = explode('@', $row[$c]);
									echo '<td id="' . $row[0] . '.' . $fields[$c] . '" raw="' . $ops[0] . '" class="database" onClick="showOptions(this)">' . $ops[1] . '</td>';
								}
			
								// IF FIELD IS LIMITED TO 1 OPTION: EDIT FUNCTION USES RADIOS
								else if ( $fields[$c] == 'Certainty' ) {
									echo '<td id="' . $row[0] . '.' . $fields[$c] . '" class="database" onClick="showCertaintyBtns(this);">' . $row[$c] . '</td>';
								}
								
								// FIELD IS NOT LIMITED: EDIT FUNCTION USES TEXT INPUT
								else {
									echo '<td id="' . $row[0] . '.' . $fields[$c] . '" class="database" onClick="addInput(this)">' . $row[$c] . '</td>';
								}
							}
						}

					// PAGINATED-SPECIFIC SECTION END[!]

						// Add INSERT and DELETE button
						if ( $activetable != 'languages' ) {
							echo "\n\t\t\t\t";
							echo '<td class="database"><a style="" href="#" onClick="addRow(\'' . $row[0] . '\')">Insert</a></td>';
							
							echo "\n\t\t\t\t";
							echo '<td class="database"><a style="" href="#" onClick="deleteRow(\'' . $row[0] . '\')">Delete</a></td>';
						}
						echo "\n\t\t\t"     . '</tr>';
					}
					echo "\n\t\t\t" . '</tbody>';

					// CLOSE THE TABLE
					echo "\n\t\t"     . "</table>";
				}
				else {
					echo "No results to display!";
				}
			}

			// IF THE QUERY RETURNS AN ERROR
			else {
				echo "Error: " . $mysqli->error;
			}
			
			echo "<p align='center'><b>New and Empty Rows are <span style='background-color:#ffe6ec;'>HIGHLIGHTED<span></b></p><br>";
		?>

<?php
	// END:		PAGE SPECIFIC BODY OBJECTS
	
	// WRITE THE FOOT CODE
	include $internal.'footcode.php';
?>
