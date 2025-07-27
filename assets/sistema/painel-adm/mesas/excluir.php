<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];

$pdo->query("DELETE from mesas WHERE id = '$id'");

echo 'Excluído com Sucesso!';
?>