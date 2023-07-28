<?php
require_once("../../../conexao.php");
@session_start();
// Jogar valores dos campos da modal clientes em variáveis
$nome = $_POST['nome'];
$id_cli = $_POST['id_cli'];
$id_mesa = $_POST['id_mesa'];
$pessoas = $_POST['pessoas'];
$data_reser = $_POST['data-reserva'];
$obs = $_POST['obs'];
//Fim Jogar valores dos campos da modal clientes em variáveis

//Pegar usuário que está online
$id_usuario = $_SESSION['id'];

// Se não colocou nenhum cliente, pede para colocar
if ($nome == "") {
	echo $id_cli,'Selecione um cliente!';
	exit();
}
//Fim Se não colocou nenhum cliente, pede para colocar

// INSERE NO BANCO DE DADOS
$query = $pdo->prepare("INSERT INTO reservas SET cliente = :id_cli, mesa = :id_mesa, pessoas = :pessoas, obs = :obs, funcionario = :funcionario, data_reser = :data_reser");

// ATUALIZA PAGANDO TODAS AS VARIÁVEIS E GRAVA NO BANCO DE DADOS
$query->bindValue(":id_cli", "$id_cli");
$query->bindValue(":id_mesa", "$id_mesa");
$query->bindValue(":pessoas", "$pessoas");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");
$query->bindValue(":data_reser", "$data_reser");
$query->execute();

//SEPARA NOME E EMAIL PARA ENVIAR NOTIFICAÇÃO DE RESERVA POR EMAIL PARA O CLIENTE
$query = $pdo->query("SELECT * FROM clientes WHERE id = '$id_cli '");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_cliente = $res[0]['email'];
$nome_cliente = $res[0]['nome'];

$dataF = implode('/', array_reverse(explode('-', $data_reser)));

//Enviar email confirmando a reserva
$destinatario = $email_cliente;
$assunto = $nome_site . ' - Confirmação de Reserva';
    $mensagem = utf8_decode('Olá' . $nome_cliente . ', sua reserva foi confirmada para a data' . $dataF . "\r\n"."\r\n" . 'Observações: ' . $obs . '!');

    $cabecalhos = "From: ".$email_adm;
    @mail($destinatario, $assunto, $mensagem, $cabecalhos);

echo 'Salvo com Sucesso!';

?>