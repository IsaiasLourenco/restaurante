<?php
require_once("../../../conexao.php");
require_once("../../../config.php");
$produto = $_POST['id'];
$quant = $_POST['quant'];
$pedido = $_POST['pedido'];
$mesa = $_POST['mesa'];
$tipo = $_POST['tipo'];

if ($quant <= 0) {
    exit();
}

if ($tipo == 'Produto') {
    $queryprod = $pdo->query("SELECT * FROM produtos WHERE id = '$produto'");
    $resprod = $queryprod->fetchAll(PDO::FETCH_ASSOC);
    $valor = $resprod[0]['valor_venda'];
    $estoque = $resprod[0]['estoque'];
    $nome_prod = $resprod[0]['nome'];
    $status_ped = 'Pronto';

    // VERIFICA NÍVEL DO ESTOQUE
    if($quant > $estoque){
        echo 'Estoque insuficiente! Existem apenas ' . $estoque . ' ' . $nome_prod . ' em estoque, favor emitir ordem de compra para esse produto URGENTEMENTE!';
        exit();
    }

    // ABATIMENTO NO ESTOQUE
    $novo_estoque = $estoque - $quant;
    $query = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = '$produto'");
    $query->bindValue(":estoque", "$novo_estoque");
    $query->execute();

} else {
    $queryprat = $pdo->query("SELECT * FROM pratos WHERE id = '$produto'");
    $resprat = $queryprat->fetchAll(PDO::FETCH_ASSOC);
    $valor = $resprat[0]['valor'];
    $status_ped = 'Preparando';
}

$total = $valor *  $quant;

$query = $pdo->prepare("INSERT INTO itens_pedido SET pedido = :pedido, item = :item, tipo = :tipo, valor = :valor, quantidade = :quantidade, total = :total, mesa = :mesa, status_ped = :status_ped");


$query->bindValue(":pedido", "$pedido");
$query->bindValue(":item", "$produto");
$query->bindValue(":tipo", "$tipo");
$query->bindValue(":valor", "$valor");
$query->bindValue(":quantidade", "$quant");
$query->bindValue(":total", "$total");
$query->bindValue(":mesa", "$mesa");
$query->bindValue(":status_ped", "$status_ped");
$query->execute();

echo 'Item inserido!';
