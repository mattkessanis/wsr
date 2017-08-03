<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Header and Nav for all views - Version 1.04
 * <domain>/header.php
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
	</head>
	<body>
		<header>
			<table border="0">
				<tr>
					<td style="padding:0 0 0 0; vertical-align:middle; cursor:pointer" onclick="document.location.href='<?php echo $external; ?>index.php';">
						<img src="<?php echo $external; ?>images/WesternSydneyLogo.png">
					</td>
					<td style="padding-left:20px; padding-right:20px; vertical-align:text-bottom; cursor:pointer" onclick="document.location.href='<?php echo $external; ?>index.php';">
						<font color="#000000" style="letter-spacing:-1px; font-size:20px">
							<strong>Grammatical Changes Database</strong>
						</font>
					</td>
					<td style="padding-left:20px; padding-right:0px; vertical-align:text-bottom">
						<a href="<?php echo $external; ?>index.php">			Search</a>
						<a href="<?php echo $external; ?>import.index.php">		Import Data</a>
						<a href="<?php echo $external; ?>manage.index.php">		Manage Data</a>
						<a href="<?php echo $external; ?>dev.progress.php">		Database Progress</a>
<!-- RETIRED			<a href="<?php echo $external; ?>dev.diagram.php">		Flow Diagram</a>		//-->
						<a href="<?php echo $external; ?>dev.server.php">		Server</a>
						<a href="<?php echo $external; ?>dev.phpinfo.php">		PHP Info</a>
					</td>
				</tr>
			</table>
			<hr>
			<br>
		</header>