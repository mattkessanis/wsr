<!DOCTYPE html>
<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Admin Utility</title>
		<script src="jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/manage.css">
		<!--[if lt IE 9]><script src="html5shiv.min.js"></script><![endif]-->
	</head>
	
	<body align="center">
		<div class="middle">

			
<?php
 
	define("DB_HOST", "localhost");		// Host Computer or Server
	define("DB_USER", "delegate");		// Username
	define("DB_PASS", ".@database");	// Password
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS) or die("Unable to Connect");

	$list = array();
	
	if (isset($_GET['table'])) {
		// do timestamp
		echo "Timestamp";
	}
	else if (isset($_GET['schema'])) {
		// list tables
		$list[]	= 'table';
		$d			= $_GET['schema'];
		$query		= "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$d."'";
		$d			= $d.'.';
	}
	else {
		$list[]	= 'schema';
		$d			= $_GET['schema'];
		$query		= "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA";
	}
	
	$listhead		= array_shift($list);

	while ($row_result = $conn->query($query)) {
		$list[]	= 'schema';
		
	}
	print_r($row_result);

	// DISPLAY RECORDS IN A TABLE
	echo "\n\t".'<table class="table dir">';
	echo "\n\t".'<thead class="table-head"><tr><th>Choose '.$listhead.': </th></tr></thead>';
	echo "\n\t".'<tbody class="table-body">';
/* 	foreach ($list as $key => $item)) {
		
			echo "\n\t".'<tr><td>';
			echo "\n\t".'<a href="tools.timestamp.php?'.$listhead.'='.$d.$item.'">'.$item.'</a>';
			echo "\n\t".'</td></tr>';
		
	} */
	echo "\n\t".'</table>';
	echo "\n\t"."<br>".date('[Y m d G:i:s]');	
	
	$conn->close();


?>

		</div>
		
	</body>
</html>








