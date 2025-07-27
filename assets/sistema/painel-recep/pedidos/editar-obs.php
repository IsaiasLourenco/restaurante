<?php 
require_once("../../../conexao.php");

$obs = $_POST['obs-texto'];
$pedido = $_POST['pedido-obs'];


$query = $pdo->prepare("UPDATE pedidos SET obs = :obs,  obs = :obs WHERE id = '$pedido'");
$query->bindValue(":obs", "$obs");
$query->execute();


echo 'Salvo com Sucesso!';
?>