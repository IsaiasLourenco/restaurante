<?php
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];
$id_pedido = $_POST['pedido'];

$query_con = $pdo->query("SELECT * FROM itens_pedido WHERE pedido = '$id_pedido' ORDER BY id ASC");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_venda=0;
$total_reg = @count($res);
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }    

        $valor_total_item = $res[$i]['total'];

        $total_venda += $valor_total_item; 
        $valor_comissao = $total_venda * $comissao;
        $subtotal = $total_venda + $couvert + $valor_comissao;
    }
}

$query1 = $pdo->query("UPDATE reservas SET checkout = 'Sim' WHERE pedido = '$id_pedido'");

$query = $pdo->query("UPDATE pedidos SET valor = '$total_venda', status_pedido = 'Fechada', comissao = '$valor_comissao', couvert = '$couvert', subtotal = '$subtotal' WHERE id = '$id_pedido'");

$query2 = $pdo->prepare("INSERT INTO movimentacoes SET tipo = 'Entrada', descricao = 'Venda em Estabelecimento', valor = '$total_venda', funcionario = '$id_usuario', data_mov = curDate(), id_movim = '$id_pedido'");

$query2->execute();

echo 'Salvo com Sucesso!';
