<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once('vendor/autoload.php');

if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["oms"])) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'alexvanrooij.nl';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@alexvanrooij.nl';
        $mail->Password   = '0409-DerpAlex!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = '465';

        $mail->addAddress($_POST["email"]);
        $mail->setFrom('Contact@alexvanrooij.nl', 'Contact');
        $mail->addCC('giovanni.pedro.2004@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $_POST["oms"];
        $mail->Body    = 'temp';
        $mail->AltBody = 'temp';

        $mail->send();
        
        $log = new Logger('info');
        $log->pushHandler(new StreamHandler('info.log', Level::Info));
        $log->info("'NAAM: ".$_POST["name"] ."' 'EMAIL: ".$_POST["email"] ."' 'BERICHT: ".$_POST["oms"]."'");

        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="name">
    <input type="email" name="email" placeholder="email">
    <input type="text" name="oms" placeholder="message">
    <button type="submit">verzenden</button>
</form>
