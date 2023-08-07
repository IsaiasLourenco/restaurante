<?php
require_once("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$dataReserva = $_POST['dataReserva'];
$pessoas = $_POST['quantidade'];
$mensagem_reserva = $_POST['mensagem'];

$data = implode('/', array_reverse(explode('-', $dataReserva)));

$destinatario = $email_adm;
$assunto = 'Nova Reserva';
$mensagem = 'Nome: ' . $nome . "\r\n" . "\r\n" . 'Telefone: ' . $telefone . "\r\n" . "\r\n" . 'Email: ' . $email . "\r\n" . "\r\n" . 'Data Reserva: ' . $data . "\r\n" . "\r\n" . 'Nº Pessoas: ' . $pessoas . "\r\n" . "\r\n" . 'Mensagem: ' . $mensagem;
$cabecalhos = "From: " . $email;
@mail($destinatario, $assunto, $mensagem, $cabecalhos);


//SALVAR NA TABELA DE RESERVAS POR EMAIL
$query = $pdo->prepare("INSERT INTO reservas_email SET nome = :nome, email = :email, telefone = :telefone, pessoas = :pessoas, data_reserva = :data_reserva, mensagem = :mensagem, reservado = 'Não'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":pessoas", "$pessoas");
$query->bindValue(":data_reserva", "$dataReserva");
$query->bindValue(":mensagem", "$mensagem_reserva");
$query->execute();

$query2 = $pdo->query("SELECT * FROM clientes WHERE email = '$email'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) == 0){ 
    //SALVAR NA TABELA DE CLIENTES QUEM FEZ A RESERVA
    $query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, email = :email, telefone = :telefone, senha = '0808'");

    $query->bindValue(":nome", "$nome");
    $query->bindValue(":email", "$email");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();
}

?>

<script>
    alert('Enviado com Sucesso.');
</script>

<meta http-equiv="refresh" content="0; url=index.php#mu-reservation">