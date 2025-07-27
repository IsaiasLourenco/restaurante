<?php
require_once("../../../conexao.php");

$id = $_POST['id_prato'];

$pdo->query("UPDATE itens_pedido SET status_item = 'Pronto' WHERE id = '$id'");

echo 'Prato finalizado com Sucesso!';
?>