<?php
require_once("../../../conexao.php");

@session_start();
$id = $_POST['id_conta'];
$id_usuario = $_SESSION['id'];

$query_con = $pdo->query("UPDATE contas_pagar SET pago = 'Sim', funcionario = '$id_usuario' WHERE id = '$id'");

//VEERIFICAR SE É UMA COMPRA DE PRODUTOS
$query_con = $pdo->query("SELECT * FROM contas_pagar WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res_con);
if($total_reg > 0){ 
	$descricao = $res_con[0]['descricao'];
	$id_compra = $res_con[0]['id_compra'];
	if($descricao == 'Compra de Produtos'){
		$query_con = $pdo->query("UPDATE compras SET pago = 'Sim' WHERE id = '$id_compra'");
	}
    
}	

//LANÇAR NAS MOVIMENTAÇÕES
$query_con = $pdo->query("SELECT * FROM contas_pagar WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$descricao = $res_con[0]['descricao'];
$valor = $res_con[0]['valor'];

$res = $pdo->query(" INSERT INTO movimentacoes SET tipo = 'Saída', data_mov = curDate(), funcionario = '$id_usuario', descricao = '$descricao', valor = '$valor', id_movim = '$id' ");

echo 'Conta paga! Atualização feita com sucesso!';

?>
