<!DOCTYPE html>
<html>
<head>
	<title>coba email</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<h1 class="alert alert-danger">password</h1>
</body>
</html>
<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ackermannaomy@gmail.com';                 // SMTP username
$mail->Password = 'kode200216';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

// $mail->From = 'AdminDeveloper@gmail.com';
$mail->FromName = 'Admin Developer';
$mail->addAddress('rmatuszahro@gmail.com', 'User');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('ackermannaomy@gmail.com', 'Admin');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'AdminDeveloper';
$mail->Body    = '<center><p>Password Berhasi Diganti</p><br><a href="www.google.com"><h1 class="alert alert-danger">password</h1></a></center>';
$mail->AltBody = 'bisa This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<h1 class="alert alert-success">Password berhasil dikirim silahkan cek diemail anda</h1><br>
    	 <a target="_blank" href="http://www.gmail.com">cek email</a>';
}