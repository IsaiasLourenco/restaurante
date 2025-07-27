<?php
$pagina = 'tela';
require_once("../../conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>PAINEL COZINHA-TELA DE ITENS</title>
	<link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

	<div class="container-tela">
		<big><big>
				<table class="table table-lg mt-2">
					<thead class="thead-light">
						<tr>
							<th style="text-align: center;" scope="col">Item</th>
							<th style="text-align: center;" scope="col">Quantidade</th>
							<th style="text-align: center;" scope="col">Mesa</th>
							<th style="text-align: center;" scope="col">Garçom</th>
						</tr>
					</thead>
					<tbody>



						<?php


						$itens_por_pagina = $itens_tela;

						//PEGAR A PÁGINA ATUAL
						$pagina_pag = intval(@$_GET['pagina']);

						$limite = $pagina_pag * $itens_por_pagina;

						//CAMINHO DA PAGINAÇÃO
						$caminho_pag = 'tela.php?';

						$query = $pdo->query("SELECT * FROM itens_pedido WHERE status_item = 'Preparando' ORDER BY id ASC LIMIT $limite, $itens_por_pagina");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);

						//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
						$res_todos = $pdo->query("SELECT * FROM itens_pedido WHERE status_item = 'Preparando'");
						$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
						$num_total = count($dados_total);

						//DEFINIR O TOTAL DE PAGINAS
						$num_paginas = ceil($num_total / $itens_por_pagina);

						for ($i = 0; $i < count($res); $i++) {
							foreach ($res[$i] as $key => $value) {
							}

							$id_reg = $res[$i]['id'];
							$id_pedido = $res[$i]['pedido'];
							$id_item = $res[$i]['item'];

							//BUSCAR O PEDIDO PARA BUSCAR O NOME DO GARÇOM
							$query2 = $pdo->query("SELECT * FROM pedidoS where id = '$id_pedido'");
							$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
							$id_garcom = $res2[0]['garcom'];

							$query3 = $pdo->query("SELECT * FROM funcionarios where id = '$id_garcom'");
							$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
							$nome_garcom = $res3[0]['nome'];

							//BUSCAR O PRODUTO
							$query4 = $pdo->query("SELECT * FROM pratos where id = '$id_item'");
							$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
							$nome_item = $res4[0]['nome'];

						?>

							<td style="text-align: center;"><?php echo $nome_item ?></tdstyle=>
							<td style="text-align: center;"><?php echo $res[$i]['quantidade'] ?></td>
							<td style="text-align: center;"><?php echo $res[$i]['mesa'] ?></td>
							<td style="text-align: center;"><?php echo $nome_garcom ?></td>

							</tr>

						<?php } ?>	

					</tbody>

				</table>

				<!--ÁREA DA PÁGINAÇÃO -->
				<nav class="paginacao" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
							<a class="btn btn-outline-dark btn-sm mr-1" href="<?php echo $caminho_pag; ?>pagina=0&itens=<?php echo $itens_por_pagina ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
						</li>
						<?php
						for ($i = 0; $i < $num_paginas; $i++) {
							$estilo = "";
							if ($pagina_pag == $i)
								$estilo = "active";
						?>
							<li class="page-item"><a class="btn btn-outline-dark btn-sm mr-1 <?php echo $estilo; ?>" href="<?php echo $caminho_pag; ?>pagina=<?php echo $i; ?>&itens=<?php echo $itens_por_pagina ?>"><?php echo $i + 1; ?></a></li>
						<?php } ?>

						<li class="page-item">
							<a class="btn btn-outline-dark btn-sm" href="<?php echo $caminho_pag; ?>pagina=<?php echo $num_paginas - 1; ?>&itens=<?php echo $itens_por_pagina ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
					</ul>
				</nav>

			</big></big>
	</div>

</body>

</html>

<?php

if (!isset($_GET['pagina']) || $_GET['pagina'] >= ($num_paginas - 1)) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=0'>";
} else {
	$valor = @$_GET['pagina'] + 1;
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=$valor'>";
}

?>