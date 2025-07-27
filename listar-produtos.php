<?php
require_once("conexao.php");
$id_reg = $_POST['idcat'];

if ($id_reg == 0) {
	$query = $pdo->query("SELECT * FROM categorias order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$id_primeira_cat = $res[0]['id'];	
	$id_reg = $id_primeira_cat;
}

$query = $pdo->query("SELECT * FROM produtos where categoria = '$id_reg' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
	foreach ($res[$i] as $key => $value) {
	}
	$id_prod = $res[$i]['id'];
	$categoria = $res[$i]['categoria'];
	$valor_venda = $res[$i]['valor_venda'];
	$valor_venda = number_format($res[$i]['valor_venda'], 2, ',', '.');
	$imagem_prod = $res[$i]['imagem'];
	$nome_prod = $res[$i]['nome'];
	$descricao_prod = $res[$i]['descricao'];

	$query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categ =  $res2[0]['nome'];

	$total_de_colunas = 12 / $produtos_por_linha_index;
	
?>

	<?php echo <<<HTML
	<div class="col-md-{$total_de_colunas}">
		<li>
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="assets/imagens/produtos/{$imagem_prod}" alt="img">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">{$nome_prod}</a></h4>
					<span class="mu-menu-price">R$ {$valor_venda}</span>
					<p>{$descricao_prod}</p>
				</div>
			</div>
		</li>
	</div>

HTML;
}



$query = $pdo->query("SELECT * FROM pratos where categoria = '$id_reg' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
	foreach ($res[$i] as $key => $value) {
	}
	$id_prt = $res[$i]['id'];
	$categoria = $res[$i]['categoria'];

	$valor = number_format($res[$i]['valor'], 2, ',', '.');
	$imagem_prt = $res[$i]['imagem'];
	$nome_prt = $res[$i]['nome'];
	$descricao_prt = $res[$i]['descricao'];

	$query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categ =  $res2[0]['nome'];

	$total_de_colunas = 12 / $produtos_por_linha_index;
	?>

	<?php echo <<<HTML
	<div class="col-md-{$total_de_colunas}">
		<li>
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="assets/imagens/pratos/{$imagem_prt}" alt="img">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">{$nome_prt}</a></h4>
					<span class="mu-menu-price">R$ {$valor}</span>
					<p>{$descricao_prt}</p>
				</div>
			</div>
		</li>
	</div>

HTML;
}



	?>

