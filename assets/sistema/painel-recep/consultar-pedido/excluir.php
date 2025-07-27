<?php
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM pedidos WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$comissao = $res[0]['comissao'];
$subtotal = $res[0]['valor'];
$couvert = $res[0]['couvert'];
$novototal = $couvert + $subtotal;

$pdo->query("UPDATE pedidos SET comissao = '0.00', subtotal = '$novototal' WHERE id = '$id'");

echo 'Excluído com Sucesso!';
?>