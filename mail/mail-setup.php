<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);





function validate($data)
{ // Input fields validator to avoid XSS and SQL Injection
  $data = trim($data); // remove extra white space(s)
  $data = stripslashes($data); // remove forward and back slashes
  $data = htmlspecialchars($data); // remove special characters
  return $data;
}

$email_setup = json_decode(trim(file_get_contents("php://input")));



try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
  $mail->isSMTP(); //Send using SMTP
  $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
  $mail->SMTPAuth = true; //Enable SMTP authentication
  $mail->Username = 'arsyspssdo2022@gmail.com'; //SMTP username
  $mail->Password = 'sminvqxcnfmfopvg'; //SMTP password
  $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
  $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  //Recipients
  $mail->setFrom($email_setup->email, 'Wrapitup');
  $mail->addAddress($email_setup->email, 'New User'); //Add a recipient
  // $mail->addAddress('ellen@example.com');               //Name is optional
  $mail->addReplyTo($email_setup->email, 'I am tester');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  //Attachments
 // $mail->addAttachment('../assets/image/wrapitup-logo.jpg'); //Add attachments


  //Content
  $mail->isHTML(true); //Set email format to HTML
  $mail->Subject = 'This is your code';
  // $mail->AddEmbeddedImage("../assets/image/wrapitup-logo.jpg", "my-attach", "wrapitup-logo.png");
  $mail->Body = $email_setup->htmlSrc;
  $mail->AltBody = 'This is altbody';

  $mail->send();

  $msg = array('message' => 'Message sent');
  json_encode($msg);

} catch (Exception $e) {

  $msg = array('message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
  json_encode($msg);
}