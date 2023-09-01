<?php
require_once("../../../conexao.php");
@session_start();
$produto = $_POST['id'];
$quantidade = $_POST['quantidade'];
$pedido = $_POST['pedido'];
$mesa = $_POST['mesa'];
$tipo = $_POST['tipo'];

if ($quantidade <= 0) {
    exit();
}

if ($tipo == 'Produto') {
    $query2 = $pdo->query("SELECT * FROM produtos WHERE id = '$produto'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $valor = $res2[0]['valor_venda'];
    $estoque = $res2[0]['estoque'];
    $nome = $res2[0]['nome'];
    $status_item = 'Pronto';

    if($quantidade > $nivel_estoque){
        echo 'Estoque insuficiente! Existe(m) ' .$estoque. ' ' .$nome. ' no estoque. Contatar compras!';
        exit();
    }

    // ABATER DO ESTOQUE
    $novo_estoque = $estoque - $quantidade;
    $query = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = '$produto'");
    $query->bindValue(":estoque", "$novo_estoque");
    $query->execute();
} else {
    $query2 = $pdo->query("SELECT * FROM pratos WHERE id = '$produto'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $valor = $res2[0]['valor'];
    $status_item = 'Preparando';
}

$total = $valor * $quantidade;

$query = $pdo->prepare("INSERT INTO itens_pedido SET pedido = :pedido,  item = :item, tipo = :tipo, valor = :valor, quantidade = :quantidade, total = :total, mesa = :mesa, status_item = :status_item");

$query->bindValue(":pedido", "$pedido");
$query->bindValue(":item", "$produto");
$query->bindValue(":tipo", "$tipo");
$query->bindValue(":valor", "$valor");
$query->bindValue(":quantidade", "$quantidade");
$query->bindValue(":total", "$total");
$query->bindValue(":mesa", "$mesa");
$query->bindValue(":status_item", "$status_item");
$query->execute();


echo 'Salvo com Sucesso!';