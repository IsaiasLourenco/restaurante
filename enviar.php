<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/sistema/src/PHPMailer.php';
require_once __DIR__ . '/sistema/src/SMTP.php';
require_once __DIR__ . '/sistema/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'link' => ''];

try {
    $nome = $_POST['nome_reserva'];
    $email = $_POST['email_reserva'];
    $telefone = $_POST['telefone_reserva'];
    $quantidade = $_POST['quantidade_reserva'];
    $data = $_POST['dataReserva'];
    $mensagem_usuario = $_POST['mensagem_reserva'];

    $data_formatada = date('d/m/Y', strtotime($data));
    $assunto = "$nome_site - Confirmação de Reserva";
    $corpo_email = "Olá $nome,\r\n\r\n" . 
                   "Recebemos sua solicitação de reserva com os dados abaixo:\r\n\r\n" . 
                   "Telefone: $telefone\r\n" . 
                   "Quantidade de pessoas: $quantidade\r\n" . 
                   "Data da reserva: $data_formatada\r\n\r\n" . 
                   "Mensagem enviada: $mensagem_usuario\r\n\r\n";

    // Enviar email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'mail.vetor256.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'isaias@vetor256.com';
    $mail->Password   = 'Mando452269$';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom($email_site, $nome_site);
    $mail->addReplyTo($email_site);
    $mail->addAddress($email, $nome);
    $mail->isHTML(false);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $assunto;
    $mail->Body    = $corpo_email;
    $mail->send();

    // Salvar no banco
    $query = $pdo->prepare("INSERT INTO reservas_email SET  
        nome = :nome, 
        email = :email,
        telefone = :telefone,
        pessoas = :pessoas,
        data_reserva = :data_reserva,
        mensagem = :mensagem,
        reservado = 'Não',
        reserva = 0");
    $query->bindValue(":nome", $nome);
    $query->bindValue(":email", $email);
    $query->bindValue(":telefone", $telefone);
    $query->bindValue(":pessoas", $quantidade);
    $query->bindValue(":data_reserva", $data);
    $query->bindValue(":mensagem", $mensagem_usuario);
    $query->execute();

    try {
        // Verificar se o cliente já existe
        $query_func = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email");
        $query_func->bindValue(":email", $email);
        $query_func->execute();
        $res_func = $query_func->fetchAll(PDO::FETCH_ASSOC);

        // Se o funcionário não existir, insere novo funcionário e cliente
        if (count($res_func) == 0) {

            $insert_func = $pdo->prepare("INSERT INTO funcionarios (nome, email, telefone) VALUES (:nome, :email, :telefone)");
            $insert_func->bindValue(":nome", $nome);
            $insert_func->bindValue(":email", $email);
            $insert_func->bindValue(":telefone", $telefone);
            $insert_func->execute();

            $id_funcionario = $pdo->lastInsertId();

            $insert_cli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:id_funcionario, :comentario)");
            $insert_cli->bindValue(":id_funcionario", $id_funcionario);
            $insert_cli->bindValue(":comentario", $mensagem_usuario);
            $insert_cli->execute();
        } 
    } catch (PDOException $e) {
        error_log("Erro na inserção de funcionário/cliente: " . $e->getMessage());
    }


    // Link WhatsApp
    $telefone_limpo = preg_replace('/[^0-9]/', '', $telefone);
    $mensagem_whatsapp = "Olá $nome, recebemos sua solicitação de reserva no $nome_site:\n" .
                         "📞 Telefone: $telefone\n" .
                         "👥 Pessoas: $quantidade\n" .
                         "📅 Data: $data_formatada\n" .
                         "📝 Mensagem: $mensagem_usuario\n\n";

    $link_whatsapp = "https://wa.me/55$telefone_limpo?text=" . urlencode($mensagem_whatsapp);

    // Resposta de sucesso
    $response['success'] = true;
    $response['link'] = $link_whatsapp;

} catch (Exception $e) {
    $response['message'] = "Erro ao processar a reserva: " . $e->getMessage();
}

echo json_encode($response);
exit;
?>