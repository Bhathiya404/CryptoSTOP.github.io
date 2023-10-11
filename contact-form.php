<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$name= $_POST['name'];
$email= $_POST['email'];
$subject= $_POST['subject'];
$comments=$_POST['comments'];

if(isset($name) && isset($email))
{
	global $to_email,$vpb_message_body,$headers;
	$to_email="qasim@devbunch.com";
	$email_subject="Inquiry From Contact Page";
	$vpb_message_body = nl2br("Dear Admin,\n
	The user whose detail is shown below has sent this message from ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	
	name: ".$name."\n
	Email Address: ".$email."\n
	Subject: ".$subject."\n
	Message: ".$comments."\n
	User Ip:".getHostByName(getHostName())."\n
	Thank You!\n\n");
	
	//Set up the email headers
    $headers    = "From: $name <$email>\r\n";
    $headers   .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers   .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n"; 




	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'server71.web-hosting.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'contact@cryptostoplk.com';                     //SMTP username
		$mail->Password   = 'Pv_dOSyV3bVV';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
		//Recipients
		$mail->setFrom('contact@cryptostoplk.com', 'CryptoSTOP');
		$mail->addAddress('contact@cryptostoplk.com', 'CryptoSTOP');     //Add a recipient
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $email_subject;
		$mail->Body    = $vpb_message_body;

	
		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

























	//  if(@mail($to_email, $email_subject, $vpb_message_body, $headers))
	// 	{
	// 		  $status='Success';
	// 		//Displays the success message when email message is sent
	// 		  $output="Congrats ".$name.", your email message has been sent successfully! We will get back to you as soon as possible. Thanks.";
	// 	} 
	// 	else 
	// 	{
	// 		 $status='error';
	// 		 //Displays an error message when email sending fails
	// 		  $output="Sorry, your email could not be sent at the moment. Please try again or contact this website admin to report this error message if the problem persist. Thanks.";
	// 	}		
}
else{

	echo $name;
	$status='error';
	$output="please fill require fields";
	
	}
echo json_encode(array('status'=> $status, 'msg'=>$output));

?>