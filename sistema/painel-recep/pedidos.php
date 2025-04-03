<?php
if (@$pag_painel != "") {
	$pagina = $pag_painel . '/pedidos';
} else {
	$pagina = 'pedidos';
}
require_once("../../conexao.php");
$agora = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id'];

$id_cargo = @$_SESSION['cargo'];
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if ($nome_cargo != 'Garçom' and $nome_cargo != 'Administrador' and $nome_cargo != 'Recepcionista') {
	echo "<script language='javascript'>window.location='../'</script>";
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Custom fonts for this template-->
	<link href="../../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="../../assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="../../assets/css/pdv.css">
	<link rel="stylesheet" href="../../assets/css/botoes.css">
	<link rel="stylesheet" href="../../assets/css/meucss.css">
</head>

<body>
	<h2 style="color: black;">MESAS</h2>
	<div class="row mr-2">

		<?php
		$query = $pdo->query("SELECT * FROM mesas order by id asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		for ($i = 0; $i < @count($res); $i++) {
			foreach ($res[$i] as $key => $value) {
			}
			$id_mesa = $res[$i]['id'];
			$nome_mesa = $res[$i]['nome'];

			

			$query4 = $pdo->query("SELECT * FROM pedidos where mesa = '$nome_mesa' and data_pedido = curDate() and valor = '0.00' and status_pedido = 'Aberta'");
			$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

			$classe = 'text-success';
			$texto = 'DISPONÍVEL';
			$texto_if =  'DISPONÍVEL';
			$nome_cliente = '';


			if (@count($res4) > 0) {
				$classe = 'text-primary';
				$texto =  'ABERTA';
				$texto_if =  'ABERTA';
				$id_pedido = $res4[0]['id'];
				$obs = $res4[0]['obs'];

				$query5 = $pdo->query("SELECT * FROM itens_pedido where pedido = '$id_pedido'");
				$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
				$texto =  'ABERTA (' . @count($res5) . ')';
			}

			$query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$nome_mesa' AND data_reser = curDate() AND checkin = 'Não'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

			if (@count($res2) > 0) {
				$classe = 'text-danger';
				$texto_if =  'RESERVADA';
				$texto = 'RESERVADA';
				$id_cliente = $res2[0]['cliente'];

				$query3 = $pdo->query("SELECT * FROM funcionarios where id = '$id_cliente'");
				$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
				$nome_cliente = ' - ' . $res3[0]['nome'];
			}

		?>

			<div class='col-lg-3 col-md-4 col-sm-12 mb-4'>
				<?php if ($texto_if == 'ABERTA' ) { ?>
					<a href="#" onclick="modalPDV(<?php echo $nome_mesa ?>, <?php echo $id_pedido ?>, '<?php echo $obs ?>')" style="text-decoration: none">
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
										<i class='fas fa-utensils <?php echo $classe ?>' style="font-size: 32px;"></i><br>

									</div>
								</div>
							</div>
						</div>
						</a>
			</div>

		<?php } ?>

	</div>
</body>

</html>


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
								$query = $pdo->query("SELECT * FROM cargos WHERE nome = 'Garçom'");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$id_cargo = $res[0]['id'];

								$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id_cargo'");
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
					<button type="button" class="btn cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-reservas">Fechar</button>
					<button type="submit" class="btn cores-button-confirmar">Abrir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Fim Modal Reservas-->

<!-- Modal PDV-->
<div class="modal fade" id="modal-pdv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" style="overflow-y:initial !important">
		<div class="modal-content">

			<div class="modal-body" style="max-height:calc(100vh - 40px); overflow-y:auto">

				<input type="hidden" id="id_mesa_consumo" name="id_mesa_consumo">
				<input type="hidden" id="pedido-consumo" name="pedido-consumo">
				<input type="hidden" id="obs-pedido" name="obs">

				<div class='checkout'>
					<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class='order py-2'>

								<p class="background">CONSUMO MESA <span id="nome_mesa_consumo"></span>

									<a data-bs-toggle="modal" data-bs-target="#modalObs" style="text-decoration:none" class="text-light" href="#" data-bs-toggle="modal" data-bs-target="#modalObs" title="Ver Observações">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle-info"></i> <small>OBSERVAÇÕES</small> </a>

								</p>

								<span id="listar-itens-pdv"></span>

							</div>
						</div>

						<div id='payment' class='payment col-md-7'>
							<form method="post" id="form-buscar">
								<div class="row py-2">
									<!-- Dataset Produtos -->
									<p class="background"><i class="fa-solid fa-cart-shopping"></i> PRODUTOS</p>

									<small>
										<table id="produtos" class="table table-hover table-sm my-4" style="width:98%;">
											<thead>
												<tr>
													<th style="display: none;">Categoria</th>
													<th style="width: 30%;">Nome</th>
													<th style="width: 20%;">Preço</th>
													<th style="text-align: center; width: 10%;">Estoque</th>
													<th style="text-align: center; width: 20%;">Qtde</th>
													<th style="text-align: center; width: 10%;">Imagem</th>
													<th style="text-align: center; width: 10%;">Adicionar</th>

												</tr>
											</thead>
											<tbody>
												<?php
												$query = $pdo->query("SELECT * FROM produtos WHERE estoque > $nivel_estoque ORDER BY id ASC");
												$res = $query->fetchAll(PDO::FETCH_ASSOC);
												for ($i = 0; $i < @count($res); $i++) {
													foreach ($res[$i] as $key => $value) {
													}
													$id_reg = $res[$i]['id'];

													$id_cat = $res[$i]['categoria'];

													//BUSCAR O NOME RELACIONADO
													$query2 = $pdo->query("SELECT * FROM categorias where id = '$id_cat'");
													$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
													$nome_cat = $res2[0]['nome'];

													$valor_venda = number_format($res[$i]['valor_venda'], 2, ',', '.');

												?>
													<tr>
														<td style="display: none;"><?php echo $nome_cat ?></td>
														<td style="width: 30%;"><?php echo $res[$i]['nome'] ?></td>
														<td style="width: 20%;">R$ <?php echo $valor_venda ?></td>
														<td style="text-align: center; width: 10%;"><?php echo $res[$i]['estoque'] ?></td>
														<td style="text-align: center; width: 20%;">

															<input class="form-control form-control-sm" style="text-align:center; border-style: none;" id="Prod-<?php echo $id_reg ?>" type="number" value="1">

														</td>
														<td style="text-align: center; width: 10%;"><img src="../../assets/imagens/produtos/<?php echo $res[$i]['imagem'] ?>" height="30px" width="30px"></>
														<td style="text-align: center; width: 10%;">

															<a href="" onclick="addProduto(<?php echo $id_reg ?>,'Produto')" title="Adicionar Item">
															<i class="fa-solid fa-cart-plus text-success"></i></i></a>

														</td>
													</tr>

												<?php } ?>

											</tbody>
										</table>
										<div class="mt-4" id="mensagem-add"></div>
									</small>
									<!-- Fim do Dataset Produtos -->

									<!-- Dataset Pratos -->
									<p class="background"><i class="fa-solid fa-utensils"></i> PRATOS</p>
									<small>
										<table id="pratos" class="table table-hover table-sm my-4" style="width:98%;">
											<thead>
												<tr>
													<th style="display: none;">Categoria</th>
													<th style="width: 40%;">Nome</th>
													<th style="width: 10%;">Preço</th>
													<th style="text-align: center; width: 20%;">Qtde</th>
													<th style="text-align: center; width: 20%;">Imagem</th>
													<th style="text-align: center; width: 10%;">Adicionar</th>

												</tr>
											</thead>
											<tbody>
												<?php
												$query = $pdo->query("SELECT * FROM pratos ORDER BY id ASC");
												$res = $query->fetchAll(PDO::FETCH_ASSOC);
												for ($i = 0; $i < @count($res); $i++) {
													foreach ($res[$i] as $key => $value) {
													}
													$id_reg = $res[$i]['id'];

													$id_cat = $res[$i]['categoria'];

													//BUSCAR O NOME RELACIONADO
													$query2 = $pdo->query("SELECT * FROM categorias where id = '$id_cat'");
													$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
													$nome_cat = $res2[0]['nome'];

													$valor = number_format($res[$i]['valor'], 2, ',', '.');

												?>
													<tr>
														<td style="display: none;"><?php echo $nome_cat ?></td>
														<td style="width: 40%;"><?php echo $res[$i]['nome'] ?></td>
														<td style="width: 20%;">R$ <?php echo $valor ?></td>
														<td style="text-align: center; width: 20%;">

															<input class="form-control form-control-sm" style="text-align:center; border-style: none;" id="Prat-<?php echo $id_reg ?>" type="number" value="1">

														</td>
														<td style="text-align: center; width: 20%;"><img src="../../assets/imagens/pratos/<?php echo $res[$i]['imagem'] ?>" height="30px" width="30px"></>
														<td style="text-align: center; width: 20%;">

															<a href="" onclick="addProduto(<?php echo $id_reg ?>,'Prato')" title="Adicionar Item">
															<i class="fa-solid fa-cart-plus text-success"></i></a>



														</td>
													</tr>

												<?php } ?>

											</tbody>
										</table>
									</small>
									<!-- Fim do Dataset Pratos -->

								</div>

							</form>

						</div>


					</div>
				</div>

			</div>


		</div>
	</div>
</div>
<!-- Fim Modal PDV-->

<!-- Modal Observação-->
<div class="modal fade" id="modalObs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="post" id="form-obs">
				<div class="modal-body bg-light">

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label"><strong>Observações</strong></label>
						<textarea type="text" class="form-control" name="obs-texto" id="obs-texto"></textarea>
					</div>


					<input type="hidden" id="pedido-obs" name="pedido-obs">


					<small>
						<div align="center" id="mensagem-obs">
						</div>
					</small>

				</div>
				<div class="modal-footer bg-light">
					<button type="button" class="btn cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-obs">Fechar</button>
					<button type="submit" class="btn cores-button-confirmar">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Fim Modal Observação-->

<!-- Modal Fechar Mesa-->
<div class="modal fade" id="modalFecharMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body bg-light">

				<h2>Fechamento</h2>
				<p>Deseja realmente fechar a mesa <strong><span id="nome-mesa"></span></strong>? O valor total consumido foi de <strong>R$ <span id="total-consumido"></span></strong> .</p>

				<small>
					<div align="center" id="mensagem-fechar">
					</div>
				</small>

			</div>
			<div class="modal-footer bg-light">
				<a href="index.php?pag=pedidos" type="button" class="btn cores-button-recusar" id="btn-fechar-fechar">Sair</a>
				<a href="#" onclick="fecharMesa()" class="btn cores-button-confirmar">Fechar Mesa</a>
			</div>

		</div>
	</div>
</div>
<!-- Fim Modal Fechar Mesa-->

<!-- Ajax para limitar nº de itens no Datable e listar produtos -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#produtos').DataTable({
			"ordering": false,
			"lengthMenu": [
				[2, 3, 4, -1],
				[2, 3, 4, "Todos"]
			]
		});

	});
