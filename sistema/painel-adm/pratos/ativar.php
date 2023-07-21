<?php 
require_once("../../../conexao.php");

$id = $_POST['id'];
$ativo = $_POST['ativo'];

$pdo->query("UPDATE pratos SET ativo = '$ativo' WHERE id = '$id'");

echo 'Ativado com Sucesso!';
?>