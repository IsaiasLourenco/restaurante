<?php
require_once("../../conexao.php");
require_once("verificar.php");

$comentario = $_POST['comentario'];

$id_cli = $_POST['id'];

$query = $pdo->prepare("UPDATE clientes SET comentario = :comentario WHERE funcionario = $id_cli");

$query->bindValue(":comentario", "$comentario");
$query->execute();


echo 'Salvo com Sucesso!';
?>