</script>
<!-- Fim do Ajax para limitar nº de itens no Datable e listar produtos -->

<!-- Ajax para limitar nº de itens no Datable e listar pratos -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#pratos').DataTable({
			"ordering": false,
			"lengthMenu": [
				[2, 3, 4, -1],
				[2, 3, 4, "Todos"]
			]
		});

	});
</script>
<!-- Fim do Ajax para limitar nº de itens no Datable e listar pratos -->

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

<!-- Ajax para inserir ou editar PEDIDOS -->
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
<!-- Fim Ajax para inserir ou editar PEDIDOS -->

<!-- Ajax para chamar modalPDV -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function modalPDV(id_mesa, pedido, obs) {
		event.preventDefault();

		$('#id_mesa_consumo').val(id_mesa);
		$('#pedido-consumo').val(pedido);
		$('#obs-texto').val(obs);
		$('#pedido-obs').val(pedido);
		$('#nome_mesa_consumo').text(id_mesa);
		$('#nome-mesa').text(id_mesa);

		var myModal = new bootstrap.Modal(document.getElementById('modal-pdv'), {

		});
		myModal.show();
		listarItensPDV();
	}
</script>
<!-- Fim do Ajax para chamar modalPDV -->

<!-- Ajax para adicoinar item -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function addProduto(id, tipo) {
		event.preventDefault();
		if (tipo === 'Produto') {
			var quantidade = $('#Prod-' + id).val();
		} else {
			var quantidade = $('#Prat-' + id).val();
		}
		var pedido = $('#pedido-consumo').val();
		var mesa = $('#nome_mesa_consumo').text();

		$.ajax({
			url: pag + "/inserir-itens.php",
			method: 'POST',
			data: {
				id,
				quantidade,
				pedido,
				mesa,
				tipo
			},
			dataType: "text",

			success: function(mensagem) {

				$('#mensagem-add').removeClass()
				$('#mensagem-add').text('');
				if (mensagem.trim() == "Salvo com Sucesso!") {
					if (tipo === 'Produto') {
						$('#Prod-' + id).val('1');
						listarItensPDV();
						
					} else {
						$('#Prat-' + id).val('1');
						listarItensPDV();
						
					}
				} else {
					$('#mensagem-add').addClass('text-danger')
					$('#mensagem-add').text(mensagem)
				}
				//window.location = "index.php?pag=" + pag;
			},


		});

	}
