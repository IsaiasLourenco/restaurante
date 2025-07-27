<?php
require_once("../../../conexao.php");
require_once("../../../config.php");

$obs = $_POST['obs-texto'];
$pedido = $_POST['obs-pedido'];

$query = $pdo->prepare("UPDATE pedidos SET obs = :obs WHERE id = '$pedido'");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso!';
