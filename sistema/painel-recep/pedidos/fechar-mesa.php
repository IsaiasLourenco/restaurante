<?php
require_once("../../../conexao.php");

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
    }
}



$query = $pdo->query("UPDATE pedidos SET valor = '$total_venda', status_pedido = 'Fechada' WHERE id = '$id_pedido'");

echo 'Salvo com Sucesso!';
