<?php
$pagina = 'pedidos';
require_once("verificar.php");
$agora = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id'];
?>


<!-- Custom fonts for this template-->
<link href="../../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="../../assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../vendor/css/h2.css">

<h2>MESAS</h2>

<div class="row mr-2">

	<?php
	$query = $pdo->query("SELECT * FROM mesas order by id asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	for ($i = 0; $i < @count($res); $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$id_mesa = $res[$i]['id'];
		$nome_mesa = $res[$i]['nome'];

		$query2 = $pdo->query("SELECT * FROM reservas where mesa = '$nome_mesa' and data_reser = curDate()");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

		$query4 = $pdo->query("SELECT * FROM pedidos where mesa = '$nome_mesa' and data_pedido = curDate() and valor = '0.00' and status_pedido = 'Aberta'");
		$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);


		$classe = 'text-success';
		$texto = 'DISPONÍVEL';
		$texto_if =  'DISPONÍVEL';
		$nome_cliente = '';


		if (@count($res4) > 0) {
			$classe = 'text-primary';
			$texto_if =  'ABERTA';
			$id_pedido = $res4[0]['id'];
			$obs = $res4[0]['obs'];

			$query5 = $pdo->query("SELECT * FROM itens_pedido where pedido = '$id_pedido'");
			$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
			$texto =  'ABERTA (' . @count($res5) . ')';
		}


		if (@count($res2) > 0) {
			$classe = 'text-danger';
			$texto_if =  'RESERVADA';
			$texto = 'RESERVADA';
			$id_cliente = $res2[0]['cliente'];

			$query3 = $pdo->query("SELECT * FROM clientes where id = '$id_cliente'");
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$nome_cliente = ' - ' . $res3[0]['nome'];
		}



	?>


		<div class='col-lg-3 col-md-4 col-sm-12 mb-4'>
			<?php if ($texto_if == 'ABERTA') { ?>
				<a href="#" onclick="modal(<?php echo $nome_mesa ?>, <?php echo $id_pedido ?>, '<?php echo $obs ?>')" style="text-decoration: none">
				<?php } else { ?>
					<a href="#" onclick="modalReservas(<?php echo $nome_mesa ?>)" style="text-decoration: none">
					
					<?php } ?>
					<div class='card shadow h-100'>
						<div class='card-body'>
							<div class='row no-gutters align-items-center'>
								<div class='col mr-2'>
									<div class='<?php echo $classe ?> text-uppercase'>Mesa <?php echo $nome_mesa ?></div>
									<div style="font-size: 12px;" class='text-secondary'><?php echo $texto ?> <?php echo $nome_cliente ?></div>
								</div>
								<div class='col-auto' align='center'>
									<i class='bi bi-archive-fill <?php echo $classe ?>' style="font-size: 32px;"></i><br>

								</div>
							</div>
						</div>
					</div>
					</a>
		</div>

	<?php } ?>

</div>

<!-- Modal Reservas-->
<div class="modal fade" id="modalReservas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Abrir - Mesa <span id="nome_mesa"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="form-reserva">
				<div class="modal-body">

					<div class="col-8">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Garçom </label>
							<select class="form-select" aria-label="Default select example" name="garcom" id="garcom">
								<?php
								$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '4'");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for ($i = 0; $i < @count($res); $i++) {
									foreach ($res[$i] as $key => $value) {
									}
									$id_cargo = $res[$i]['id'];
									$nome_cargo = $res[$i]['nome'];
								?>
									<option <?php if (@$id_cargo == @$id_usuario) { ?> selected <?php } ?> value="<?php echo $id_cargo ?>"><?php echo $nome_cargo ?></option>
								<?php } ?>
							</select>
						</div>

					</div>

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Observações </label>
						<textarea type="text" class="form-control" id="obs" name="obs"></textarea>
					</div>

					<input type="hidden" id="id_mesa" name="id_mesa">
					<input type="hidden" id="id_cli" name="id_cli">

					<small>
						<div align="center" id="mensagem-reserva">
						</div>
					</small>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar-reservas">Fechar</button>
					<button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Abrir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Fim Modal Reservas-->

<!-- Ajax para chamar Modal Reservas -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function modalReservas(id_mesa) {
		event.preventDefault();
		$('#id_mesa').val(id_mesa);
		$('#nome_mesa').text(id_mesa);
		var myModal = new bootstrap.Modal(document.getElementById('modalReservas'), {

		});
		myModal.show();
	}
</script>
<!-- Fim do Ajax para chamar Modal Reservas -->

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
	$("#form-reserva").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);
		var pag = "<?= $pagina ?>";

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem-reserva').removeClass()
				$('#mensagem-reserva').text('')

				if (mensagem.trim() == "Salvo com Sucesso!") {
					window.location = "index.php?pag=" + pag;



				} else {

					$('#mensagem-reserva').addClass('text-danger')
					$('#mensagem-reserva').text(mensagem)
				}



			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>
<!-- Fim Ajax para inserir ou editar dados -->