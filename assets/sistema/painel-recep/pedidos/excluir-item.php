<?php
require_once("../../../conexao.php");

$id = $_POST['id'];

$query2 = $pdo->query("SELECT * FROM itens_pedido WHERE id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$tipo = $res2[0]['tipo'];
$item = $res2[0]['item'];
$quantidade = $res2[0]['quantidade'];
if ($tipo == 'Produto') {
    $query2 = $pdo->query("SELECT * FROM produtos WHERE id = '$item'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $estoque = $res2[0]['estoque'];
}

// DEVOLVENDO PRODUTO AO ESTOQUE
$novo_estoque = $estoque + $quantidade;
$query = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = '$item'");
$query->bindValue(":estoque", "$novo_estoque");
$query->execute();

$pdo->query("DELETE from itens_pedido WHERE id = '$id'");


echo 'Excluído com Sucesso!';
