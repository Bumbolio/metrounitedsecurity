<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

/*
$smtpServer = "smtp.sendgrid.net";
$smtpUserName = "azure_db87aad1714e1e890f6044ea96fc1c61@azure.com";
$smtpPassword = "bPi1ytnabYfx";

// Create the email and send the message
$to = 'ernestocodes@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@metrounitedsecurity.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;	
*/


 $url = 'https://api.sendgrid.com/';
 $user = 'azure_db87aad1714e1e890f6044ea96fc1c61@azure.com';
 $pass = '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'; 

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $to,
      'subject' => "Website Contact Form:  $name",
      'html' => "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message",
      'text' => "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message",
      'from' => 'noreply@metrounitedsecurity.com',
   );

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);



		
?>