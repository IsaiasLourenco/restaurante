<?php 
require_once("../../../conexao.php");
$produto = $_POST['id'];
$quantidade = $_POST['quant'];
$pedido = $_POST['pedido'];
$mesa = $_POST['mesa'];

if($quantidade <= 0){
    exit();
}

$query2 = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$valor = $res2[0]['valor_venda'];
$total = $valor * $quantidade;

$query = $pdo->prepare("INSERT INTO itens_pedido SET pedido = :pedido,  item = :item, tipo = 'Produto', valor = :valor, quantidade = :quantidade, total = :total, mesa = :mesa, status_item = 'Pronto'");


$query->bindValue(":pedido", "$pedido");
$query->bindValue(":item", "$produto");
$query->bindValue(":valor", "$valor");
$query->bindValue(":quantidade", "$quantidade");
$query->bindValue(":total", "$total");
$query->bindValue(":mesa", "$mesa");

$query->execute();


echo 'Salvo com Sucesso!';
