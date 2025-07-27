<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];

$pdo->query("DELETE from clientes WHERE funcionario = '$id'");
$pdo->query("DELETE from funcionarios WHERE id = '$id'");

echo 'Excluído com Sucesso!';
?>