<?php
require_once("../../../conexao.php");
@session_start();

if (@$_POST['id_res_email'] != "") {
    $id_reserva_email = $_POST['id_res_email'];
    $email = $_POST['email'];
    $pessoas = $_POST['pessoas'];
    $data_reser = $_POST['data'];
    $obs = $_POST['mensagem'];

    $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $id_cli = $res[0]['id'];

    $mesa = "";

    $query = $pdo->query("SELECT * FROM mesas ORDER BY id DESC");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < @count($res); $i++) {
        foreach ($res[$i] as $key => $value) {
        }
        $id_mesa = $res[$i]['id'];
        $nome_mesa = $res[$i]['nome'];

        $query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$id_mesa' AND data_reser = '$data_reser'");  
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        if (@count($res2) == 0) {
            $mesa = $id_mesa;
            //ATUALIZA O PEDIDO DE RESERVA VINDO DO EMAIL PARA RESERVADA
            $query2 = $pdo->query("UPDATE reservas_email SET reservado = 'Sim' WHERE id = '$id_reserva_email'");
        } else {
            
        }
    }
} else {

    $nome = $_POST['nome'];
    $id_cli = $_POST['id_cli'];
    $mesa = $_POST['id_mesa'];
    $pessoas = $_POST['pessoas'];
    $data_reser = $_POST['data-reserva'];
    $obs = $_POST['obs'];

    if ($nome == "") {
        echo $id_cli, 'Selecione um cliente!';
        exit();
    }
}

if ($mesa == "") {
    echo 'Não existem mesas disponíveis para essa data! Quer escolher outra data?';
    
    exit();   
}


$id_usuario = $_SESSION['id'];

$query = $pdo->prepare("INSERT INTO reservas SET cliente = :id_cli, mesa = :id_mesa, pessoas = :pessoas, obs = :obs, funcionario = :funcionario, data_reser = :data_reser, checkin = 'Não', checkout = 'Não'");


$query->bindValue(":id_cli", "$id_cli");
$query->bindValue(":id_mesa", "$mesa");
$query->bindValue(":pessoas", "$pessoas");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");
$query->bindValue(":data_reser", "$data_reser");
$query->execute();


$query = $pdo->query("SELECT * FROM clientes WHERE funcionario = '$id_cli' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
@$id_cli_func = $res[0]['id'];

$queryF = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_cli_func' ");
$resF = $queryF->fetchAll(PDO::FETCH_ASSOC);
@$nome_cliente = $resF[0]['nome'];

$data_reser = implode('/', array_reverse(explode('-', $data_reser)));


@$destinatario = $email_cliente;
$assunto = $nome_site . utf8_decode(' - Confirmação de Reserva');
$conteudo = utf8_decode('Olá ' . $nome_cliente . ', sua reserva foi confirmada para a data ' . $data_reser . "\r\n" . "\r\n" . 'Observações: ' . $obs . '!');

$cabecalhos = "From: " . $email_adm;
@mail($destinatario, $assunto, $conteudo, $cabecalhos);

echo 'Salvo com Sucesso!';

?>