</script>
<!-- Fim do Ajax para adicoinar item -->

<!--AJAX PARA ATUALIZAR ESTOQUE -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function atualizarEstoque(){


		
	}

</script>
<!--FIM AJAX PARA ATUALIZAR ESTOQUE -->

<!--AJAX PARA MOSTRAR OS PRODUTOS DO ITEM DA VENDA -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	atualizarEstoque();
	function listarItensPDV() {
		var idpedido = $('#pedido-consumo').val();
		$.ajax({
			url: pag + "/listar-itens-pdv.php",
			method: 'POST',
			data: {
				idpedido
			},
			dataType: "html",

			success: function(result) {

				$("#listar-itens-pdv").html(result);
				$('#total-consumido').text($('#sub_total').text());
			}

		});
	}
</script>
<!-- FIM AJAX PARA MOSTRAR OS PRODUTOS DO ITEM DA VENDA -->

<!-- AJAX PARA DELETAR ITEM -->
<script type="text/javascript">
	function excluirItem(id) {
		event.preventDefault();
		var pag = "<?= $pagina ?>";
		console.log(id);
		$.ajax({
			url: pag + "/excluir-item.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "text",

			success: function(mensagem) {

				if (mensagem.trim() == "Excluído com Sucesso!") {

					listarItensPDV();
					atualizarEstoque();
				}
			},


		});

	}
