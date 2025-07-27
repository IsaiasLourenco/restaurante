<?php
require_once("../../../conexao.php");

$id_pedido = $_POST['idpedido'];

$query_con = $pdo->query("SELECT * FROM pedidos WHERE id = '$id_pedido' order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$nome_mesa = $res[0]['mesa'];

echo '<ul class="order-list">';

$total_venda = 0;
$total_vendaF = 0;
$query_con = $pdo->query("SELECT * FROM itens_pedido WHERE pedido = '$id_pedido' ORDER BY id ASC");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){	}

		$id_ped = $res[$i]['id'];
		$id_item = $res[$i]['item'];
		$tipo = $res[$i]['tipo'];
		$quantidade = $res[$i]['quantidade'];
		$valor = $res[$i]['valor'];
		$status = $res[$i]['status_ped'];
		$valor_total_item = $res[$i]['total'];
		$valor_total_itemF =  number_format($valor_total_item, 2, ',', '.');

		$total_venda += $valor_total_item;
		$total_vendaF =  number_format($total_venda, 2, ',', '.');



if($tipo  == 'Produto'){
$query2 = $pdo->query("SELECT * FROM produtos where id = '$id_item'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$valor_produto = $res2[0]['valor_venda'];
$nome_produto = $res2[0]['nome'];
$foto_produto = $res2[0]['imagem'];
$pasta = 'produtos';
}else{
	$query2 = $pdo->query("SELECT * FROM pratos where id = '$id_item'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$valor_produto = $res2[0]['valor'];
$nome_produto = $res2[0]['nome'];
$foto_produto = $res2[0]['imagem'];
$pasta = 'pratos';
}


if($status == 'Preparando'){
	$classeStatus = 'text-danger';
	$title = 'Preparando';
}else{
	$classeStatus = 'text-success';
	$title = 'Pronto';
}



           echo '<li class="mb-1"><img src="../img/'.$pasta.'/'.$foto_produto.'"><h4 class="cabH4">';
           if($tipo == 'Prato'){
           	 echo '<i class="bi bi-square-fill '.$classeStatus.' mr-2" style="font-size:8px" title="'.$title.'"></i>';
           }
          echo $quantidade.' - '.mb_strtoupper($nome_produto). ' <a href="#" onclick="excluirItem('.$id_ped	.')" title="Excluir Item" style="text-decoration: none">
				<i class="bi bi-x text-danger mx-1"></i>
								</a> </h4><h5 class="cabH5">'.$valor_total_itemF.'</h5></li>';
}
}

echo '</ul>';
echo '<h5 class="total mt-4">Total de Itens ('.$total_reg.') - Mesa '.$nome_mesa.'</h5>';
echo '<div class="row"><div class="col-md-6"><h2>R$ <span id="sub_total">'.@$total_vendaF.'</span></h2></div>';

echo '<div class="col-md-6" align="right"><a style="text-decoration:none" class="text-primary" href="index.php?pag=pedidos" title="Voltar para Mesas"><i class="bi bi-arrow-return-left"></i> <small>Voltar</small> </a>';

echo '<a style="text-decoration:none" class="text-danger ml-2" href="#" onclick="modalFecharMesa()" title="Fechar a Mesa"><i class="bi bi-cash"></i> <small>Fechar Mesa R$</small> </a></div>';



 ?>
