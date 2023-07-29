<?php
require_once("../../../conexao.php");

@session_start();
$id = $_POST['id_conta'];
$id_usuario = $_SESSION['id'];

$query_con = $pdo->query("UPDATE contas_receber SET pago = 'Sim', funcionario = '$id_usuario' WHERE id = '$id'");	

//LANÇAR NAS MOVIMENTAÇÕES
$query_con = $pdo->query("SELECT * FROM contas_receber WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$descricao = $res_con[0]['descricao'];
$valor = $res_con[0]['valor'];

$res = $pdo->query(" INSERT INTO movimentacoes SET tipo = 'Entrada', data_mov = curDate(), funcionario = '$id_usuario', descricao = '$descricao', valor = '$valor', id_movim = '$id' ");

echo 'Conta paga! Atualização feita com sucesso!';

?>
