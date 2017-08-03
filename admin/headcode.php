<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * HTML <head> for all views - Version 1.05
 * <domain>/headcode.php
															*/

	// SET UP DYNAMIC REFERENCE
	$internal = realpath(__DIR__).DIRECTORY_SEPARATOR;
	if (dirname($_SERVER['ORIG_PATH_INFO']) == "\\") {
		$external = "http://".$_SERVER['HTTP_HOST']."/";
	}
	else {
		$external = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['ORIG_PATH_INFO'])."/";
	}

	// BEGIN:	PAGE SPECIFIC DEPENDANCIES
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="expires" content="-1">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>WSU Grammatical Changes Database</title>

        <link href="<?php echo $external; ?>database.css" rel="stylesheet">
		<script src="<?php echo $external; ?>jquery.min.js" type="text/javascript"></script>

