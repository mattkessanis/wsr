<?php

	// ACCESS THE SERVER
	include 'config_noconnect.php';

	function substrwords($text, $maxchar, $end='...') {
		if (strlen($text) > $maxchar) {
			$output = substr($text, 0, ($maxchar - 3)) . $end;
		}
		else {
			$output = $text;
		}
    return $output;
	}

?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Admin Utility</title>
		<script src="jquery.min.js" type="text/javascript"></script>
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/manage.css">
		<link rel="stylesheet" href="css/CollapsibleLists.css">
		<!--[if lt IE 9]><script src="html5shiv.min.js"></script><![endif]-->
		<script type="text/javascript" src="CollapsibleLists.js"></script>
		<script type="text/javascript">
			function doFetch(database, table) {
				$.post( "delegate.fetch.php", {database:database, table:table}, function(data){
					$("#records").html(data);
					});
			};
			function doInfo(database, table) {
				$.post( "delegate.info.php", {database:database, table:table}, function(data){
					$("#records").html(data);
					});
			};
			function doTime(database, table) {
				alert('Timestamp disabled!');
				//$.post( "delegate.timestamp.php", {database:database, table:table}, function(data){
				//	$("#records").html(data);
				//	});
			};
			//runOnLoad(function(){ CollapsibleLists.apply(); });

        </script>
		
		<link rel="apple-touch-icon" sizes="57x57" href="fav/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="fav/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="fav/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="fav/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="fav/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="fav/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="fav/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="fav/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="fav/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="fav/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="fav/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
		<link rel="manifest" href="fav/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="fav/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		
	</head>
	<body align="center" onLoad="CollapsibleLists.apply();">
		<div class="left">
			<table class="table dir">
				<thead class="table-head">
					<tr>
						<th>Available Schemas</th>
					</tr>
				</thead>
				<tbody class="table-body">
					<tr>
						<td>

<?php

$count_schemas 	= 0;
$count_tables 	= 0;


echo "\n\t".'<ul class="treeView">';
echo "\n\t\t".'<li>MySQL Database';
echo "\n\t\t\t".'<ul class="collapsibleList">';

// PREPARE THE QUERY
$query_schemas_connection 	= new mysqli(DB_HOST, DB_USER, DB_PASS) or die("Unable to Connect to 'DB_HOST'");
$query_schemas 				= "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA";

if($result_schemas = $query_schemas_connection->query($query_schemas)) {
	$count_schemas = $result_schemas->num_rows;
	//echo '<p>Number of Schemas: '.$count_schemas.'</p>';
	
	$d 				= '';
	$i_schemas 		= 0;
	while ($row_schemas = $result_schemas->fetch_assoc()) {
		$d = $row_schemas['SCHEMA_NAME'];
	
		$i_schemas++;
		if ($i_schemas == $count_schemas) {
			echo "\n\t\t\t\t".'<li class="lastChild">'.substrwords($d,18);
			echo "\n\t\t\t\t\t".'<ul>';
		}
		else {
			echo "\n\t\t\t\t".'<li>'.substrwords($d,18);
			echo "\n\t\t\t\t\t".'<ul>';
		}
		
		$query_tables_connection = new mysqli(DB_HOST, DB_USER, DB_PASS) or die("Unable to Connect to '$dbhost'");
		$query_tables 			 = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$d."'";
		
		if($result_tables = $query_tables_connection->query($query_tables)) {
			$count_tables = $result_tables->num_rows;

			$i_tables 		= 0;
			while ($row_tables = $result_tables->fetch_assoc()) {
				$t = $row_tables['TABLE_NAME'];

				$i_tables++;
				if ($i_tables == $count_tables) {
					echo "\n\t\t\t\t\t\t".'<li class="lastChild"><span onClick="doFetch(\''.$d.'\', \''.$t.'\')">'.substrwords($t,18).'</span><i class="fa fa-info-circle" onClick="doInfo(\''.$d.'\', \''.$t.'\')"></i><i class="fa fa-clock-o" onClick="doTime(\''.$d.'\', \''.$t.'\')"></i></li>';
				}
				else {
					echo "\n\t\t\t\t\t\t".'<li><span onClick="doFetch(\''.$d.'\', \''.$t.'\')">'.substrwords($t,18).'</span><i class="fa fa-info-circle" onClick="doInfo(\''.$d.'\', \''.$t.'\')"></i><i class="fa fa-clock-o" onClick="doTime(\''.$d.'\', \''.$t.'\')"></i></li>';
				}

			}
			echo "\n\t\t\t\t\t".'</ul>';
			echo "\n\t\t\t\t".'</li>';

		} else { echo ' [!] ERROR: No TABLES to display. [!] <br>'; }

	}
	echo "\n\t\t\t".'</ul>';
	echo "\n\t\t".'</li>';
	echo "\n\t".'</ul>';

} else { echo ' [!] ERROR: No SCHEMAS to display. [!] <br>'; }
$query_tables_connection->close();
$query_schemas_connection->close();

?>

						</td>
					</tr>
					
					<tr> <td> <?php echo "<center>" . date('[Y m d G:i:s]') . "</center>"; ?> </td> </tr>
					
					<tr>
						<td> 
						<!--<i class="fa fa-cc-amex"></i>
						<i class="fa fa-certificate"></i>
						<i class="fa fa-desktop"></i>
						<i class="fa fa-delicious"></i> //-->
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div id="records" class="right">
		</div>
	</body>
</html>

