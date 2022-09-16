<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('vendor/autoload.php');

if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["oms"])) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'codebygio.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@codebygio.com';
        $mail->Password   = 'x';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->addAddress($_POST["email"]);
        $mail->setFrom('info@codebygio.com', 'Contact');
        $mail->addCC('giovanni.pedro.2004@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $_POST["oms"];
        $mail->Body    = 'temp';
        $mail->AltBody = 'temp';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="text" name="oms">
    <button type="submit">
</form>