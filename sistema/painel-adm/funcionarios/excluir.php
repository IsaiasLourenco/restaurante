<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];

$pdo->query("DELETE from funcionarios WHERE id = '$id'");
$pdo->query("DELETE from chef WHERE funcionario = '$id'");

echo 'Excluído com Sucesso!';
?>