<?php 
require_once("../../../conexao.php");

$id_pedido = $_POST['idpedido'];

$queryped = $pdo->query("SELECT * FROM pedidos WHERE id = '$id_pedido'");
$resped = $queryped->fetchAll(PDO::FETCH_ASSOC);
$nome_mesa = $resped[0]['mesa'];

echo '<ul class="order-list">';

$total_venda = 0;
$total_pedido = 0;
$query_con = $pdo->query("SELECT * FROM itens_pedido WHERE pedido = '$id_pedido' ORDER BY id ASC");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){	}

		$id_item = $res[$i]['item'];
		$tipo = $res[$i]['tipo'];
        $valor = $res[$i]['valor'];
		$quantidade = $res[$i]['quantidade'];
        $valor_total_item = $res[$i]['total'];
		$valor_total_itemF =  number_format($valor_total_item, 2, ',', '.');

		$total_venda += $valor_total_item;
		$total_vendaF =  number_format($total_venda, 2, ',', '.');
        
        

        if ($tipo == 'Produto') {
            $query2 = $pdo->query("SELECT * FROM produtos WHERE id = '$id_item'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $valor = $res2[0]['valor_venda'];
            $nome_item = $res2[0]['nome'];
            $imagem = $res2[0]['imagem'];
            $pasta = 'produtos';
            
        } else {
            $query2 = $pdo->query("SELECT * FROM pratos WHERE id = '$id_item'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $valor = $res2[0]['valor'];
            $nome_item = $res2[0]['nome'];
            $imagem = $res2[0]['imagem'];
            $pasta = 'pratos';
        }



           echo '<li class="mb-1"><img src="../../assets/imagens/'.$pasta.'/'.$imagem.'"><h2>'.$quantidade.' - '.mb_strtoupper($nome_item). ' <a href="#" onclick="modalExcluir('.$id_pedido.')" title="Excluir Item" style="text-decoration: none">
				<i class="bi bi-x text-danger mx-1"></i>
								</a> </h2><h2>'.$valor_total_itemF.'</h2></li>';



}

}

echo '</ul>';
echo '<h4 class="total mt-4">Total de '.$total_reg.' itens na mesa '.$nome_mesa.'</h4>';
echo '<div class="row"><div class="col-md-9"><h1>R$ <span id="sub_total">'.@$total_vendaF.'</span></h1></div><div class="col-md-3" align="right"><a style="text-decoration:none" class="text-danger" href="index.php" title="Fechar Caixa ou Sair do PDV"><i class="bi bi-box-arrow-right"></i> <small>Sair</small> </a></div>';
