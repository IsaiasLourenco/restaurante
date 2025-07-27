<?php 
require_once("../../../conexao.php");

@session_start();
$id = $_POST['id_conta'];
$id_usuario = $_SESSION['id'];

$query_con = $pdo->query("UPDATE pedidos SET pago = 'Sim' WHERE id = '$id'");

//LANÇAR NAS MOVIMENTAÇÕES
$query_con = $pdo->query("SELECT * FROM pedidos WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$mesa = $res_con[0]['mesa'];
$id_pedido = $res_con[0]['id'];
$valor = $res_con[0]['valor'];
$subtotal = $res_con[0]['subtotal'];
$descricao = 'Pedido Mesa nº ' .$mesa;

$res = $pdo->query(" INSERT INTO movimentacoes SET tipo = 'Entrada', data_mov = curDate(), funcionario = '$id_usuario', descricao = '$descricao', valor = '$valor', id_movim = '$id_pedido' ");


echo 'Baixado com Sucesso!';

?>