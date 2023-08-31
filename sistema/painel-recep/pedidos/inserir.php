<?php 
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];
$mesa = $_POST['id_mesa'];
$obs = $_POST['obs'];
$garcom = $_POST['garcom'];

$query = $pdo->prepare("INSERT INTO pedidos SET mesa = :mesa,  obs = :obs, funcionario = :funcionario, data_pedido = curDate(), garcom = :garcom, status_pedido = 'Aberta', comissao = '$comissao', couvert = '$couvert', pago = 'Não'");

$query->bindValue(":garcom", "$garcom");
$query->bindValue(":mesa", "$mesa");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");
$query->execute();
$id_ult_ped = $pdo->lastInsertId();

$query1 = $pdo->prepare("UPDATE reservas SET checkin = 'Sim', pedido = '$id_ult_ped' WHERE mesa = '$mesa'");
$query1->execute();

echo 'Salvo com Sucesso!';
?>