<?php

/**
 * Mailer
 * Sends out SECURED Registration link and Infopack
 */
	
	
	define("DB_HOST", "localhost");		// Host Computer or Server
	define("DB_NAME", "team");			// Schema Name
	define("DB_USER", "delegate");		// Username
	define("DB_PASS", ".@database");	// Password

	define("DB_RECRUIT", "fsae");		// Schema Name

	require '../phpmailer/PHPMailerAutoload.php';

	
	
	// BEGIN MAILER
	
	
	$sendto = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_RECRUIT);
	
	// database query, getting all the info of the user
	$sql_send = "SELECT * FROM recruit;";
	//$sql_send = "SELECT * FROM recruit WHERE id='188';";
	$result_of_login_check = $sendto->query($sql_send);

	
	
	// get result row (as an object)
	while($result_row = $result_of_login_check->fetch_object()) {
		// Clear Variables
		$wsufsae_key 		= '';
		$wsufsae_fname 		= '';
		$wsufsae_lname 		= '';
		$wsufsae_sid 		= '';
		$wsufsae_email 		= '';
		$wsufsae_email2 	= '';
		$wsufsae_phone 		= '';
		$wsufsae_infopack	= '';
	
		// write user data into PHP SESSION (a file on your server)
		$wsufsae_key 				= $result_row->id;
			$fullname					= $result_row->name;
			$parts 						= explode(' ', $fullname);
		$wsufsae_fname				= array_shift($parts);
			if (count($parts) > 0) {
		$wsufsae_lname			= join(' ', $parts);
			}
			$check_sid					= $result_row->studentid;
		$wsufsae_sid 				= ('not provided' == $check_sid) ? '' : $check_sid;
			$check_email				= $result_row->email;
			$email_exploded				= explode('@', $check_email);
			$email_domain				= array_pop($email_exploded);
			if ( $email_domain == 'student.westernsydney.edu.au' || $email_domain == 'student.uws.edu.au' ) {
		$wsufsae_email 			= $email_exploded[0] . '@student.westernsydney.edu.au';
			}
			else {
		$wsufsae_email2 		= $check_email;
		$wsufsae_email 			= $wsufsae_sid . '@student.westernsydney.edu.au';
			}
		$wsufsae_phone			= $result_row->phone;
		$wsufsae_infopack		= $result_row->infopack;

		$wsufsae_infopack_url	= "http://www.wsufsae.com/FSAE%202017%20Info%20Pack.pdf";
		$wsufsae_authkey		= "http://www.wsufsae.com/team/register.php?authkey=".$wsufsae_key."&sid=".$check_sid."";
		
		echo '<p>';
		echo 'KEY: ' 			. $wsufsae_key . '<br>';
		echo 'First name: ' 	. $wsufsae_fname . '<br>';
		echo 'Last name: ' 		. $wsufsae_lname . '<br>';
		echo 'Student ID: ' 	. $wsufsae_sid . '<br>';
		echo 'WSU Email: ' 		. $wsufsae_email . '<br>';
		echo 'Other Email: ' 	. $wsufsae_email2 . '<br>';
		echo 'Phone: ' 			. $wsufsae_phone . '<br>';
		echo 'Infopack: ' 		. $wsufsae_infopack . '<br>';
		echo 'Info Pack Link: <a href="'	. $wsufsae_infopack_url . '">Infopack</a><br>';
		echo 'Register Link: <a href="'		. $wsufsae_authkey . '">Register</a><br>';
		echo '</p>';

		
		if( $wsufsae_sid == '17239312' || $wsufsae_lname == 'verma' || $wsufsae_email2 == 'aj.verma3@gmail.com'  ) {
			$excludeInfopack = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_RECRUIT);

			// database query, getting all the info of the user
			$sql_exclude = "UPDATE `fsae`.`recruit` SET `infopack`='2' WHERE `id`='".$wsufsae_key."';";
			$excludeInfopack->query($sql_exclude);

			echo '<p>EXCLUDED: ' . $check_email . '</p>';
			echo '<script>alert("EXCLUDED: '.$check_email.'!");</script>';

		}
		
		
		
		
		if( $wsufsae_infopack == '0' ) {
			$email 		= "westsydfsae@gmail.com";
			$password 	= "fuckscem";
			
			$fromEmail 	= "westsydfsae@gmail.com";
			$fromName 	= "WSU Formula SAE";
			
			$to_id 		= $check_email;
			//$to_id 		= "0433393451@optus.com.au";
			$subject 	= "WSU Formula SAE - 2017 Info Pack and Unique Registration Link";

			$sms  		 = "Hey". $wsufsae_sid .",\n";
			$sms  		.= "The infopack is now ready to download!\n";
			$sms  		.= "Infopack: ".$wsufsae_infopack_url.",\n";
			$sms  		.= "Register: ".$wsufsae_authkey."\n";

			
			$message  = "<html>\n";
			$message .= "<style>\n";
			$message .= "body, p {\n";
			$message .= "font-weight:300;\n";
			$message .= "font-size:1em; line-height:1.2em;\n";
			$message .= "font-family:Verdana,Geneva,sans-serif;\n";
			$message .= "}\n";
			$message .= "a {\n";
			$message .= "word-wrap: break-word;\n";
			$message .= "font-weight:600;\n";
			$message .= "text-decoration:none;\n";
			$message .= "cursor:pointer;\n";
			$message .= "color:#C00;\n";
			$message .= "background-color:#FCC;\n";
			$message .= "padding:0px 10px;\n";
			$message .= "border-radius:5px;\n";
			$message .= "}\n";
			$message .= "a:hover {\n";
			$message .= "color:#FFF;\n";
			$message .= "background-color:#333;\n";
			$message .= "}\n";
			$message .= "</style>\n";
			$message .= "<body bgcolor=\"#cccccc\" topmargin=\"30\">\n";
			$message .= "<center>\n";
			$message .= "<table width=\"800\" border=\"0\" cellpadding=\"0\">\n";
			$message .= "  <tr>\n";
			$message .= "    <td colspan=\"2\" align=\"center\" bgcolor=\"#990000\" style=\"color:#FFF;\" cell>\n";
			$message .= "	<h1><br>Formula SAE 2017 - Info Pack</h1><p></p>\n";
			$message .= "	<p><strong>Student ID: </strong>". $wsufsae_sid ."<br /><strong>Name: </strong>". $wsufsae_fname ." ". $wsufsae_lname ."</p></td>\n";
			$message .= "  </tr>\n";
			$message .= "  <tr>\n";
			$message .= "    <td colspan=\"2\" align=\"center\" bgcolor=\"#FFF\" height=\"200\" style=\"color:#333333;\">\n";
			$message .= "	<img src=\"http://www.wsufsae.com/email.jpg\"/>\n";
			$message .= "	</td>\n";
			$message .= "  </tr>\n";
			$message .= "  <tr height=\"80\">\n";
			$message .= "    <td align=\"center\" bgcolor=\"#FFF\" style=\"color:#333333;\" width=\"30%\">\n";
			$message .= "	<p>2017 Info Pack:</p>\n";
			$message .= "	<p><a href=\"".$wsufsae_infopack_url."\">Download!</a><br />(Filetype: PDF)</p>\n";
			$message .= "	</td>\n";
			$message .= "    <td align=\"center\" bgcolor=\"#FFF\" style=\"color:#333333;\" width=\"70%\">\n";
			$message .= "	<p>Your UNIQUE registration link:</p>\n";
			$message .= "	<p><a href=\"".$wsufsae_authkey."\">".$wsufsae_authkey."</a></p>\n";
			$message .= "	</td>\n";
			$message .= "  </tr>\n";
			$message .= "  <tr height=\"300\">\n";
			$message .= "    <td colspan=\"2\" align=\"left\" bgcolor=\"#EEE\" style=\"color:#333333;padding: 5px 20px;\">\n";
			$message .= "    <p><strong>If you cant click on the link:</strong><br />\n";
			$message .= "	Some email providers remove links, but you can still copy the web address, and paste it into the address bar of your browser.</p>\n";
			$message .= "    <p><strong>Confidential, do not give out your details:</strong><br />\n";
			$message .= "	Your registration link is unique. The information you have access to is highly CONFIDENTIAL.</p>\n";
			$message .= "    <p><strong>Full WH&S Compliance, NO EXCEPTIONS:</strong><br />\n";
			$message .= "	In this project you may have the opportunity to work with some high powered stuff.<br />\n";
			$message .= "	We want the number of 2017 Injuries to be ZERO.<br />\n";
			$message .= "	By registering, you agree to follow ALL Workplace Safety Regulations / WHS Legislation STRICTLY.</p>\n";
			$message .= "    <p><strong>The Team Hub is almost ready:</strong><br />\n";
			$message .= "	The Team Hub is almost ready! Features will be released through March.<br />Some features will be available from March 1st, but more advanced features will be available later.</p>\n";
			$message .= "    </td>\n";
			$message .= "  </tr>\n";
			$message .= "  <tr height=\"120\">\n";
			$message .= "    <td colspan=\"2\" align=\"left\" bgcolor=\"#DDD\" style=\"color:#333333;padding: 5px 20px;\">\n";
			$message .= "    <p><strong>Contact: </strong><a href=\"mailto:17271950@student.westernsydney.edu.au\">\n";
			$message .= "	mailto:17271950@student.westernsydney.edu.au</a> (Link opens email)</p>\n";
			$message .= "    <p><strong>Public Website:</strong><a href=\"http://www.wsufsae.com/\">http://www.wsufsae.com/</a></p>\n";
			$message .= "    <p><strong>The Team Hub:</strong><a href=\"http://www.wsufsae.com/team/\">http://www.wsufsae.com/team/</a></p>\n";
			$message .= "    </td>\n";
			$message .= "  </tr>\n";
			$message .= "</table>\n";
			$message .= "</center>\n";
			$message .= "</body>\n";
			$message .= "</html>\n";			

			
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = $email;
			$mail->Password = $password;
			$mail->setFrom($fromEmail, $fromName);
			$mail->addReplyTo($fromEmail, $fromName);
			$mail->addAddress($to_id);
			$mail->Subject = $subject;
//			$mail->msgHTML($sms);
			$mail->msgHTML($message);

			if (!$mail->send()) {
				$error = "Mailer Error: " . $mail->ErrorInfo;
				?><script>alert('<?php echo $error ?>');</script><?php
			} 
			else {
				$updateInfopack = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_RECRUIT);

				// database query, getting all the info of the user
				$sql_update = "UPDATE `fsae`.`recruit` SET `infopack`='1' WHERE `id`='".$wsufsae_key."';";
				$updateInfopack->query($sql_update);
				
				echo '<p>SENT: ' . $check_email . '</p>';
				//echo '<script>alert("Info Pack sent to '.$check_email.'!");</script>';
			}
		}
	
		
		
	}
	mysqli_close($excludeInfopack);
	mysqli_close($updateInfopack);
	mysqli_close($sendto);

	echo '<hr><p>ALL INFO PACK EMAILS SENT!</p><hr>';
				
?>
				
				
				
				
				
