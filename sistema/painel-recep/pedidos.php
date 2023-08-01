<?php
$pagina = 'pedidos';
require_once("verificar.php");
require_once("../../conexao.php");
$agora = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id'];
?>


<!-- Custom fonts for this template-->
<link href="../../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="../../assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../vendor/css/h2.css">
<link rel="stylesheet" href="../vendor/css/pdv.css">


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
				<a href="#" onclick="modalConsumo(<?php echo $nome_mesa ?>, <?php echo $id_pedido ?>, '<?php echo $obs ?>')" style="text-decoration: none">
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

<!-- Modal Consumo-->
<div class="modal fade" id="modalConsumo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Consumo - Mesa <span id="nome_mesa_consumo"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="form-consumo">
				<div class="modal-body">

					<input type="hidden" id="id_mesa_consumo" name="id_mesa_consumo">
					<input type="hidden" id="pedido-consumo" name="pedido-consumo">

					<small>
						<div align="center" id="mensagem-consumo">
						</div>
					</small>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0">Fechar</button>
					<a href="#" onclick="modalPDV()" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Adicionar</a>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Fim Modal Consumo-->

<!-- Modal PDV-->
<div class="modal fade" id="modal-pdv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Itens - Mesa <span id="nome_mesa_consumo_pdv"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">

				<div class='checkout'>
					<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class='order py-2'>
								<p class="background">CONSUMO</p>

								<span id="listar">

								</span>




							</div>
						</div>



						<div id='payment' class='payment col-md-7'>
							<form method="post" id="form-buscar">
								<div class="row py-2">
									<p class="background">PRODUTOS</p>
									<!-- Dataset Produtos -->
									<small>
										<table id="example" class="table table-hover table-sm my-4" style="width:98%;">
											<thead>
												<tr>
													<th>Nome</th>
													<th>Preço de Compra</th>
													<th>Preço de Venda</th>
													<th>Categoria</th>
													<th>Fornecedor</th>
													<th style="text-align:center">Estoque</th>
													<th style="text-align:center">Imagem</th>
													<th style="text-align:center">Ações</th>

												</tr>
											</thead>
											<tbody>
												<?php
												$query = $pdo->query("SELECT * FROM produtos ORDER BY id ASC");
												$res = $query->fetchAll(PDO::FETCH_ASSOC);
												for ($i = 0; $i < @count($res); $i++) {
													foreach ($res[$i] as $key => $value) {
													}
													$id_reg = $res[$i]['id'];

													$id_cat = $res[$i]['categoria'];
													$id_forn = $res[$i]['fornecedor'];

													//BUSCAR O NOME RELACIONADO
													$query2 = $pdo->query("SELECT * FROM categorias where id = '$id_cat'");
													$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
													$nome_cat = $res2[0]['nome'];

													//BUSCAR O NOME RELACIONADO
													$query2 = $pdo->query("SELECT * FROM fornecedores where id = '$id_forn'");
													$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
													if (@count($res2) == 0) {
														$nome_forn = 'Sem Fornecedor';
													} else {
														$nome_forn = $res2[0]['nome'];
													}

													$valor_compra = number_format($res[$i]['valor_compra'], 2, ',', '.');
													$valor_venda = number_format($res[$i]['valor_venda'], 2, ',', '.');

												?>
													<tr>
														<td><?php echo $res[$i]['nome'] ?></td>
														<td>R$ <?php echo $valor_compra ?></td>
														<td>R$ <?php echo $valor_venda ?></td>
														<td><?php echo $nome_cat ?></td>
														<td><?php echo $nome_forn ?></td>
														<td style="text-align:center"><?php echo $res[$i]['estoque'] ?></td>
														<td style="text-align:center"><img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo $res[$i]['imagem'] ?>" height="30px" width="30px"></td>
														<td style="text-align:center">
															<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
																<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

															<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
																<i class="bi bi-trash text-danger"></i></a>

															<a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $valor_compra ?>', '<?php echo $valor_venda ?>', '<?php echo $nome_cat ?>', '<?php echo $nome_forn ?>', '<?php echo $res[$i]["estoque"] ?>', '<?php echo $res[$i]["imagem"] ?>', '<?php echo $res[$i]["descricao"] ?>')" title="Ver Dados">
																<i class="bi bi-info-circle-fill text-secondary"></i></a>
															<a href="#" onclick="comprarProdutos('<?php echo $res[$i]['id'] ?>')" title="Comprar Produtos" style="text-decoration: none">
																<i class="bi bi-bag-fill text-success"></i>
															</a>

														</td>
													</tr>

												<?php } ?>

											</tbody>
										</table>
									</small>
									<!-- Fim do Dataset Produtos -->


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

<!-- Ajax para limitar nº de itens no Datable e listar produtos -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false,
            "lengthMenu": [
                [2, 3, 4, -1],
                [2, 3, 4, "Todos"]
            ]
        });
        
    });
</script>
<!-- Fim do Ajax para limitar nº de itens no Datable e listar produtos -->

<!-- Ordenação da Datable Produtos -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>
<!-- Fim da Ordenação da Datable Produtos -->

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

<!-- Ajax para chamar Modal consumo -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	function modalConsumo(id_mesa, pedido) {
		event.preventDefault();
		$('#id_mesa_consumo').val(id_mesa);
		$('#pedido-consumo').val(pedido);
		$('#nome_mesa_consumo').text(id_mesa);
		var myModal = new bootstrap.Modal(document.getElementById('modalConsumo'), {

		});
		myModal.show();
	}
</script>
<!-- Fim do Ajax para chamar Modal consumo -->

<!-- Ajax para chamar modalPDV -->
<script type="text/javascript">
	var pag = "<?= $pagina ?>";

	id_mesa_consumo

	function modalPDV(pedido) {
		event.preventDefault();
		$('#nome_mesa_consumo_pdv').text($('#id_mesa_consumo').val());
		var myModal = new bootstrap.Modal(document.getElementById('modal-pdv'), {

		});
		myModal.show();
	}
</script>
<!-- Fim do Ajax para chamar modalPDV -->

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