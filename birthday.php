<?php
require 'libs/PHPMailer-master/src/Exception.php';
require 'libs/PHPMailer-master/src/PHPMailer.php';
require 'libs/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/classes/db.class.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pdo = DB::connect();

// pega aniversariantes de hoje (PostgreSQL)
$sql = "SELECT nome, email 
        FROM clientes 
        WHERE EXTRACT(DAY FROM \"datanasc\") = EXTRACT(DAY FROM CURRENT_DATE) 
        AND EXTRACT(MONTH FROM \"datanasc\") = EXTRACT(MONTH FROM CURRENT_DATE)";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// envia os emails
foreach ($clientes as $cliente) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'keeganluan919@gmail.com';
        $mail->Password = 'qiik ahct ygga qzhv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom('keeganluan919@gmail.com', 'Sistema de Reservas');
        $mail->addAddress($cliente['email'], $cliente['nome']);

        $mail->isHTML(true);
        $mail->Subject = "Feliz Aniversario, Luan Flores!";
        $mail->Body    = "🎉 Olá <b>{$cliente['nome']}</b>, feliz aniversário!<br>Conte conosco e aproveite sua data especial.";

        
        $mail->send();
        $mail->SMTPDebug = 2; // imprime debug no terminal
        $mail->Debugoutput = 'echo';
    } catch (Exception $e) {
        error_log("Erro ao enviar email para {$cliente['email']}: {$mail->ErrorInfo}");
    }
}
