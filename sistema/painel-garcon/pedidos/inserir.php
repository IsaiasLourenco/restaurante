<?php
require_once("../../../conexao.php");
@session_start();

$mesa = $_POST['id_mesa'];
$obs = $_POST['obs'];
$garcon = $_POST['garcon'];
$cpf_usuario = $_SESSION['cpf'];
$query = $pdo->query("SELECT * FROM funcionarios where cpf = '$cpf_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_funcionario = $res[0]['id'];

$query = $pdo->prepare("INSERT INTO pedidos SET mesa = :mesa, obs = :obs, funcionario = :funcionario, data_ped = curDate(), garcon = :garcon, comissao = '$comissao', couvert = '$couvert', pago = 'Não'");


$query->bindValue(":garcon", "$garcon");
$query->bindValue(":mesa", "$mesa");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_funcionario");

$query->execute();


echo 'Salvo com Sucesso!';
?>