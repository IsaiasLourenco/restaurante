<?php
require_once("conexao.php");

header('Content-Type: application/json');

try {
    $nome = $_POST['nome_reserva'];
    $email = $_POST['email_reserva'];
    $telefone = preg_replace('/\D/', '', $_POST['telefone_reserva']); // apenas números
    $dataReserva = $_POST['dataReserva'];
    $pessoas = $_POST['quantidade_reserva'];
    $mensagem_reserva = $_POST['mensagem_reserva'];

    $data_formatada = implode('/', array_reverse(explode('-', $dataReserva)));

    // Enviar Email (simplificado ou PHPMailer, se desejar)
    $assunto = $nome_site . ' Nova Reserva ';
    $conteudo = "Nome: $nome\nTelefone: $telefone\nEmail: $email\nData Reserva: $data_formatada\nPessoas: $pessoas\nMensagem: $mensagem_reserva";
    $headers = "From: $email";

    @mail($email_adm, $assunto, $conteudo, $headers);

    // Salvar no banco de dados
    $query = $pdo->prepare("INSERT INTO reservas_email SET nome = :nome, email = :email, telefone = :telefone, pessoas = :pessoas, data_reserva = :data_reserva, mensagem = :mensagem, reservado = 'Não'");
    $query->bindParam(":nome", $nome);
    $query->bindParam(":email", $email);
    $query->bindParam(":telefone", $telefone);
    $query->bindParam(":pessoas", $pessoas);
    $query->bindParam(":data_reserva", $dataReserva);
    $query->bindParam(":mensagem", $mensagem_reserva);
    $query->execute();

    // Link para o WhatsApp (com formatação e %0A para quebra de linha)
    $mensagem = "Olá $nome, o Lorenzo's recebeu seu pedido de reserva e em breve entraremos em contato confirmando data, horário e número da mesa.%0A%0AMuito obrigado.";
    $linkWhatsapp = "https://api.whatsapp.com/send?phone=55$telefone&text=" . urlencode($mensagem);

    echo json_encode([
        'success' => true,
        'link' => $linkWhatsapp
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao processar a reserva. Tente novamente.'
    ]);
}
