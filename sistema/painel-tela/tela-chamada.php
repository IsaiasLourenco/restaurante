<?php
$pagina = 'tela-chamada';
require_once("../../conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>PAINEL COZINHA-ÚLITMOS ITENS</title>

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">

</head>

<body class="bg-secondary">

	<div class="row mx-1 my-2">

		<?php

		$ult_id_antigo = 0;

		$query = $pdo->query("SELECT * FROM itens_pedido where status_item = 'Preparando' order by id desc LIMIT $itens_tela_chamada");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);

		for ($i = 0; $i < @count($res); $i++) {
			foreach ($res[$i] as $key => $value) {
			}

			$id_reg = $res[$i]['id'];
			$pedido = $res[$i]['pedido'];
			$item = $res[$i]['item'];
			$nome_mesa = $res[$i]['mesa'];
			$quantidade = $res[$i]['quantidade'];

			//BUSCAR O PEDIDO PARA BUSCAR O NOME DO GARÇOM
			$query2 = $pdo->query("SELECT * FROM pedidos where id = '$pedido'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			$id_garcom = $res2[0]['garcom'];

			$query3 = $pdo->query("SELECT * FROM funcionarios where id = '$id_garcom'");
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$nome_garcom = $res3[0]['nome'];

			//BUSCAR O PRODUTO
			$query4 = $pdo->query("SELECT * FROM pratos where id = '$item'");
			$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
			$nome_item = $res4[0]['nome'];

			$query_ult = $pdo->query("SELECT * FROM itens_pedido where status_item = 'Preparando' order by id desc LIMIT 1");
			$res_ult = $query_ult->fetchAll(PDO::FETCH_ASSOC);
			$id_ult = $res_ult[0]['id'];

			if ($id_ult != @$_GET['id']) {
				echo '<audio autoplay="true">
						<source src="../../assets/audio.mp3" type="audio/mpeg" />
						</audio>';
			}

			if ($id_ult == $id_reg) {
				$classe = 'text-light';
				$classe_bg = 'bg-danger';
				$classe_texto = 'text-light';
			} else {
				$classe = 'text-primary';
				$classe_bg = '';
				$classe_texto = 'text-dark';
			}

			$ult_id_antigo = $id_ult;

		?>

			<div class='col-4 mb-4'>
				<div class='card shadow h-100'>
					<div class='card-body <?php echo $classe_bg ?>'>
						<div class='row no-gutters align-items-center'>
							<div class='col mr-2'>
								<div class='<?php echo $classe ?>' style="font-size:30px"><?php echo $quantidade ?> <?php echo mb_strtoupper($nome_item) ?></div>
								<div class='<?php echo $classe_texto ?>'>MESA <?php echo mb_strtoupper($nome_mesa) ?> - <?php echo mb_strtoupper($nome_garcom) ?> </div>
							</div>

						</div>
					</div>
				</div>
			</div>

		<?php } ?>

	</div>

	</bodyss=>

</html>

<?php

echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela_chamada;URL=tela-chamada.php?id=$ult_id_antigo'>";
?>