<?php
require_once("../../../conexao.php");

$id = $_POST['id'];

$pdo->query("DELETE from funcionarios WHERE id = '$id'");

echo 'Excluído com Sucesso!';
?>