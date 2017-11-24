<?php

include_once "../vendor/autoload.php";

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

$url = 'https://api.sendgrid.com/';
$user = 'azure_db87aad1714e1e890f6044ea96fc1c61@azure.com';
$pass = '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'; 

$sendgrid = new SendGrid($pass);
$email = new SendGrid\Email();
$email
    ->addTo('jfrye1@twc.com')
    ->setFrom('noreply@metrounitedsecurity.com')
    ->setFromName('Metro United Security Customer Inquiry')
    ->setSubject("Website Contact Form:  $name")
    ->setText("You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message")
;

$sendgrid->send($email);

// Or catch the error

try {
    $sendgrid->send($email);
} catch(\SendGrid\Exception $e) {
    echo $e->getCode();
    foreach($e->getErrors() as $er) {
        echo $er;
    }
}

		
?>