</script>
<!--FIM AJAX PARA DELETAR ITEM -->

<!-- Ajax para inserir ou editar OBSERVAÇOES -->
<script type="text/javascript">
	$("#form-obs").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);
		var pag = "<?= $pagina ?>";

		$.ajax({
			url: pag + "/editar-obs.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem-obs').removeClass()
				$('#mensagem-obs').text('')

				if (mensagem.trim() == "Salvo com Sucesso!") {

					$('#btn-fechar-obs').click();

				} else {

					$('#mensagem-obs').addClass('text-danger')
					$('#mensagem-obs').text(mensagem)
				}



			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>
<!-- Fim Ajax para inserir ou editar OBSERVAÇOES -->

<!-- Chama modal OBSERVAÇOES -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function modalOBS() {
		var myModal = new bootstrap.modal(document.getElementById('modalObs'), {
			backdrop: 'static'
		});
		myModal.show();
	}
</script>
<!-- Fim chama modal OBSERVAÇOES -->

<!-- Ajax para Fechar Mesa -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function fecharMesa() {
		event.preventDefault();
		var pedido = $('#pedido-consumo').val();

		$.ajax({
			url: pag + "/fechar-mesa.php",
			method: 'POST',
			data: {
				pedido
			},
			dataType: "text",

			success: function(mensagem) {

				$('#mensagem-fechar-mesa').removeClass()
				$('#mensagem-fechar-mesa').text('');
				if (mensagem.trim() == "Salvo com Sucesso!") {
					let a = document.createElement('a');
					a.target = '_blank';
					a.href = '../rel/rel_comprovante	.php?id=' + pedido;
					a.click();
				} else {
					$('#mensagem-fechar-mesa').addClass('text-danger')
					$('#mensagem-fechar-mesa').text(mensagem)
				}
				//window.location = "index.php?pag=" + pag;
			},


		});

	}
</script>
<!-- Fim do Ajax para Fechar Mesa -->

<!-- Ajax para chamar modalFecharNesa -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function modalFecharMesa() {
		event.preventDefault();

		var myModal = new bootstrap.Modal(document.getElementById('modalFecharMesa'), {
			backdrop: 'static'
		});
		myModal.show();
		listarItensPDV();
		atualizarDataSetProdutos();
	}
</script>
<!-- Fim do Ajax para chamar modalFecharNesa -->