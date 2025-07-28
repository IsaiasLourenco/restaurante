<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once("../../../conexao.php");

// PHPMailer
require_once "../../src/PHPMailer.php";
require_once "../../src/SMTP.php";
require_once "../../src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$id_usuario = $_SESSION['id'];

try {
    if (!empty($_POST['id_res_email'])) {
        // FLUXO VINDO DE RESERVA POR EMAIL
        $email = $_POST['email'];
        $pessoas = $_POST['pessoas'];
        $data_reser = $_POST['data'];
        $obs = $_POST['mensagem'];

        // Verifica se cliente existe
        $query_cli = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email");
        $query_cli->bindValue(":email", $email);
        $query_cli->execute();
        $res_cli = $query_cli->fetchAll(PDO::FETCH_ASSOC);

        if (count($res_cli) == 0) {
            throw new Exception("Cliente não encontrado!");
        }

        $id_cli = $res_cli[0]['id'];
        $mesa = $_POST['mesa']; // opcional: pode vir do form se quiser
    } else {
        // FLUXO DE RESERVA MANUAL
        $nome = $_POST['nome'];
        $id_cli = $_POST['id_cli'];
        $mesa = $_POST['id_mesa'];
        $pessoas = $_POST['pessoas'];
        $data_reser = $_POST['data-reserva'];
        $obs = $_POST['obs'];

        if ($nome == "") {
            throw new Exception("Selecione um cliente!");
        }

        // Insere reserva manual
        $query = $pdo->prepare("INSERT INTO reservas SET cliente = :id_cli, mesa = :id_mesa, pessoas = :pessoas, obs = :obs, funcionario = :funcionario, data_reser = :data_reser, checkin = 'Não', checkout = 'Não', pedido = 0");
        $query->bindValue(":id_cli", $id_cli);
        $query->bindValue(":id_mesa", $mesa);
        $query->bindValue(":pessoas", $pessoas);
        $query->bindValue(":obs", $obs);
        $query->bindValue(":funcionario", $id_usuario);
        $query->bindValue(":data_reser", $data_reser);
        $query->execute();
    }

    // Consulta cliente
    $query = $pdo->prepare("SELECT * FROM funcionarios WHERE id = :id");
    $query->bindValue(":id", $id_cli);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);

    if (!$res || empty($res['email']) || !filter_var($res['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("E-mail do cliente inválido.");
    }

    $email_cli = $res['email'];
    $nome_cli = $res['nome'];
    $telefone = preg_replace('/[^0-9]/', '', $res['telefone']);
    $telefone = '55' . $telefone; // Adiciona DDI do Brasil

    // Link WhatsApp formatado
    $mensagem = "Olá $nome_cli, sua reserva da mesa " . str_pad($mesa, 3, '0', STR_PAD_LEFT) .
        " foi confirmada para $data_reser. Obrigado por escolher o Lorenzo's Restaurante! 🍕🍕";
    $linkWhatsApp = "https://wa.me/$telefone?text=" . urlencode($mensagem);

    // *** ENVIO DE EMAIL - COMEÇA AQUI ***
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    try {
        $mail->isSMTP();

        // ======== CONFIGURAÇÃO LOCAL (Gmail) ========
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'isaiaslourenco2020@gmail.com';
        $mail->Password = 'owoh cace avmt payd'; // senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('isaiaslourenco2020@gmail.com', 'Isaias');

        // ======== CONFIGURAÇÃO PRODUÇÃO (vetor256.com) ========
        // $mail->Host = 'mail.vetor256.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'isaias@vetor256.com';
        // $mail->Password = 'Mando452269$';
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port = 465;
        // $mail->setFrom('isaias@vetor256.com', "Lorenzo's Restaurante");

        // Comum aos dois
        $mail->addAddress($email_cli, $nome_cli);
        $mail->isHTML(true);
        $mail->Subject = "Confirmação de Reserva - Lorenzo's";
        $mail->Body = "
            <p>Olá <strong>$nome_cli</strong>,</p>
            <p>Sua reserva da mesa <strong>" . str_pad($mesa, 3, '0', STR_PAD_LEFT) . "</strong> foi confirmada para <strong>$data_reser</strong>.</p>
            <p>Observações: $obs</p>
            <p>Obrigado por escolher o Lorenzo's Restaurante! 🍕</p>
        ";
        $mail->send();
    } catch (Exception $e) {
        error_log("Erro ao enviar email: " . $mail->ErrorInfo);
    }
    // *** ENVIO DE EMAIL - TERMINA AQUI ***

    // Resposta JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Reserva feita com sucesso!',
        'whatsapp' => $linkWhatsApp
    ]);
    exit;

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'erro',
        'mensagem' => $e->getMessage()
    ]);
    exit;
}