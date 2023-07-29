<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template-->
	<link href="vendor/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="../vendor/css/h2.css" rel="stylesheet">
</head>

<body>
	<div class="row mr-2">

		<?php
		$query = $pdo->query("SELECT * FROM mesas ORDER BY id ASC");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		for ($i = 0; $i < @count($res); $i++) {
			foreach ($res[$i] as $key => $value) {
				$id_mesa = $res[$i]['id'];
				$descricao_mesa = $res[$i]['descricao'];
				$nome_mesa = $res[$i]['nome'];

				$query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$nome_mesa' AND data_reser = curDate()");
				$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
				$classe = 'text-success';
				$texto = 'DISPONÍVEL';
				if (@count($res2) > 0) {
					$classe = 'text-danger';
					$texto = 'RESERVADA';
				} 
			}
		?>

			<div class='col-lg-3 col-md-4 col-sm-12 mb-4'>
				<a href="" style="text-decoration: none;">
					<div class='card shadow h-100'>
						<div class='card-body'>
							<div class='row no-gutters align-items-center'>
								<div class='col mr-2'>
									<div style="text-decoration: none;" class=' text-ls <?php echo $classe ?> text-uppercase'>Mesa <?php echo $nome_mesa ?></div>
									<div class='text-ls text-secondary'><small><?php echo $texto ?></small> </div>
								</div>
								<div class='col-auto' align='center'>
									<i class='bi-aspect-ratio-fill <?php echo $classe ?>' style="font-size: 32px;"></i><br>

								</div>
							</div>
						</div>
					</div>
				</a>
			</div>

		<?php } ?>
</body>

</html>