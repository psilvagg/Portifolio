<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['name'];
$email = $_POST['email'];
$mensagem = $_POST['message'];

if (empty($nome) || empty($email) || empty($mensagem)) {
    echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos.']);
    exit;
}

function enviarEmail($nome, $email, $mensagem)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pedrooosxz@gmail.com'; 
        $mail->Password = 'olla jmbu cezr spme'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('pedrooosxz@gmail.com', 'Contato de ' . $nome);
        $mail->addAddress('pedruuu291@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Mensagem de Contato';

        // Corpo do e-mail em HTML
        $body = "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Nova Mensagem de Contato</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    padding: 20px;
                    color: #333;
                }
                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #007BFF;
                }
                p {
                    line-height: 1.6;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 0.8em;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Nova Mensagem de Contato</h1>
                <p><strong>Nome:</strong> $nome</p>
                <p><strong>E-mail:</strong> $email</p>
                <p><strong>Mensagem:</strong></p>
                <p>$mensagem</p>
            </div>
            <div class='footer'>
                <p>Este é um e-mail gerado automaticamente. Por favor, não responda.</p>
            </div>
        </body>
        </html>";

        $mail->Body = $body;
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Mensagem enviada com sucesso! Assim que possível entraremos em contato!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao enviar: ' . $mail->ErrorInfo]);
    }
}

// Chama a função para enviar o e-mail
enviarEmail($nome, $email, $mensagem);
