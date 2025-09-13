<?php
require 'libs/PHPMailer-master/src/Exception.php';
require 'libs/PHPMailer-master/src/PHPMailer.php';
require 'libs/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // DEBUG
    $mail->Debugoutput = 'echo';
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'keeganluan919@gmail.com';
    $mail->Password   = 'qiik ahct ygga qzhv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('keeganluan919@gmail.com', 'Teste');
    $mail->addAddress('luanfdev@gmail.com', 'Você');

    $mail->isHTML(true);
    $mail->Subject = "Teste de envio";
    $mail->Body    = "Olá, teste funcionando!";

    $mail->send();
    echo "Email enviado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao enviar email: {$mail->ErrorInfo}";
}
