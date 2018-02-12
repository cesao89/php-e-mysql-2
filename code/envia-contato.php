<?php
require_once("constants.php");

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/Exception.php");
require_once("PHPMailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = EMAIL_ENVIA_CONTATO;                 // SMTP username
    $mail->Password = SENHA_ENVIA_CONTATO;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom(EMAIL_ENVIA_CONTATO, 'Alura Curso PHP e MySQL 2');
    $mail->addAddress(EMAIL_RECEBE_CONTATO);

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email de contato da Loja';
    $mail->Body    = "<html>De: {$nome}<br />Email: {$email}<br/>Mensagem: {$mensagem} </html>";
    $mail->AltBody = "De: {$nome} \n Email: {$email} \n Mensagem: {$mensagem}";

    $mail->send();
    $_SESSION["success"] = "Mensagem enviada com sucesso!";
    header("Location: index.php");
} catch (Exception $e) {
    $_SESSION["danger"] = "Erro ao enviar a mensagem: ". $mail->ErrorInfo;
    header("Location: contato.php");
}
die;