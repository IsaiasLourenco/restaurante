<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];


$pdo->query("DELETE from compras WHERE id = '$id'");
$pdo->query("DELETE from contas_pagar WHERE id_compra = '$id'");

echo 'Excluído com Sucesso!';
?>