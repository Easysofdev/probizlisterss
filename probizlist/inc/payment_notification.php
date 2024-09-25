<?php
if(isset($_POST["pay_ref"]) && !empty($_POST["pay_ref"])){
$email = $_POST["email"];
$pay_ref = $_POST["pay_ref"];
$username = $_POST["username"];
$business = $_POST["business"];
$amount = $_POST["amount"];
		
$to      = 'abicom.ng@gmail.com'; // Send email to our user
$subject = 'Probizlist Payment Notification'; // Give the email a subject 
$message = '
Hi ProbizList Admin,

A user with the details below just made a payment for his/her registered business verictaion.

Username: '.$username.'
Email: '.$email.'
Business Name: '.$business.'
Amount: '.$amount.'
Mode of Payment: Paystack
Date: '.date("Y-m-d h:i:s").'
Payment Reference No: '.$pay_ref.'

Admin
ProbizList.com
 
'; // Our message above including the link
					 
$headers = 'From: ProbizList <noreply@probizlist.com>' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
header("Location: ../index.php?status=Success!<br />Check your email for steps to follow.");

echo 200;
}

?>