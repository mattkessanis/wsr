<?php
															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Initialize Directories (RUN ONCE) - Version 2.01
 * <domain>/init.php
															*/


//	$dirname = dirname($_SERVER['REQUEST_URI']);
//	$dirname = '/' ? '' : dirname($_SERVER['REQUEST_URI']);


	if (dirname($_SERVER['ORIG_PATH_INFO']) == "\\") {
		$internal = realpath(__DIR__).DIRECTORY_SEPARATOR;
		$external = "http://".$_SERVER['HTTP_HOST']."/";
	}
	else {
		$internal = realpath(__DIR__).DIRECTORY_SEPARATOR;
		$external = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['ORIG_PATH_INFO'])."/";
	}

	echo $internal."<br><br><br><br>";
	echo $external."<br><br><br><br>";
	
	
	
	// Used by 3
	$full_path = $_SERVER['HTTP_HOST'].dirname($_SERVER['ORIG_PATH_INFO']);


	// Used by 3
	function r_dirname($path, $count=1){
		if ($count > 1){
			return dirname(r_dirname($path, --$count));
		}
		else{
			return dirname($path);
		}
	}
	
	// Used by 5 & 6
	$path = parse_url($full_path, PHP_URL_PATH);


	
	echo "<p>1. ". $_SERVER['REQUEST_URI'] ."</p>";
	echo "<p>2. ". dirname(__FILE__) ."</p>";
	echo "<p>3. ". r_dirname($full_path) ."</p>";
	echo "<p>4. ". "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['ORIG_PATH_INFO']) ."</p>";
	echo "<p>5. ". $_SERVER['DOCUMENT_ROOT'] . $path ."</p>";
	echo "<p>6. ". $_SERVER['DOCUMENT_ROOT'] . dirname($path) ."</p>";





															
															
/* 	$int 	= realpath(__DIR__).DIRECTORY_SEPARATOR;
	$int2 	= __DIR__.DIRECTORY_SEPARATOR;
	$ext 	= 'http://'.$_SERVER['HTTP_HOST'].'/';
	$home 	= dirname(__FILE__);
	$ext2 = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
	$ext3 = 'http://'.$_SERVER['DOCUMENT_ROOT'].'/';

	
	
	
	echo "<p>". $int ."</p>";
	echo "<p>". $int2 ."</p>";
	echo "<p>". $ext ."</p>";
	echo "<p>". $home ."</p>";
	echo "<p>". $ext2 ."</p>";
	echo "<p>". $ext3 ."</p>"; */
	
	

//	$text = "Anything";
//	$var_str = var_export($text, true);
/*	$var = '<?php\n\n\$text = $var_str;\n\n?>';*/
//	file_put_contents('filename.php', $var);




//	include 'filename.php';
//	echo $text;


?>

<br><br><br><br><br>
<?=$base_url?>