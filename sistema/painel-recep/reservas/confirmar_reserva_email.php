<?php
session_start();
$id_usuario = $_SESSION['id']; // ID do funcionário logado

require_once("../../../conexao.php");

$id_res_email = $_POST['id_res_email'] ?? null;
if (!$id_res_email) {
    echo "ID da reserva não informado.";
    exit();
}

// Pega dados da reserva_email
$query_res_email = $pdo->prepare("SELECT * FROM reservas_email WHERE id = :id");
$query_res_email->bindValue(":id", $id_res_email);
$query_res_email->execute();
$reserva_email = $query_res_email->fetch(PDO::FETCH_ASSOC);

if (!$reserva_email) {
    echo "Reserva não encontrada.";
    exit();
}

$data_reserva = $reserva_email['data_reserva'];
$email_cliente = $reserva_email['email'];

// Pega o id do cliente (funcionario) pelo email
$query_cliente = $pdo->prepare("SELECT id FROM funcionarios WHERE email = :email");
$query_cliente->bindValue(":email", $email_cliente);
$query_cliente->execute();
$cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    echo "Cliente não encontrado na base de funcionários.";
    exit();
}

$id_cliente = $cliente['id'];

// Pega mesas já ocupadas na data da reserva
$query_mesas_ocupadas = $pdo->prepare("SELECT mesa FROM reservas WHERE data_reser = :data");
$query_mesas_ocupadas->bindValue(":data", $data_reserva);
$query_mesas_ocupadas->execute();
$mesas_ocupadas = $query_mesas_ocupadas->fetchAll(PDO::FETCH_COLUMN);

// Pega todas as mesas cadastradas
$query_todas_mesas = $pdo->query("SELECT id FROM mesas");
$todas_mesas = $query_todas_mesas->fetchAll(PDO::FETCH_COLUMN);

// Encontra uma mesa disponível
$mesa_disponivel = null;
foreach ($todas_mesas as $mesa_id) {
    if (!in_array($mesa_id, $mesas_ocupadas)) {
        $mesa_disponivel = $mesa_id;
        break;
    }
}

if (is_null($mesa_disponivel)) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Nenhuma mesa disponível. Deseja outra data?'
    ]);
    exit();
}

// Insere a reserva na tabela reservas
$query_insert = $pdo->prepare("INSERT INTO reservas 
    (cliente, mesa, pessoas, obs, funcionario, data_reser, checkin, checkout, pedido) 
    VALUES 
    (:cliente, :mesa, :pessoas, :obs, :funcionario, :data_reser, 'Não', 'Não', 0)");

$query_insert->bindValue(":cliente", $id_cliente);
$query_insert->bindValue(":mesa", $mesa_disponivel);
$query_insert->bindValue(":pessoas", $reserva_email['pessoas']);
$query_insert->bindValue(":obs", $reserva_email['mensagem']);
$query_insert->bindValue(":funcionario", $id_usuario);
$query_insert->bindValue(":data_reser", $data_reserva);

$query_insert->execute();

// Atualiza a reserva_email para "reservado = 'Sim'"
$query_update = $pdo->prepare("UPDATE reservas_email SET reservado = 'Sim' WHERE id = :id");
$query_update->bindValue(":id", $id_res_email);
$query_update->execute();

// Montar o link do WhatsApp
$telefone = preg_replace('/[^0-9]/', '', $reserva_email['telefone']);
$telefone = '55' . $telefone; // Brasil DDI
$mensagemZap = "Olá " . $reserva_email['nome'] . ", sua reserva para " . $data_reserva . " foi confirmada! Obrigado por escolher o Lorenzo's Restaurante! 🍕";
$linkWhatsApp = "https://wa.me/$telefone?text=" . urlencode($mensagemZap);

header('Content-Type: application/json');
echo json_encode([
    'status' => 'sucesso',
    'mensagem' => 'Reserva confirmada!',
    'whatsapp' => $linkWhatsApp
]);
exit;
