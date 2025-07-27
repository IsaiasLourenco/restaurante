<?php
require_once("../../../conexao.php");

$id = $_POST['id_reserva'];

$busca_mesa = $pdo->query("SELECT * FROM reservas WHERE id = '$id'");
$res_mesa = $busca_mesa->fetchAll(PDO::FETCH_ASSOC);
$id_mesa = $res_mesa[0]['mesa'];
$atualiza_mesa = $pdo->query("UPDATE mesas SET ocupada = 'Não' WHERE id = '$id_mesa'");

$pdo->query("DELETE from reservas WHERE id = '$id'");

echo 'Excluído com Sucesso!';
?>