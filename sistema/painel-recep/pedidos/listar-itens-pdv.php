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
if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }
        $id_ped = $res[$i]['id'];
        $id_item = $res[$i]['item'];
        $tipo = $res[$i]['tipo'];
        $valor = $res[$i]['valor'];
        $quantidade = $res[$i]['quantidade'];
        $status = $res[$i]['status_item'];
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

        if($status == 'Preparando'){
            $classeStatus = 'text-danger';
            $titulo = 'Preparando';
        }else{
            $classeStatus = 'text-success';
            $titulo = 'Pronto';
        }
        
        echo '<li class="mb-1"><img src="../../assets/imagens/' . $pasta . '/' . $imagem . '" style="right: -520px;"><h4 class="cabH4">';
        if($tipo == 'Prato'){
            echo '<i class="bi bi-square-fill ' . $classeStatus . ' mr-2" style="font-size:8px" title="'.$titulo.'"></i>';
        }else{
            echo '<i class="bi bi-square-fill ' . $classeStatus . ' mr-2" style="font-size:8px" title="'.$titulo.'"></i></small>';
        }
         echo $quantidade . 'x ' . mb_strtoupper($nome_item) . ' <a href="#" onclick="excluirItem(' . $id_ped . ')" title="Excluir Item" style="text-decoration: none">
         <i class="fa-regular fa-trash-can text-danger"></i>
                        </a> </h4><h5 class="cabH5">' . $valor_total_itemF . '</h5></li>';
    }
}

echo '</ul>';
echo '<h4 class="total mt-4">Total de ' . $total_reg . ' itens na mesa ' . $nome_mesa . '</h4>';
echo '<div class="row"><div class="col-md-6"><h1>R$ <span id="sub_total">' . @$total_vendaF . '</span></h1

></div>';

echo '<div class="col-md-6" align="right"><a style="text-decoration:none" class="text-primary" href="index.php?pag=pedidos" title="Sair"><i class="fa-solid fa-hand-point-left"></i> <small>Sair</small> </a>';

echo '<a style="text-decoration:none" class="text-danger ml-2" href="#" onclick="modalFecharMesa()" title="Fechar Mesa"><i class="fa-solid fa-cash-register"></i> <small>Fechar Mesa</small> </a></div>';
