<?php
$pagina = 'pagar';
require_once("verificar.php");
$vencimento = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../vendor/css/h2.css">
</head>

<body>
	<h2>CONTAS À PAGAR</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded cores-button-confirmar-novo">Nova Conta</a>

	<div class="mt-4" style="margin-right:25px">
		<?php
		$query = $pdo->query("SELECT * FROM contas_pagar ORDER BY id ASC");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if ($total_reg > 0) {
			$id_conta = $res[0]['id'];
		?>
			<small>
				<table id="example" class="table table-hover my-4" style="width:100%">
					<thead>
						<tr>
							<th style="text-align:center">Pago</th>
							<th style="text-align:center">Descrição</th>
							<th style="text-align:center">Valor</th>
							<th style="text-align:center">Funcionário</th>
							<th style="text-align:center">Vencimento</th>
							<th style="text-align:center">Arquivo</th>
							<th style="text-align:center">Ações</th>
						</tr>
					</thead>
					<tbody>

						<?php
						for ($i = 0; $i < $total_reg; $i++) {
							foreach ($res[$i] as $key => $value) {
							}

							$id_usu = $res[$i]['funcionario'];
							$query_p = $pdo->query("SELECT * from funcionarios where id = '$id_usu'");
							$res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
							$nome_usu = $res_p[0]['nome'];

							if ($res[$i]['pago'] == 'Sim') {
								$classe = 'text-success';
							} else {
								$classe = 'text-danger';
							}

							$extensao = strchr($res[$i]['arquivo'], '.');
							if ($extensao == '.pdf') {
								$arquivo_pasta = 'pdf.png';
							} else {
								$arquivo_pasta = $res[$i]['arquivo'];
							}

						?>

							<tr>
								<td style="text-align:center"> <i class="bi bi-square-fill <?php echo $classe ?>"></i>
								</td>

								<td style="text-align:center"><?php echo $res[$i]['descricao'] ?></td>

								<td style="text-align:center">R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.'); ?></td>

								<td style="text-align:center"><?php echo $nome_usu ?></td>

								<td style="text-align:center"><?php echo implode('/', array_reverse(explode('-', $res[$i]['data_vencimento']))); ?></td>

								<td style="text-align:center"><a href="../../assets/imagens/<?php echo $pagina ?>/<?php echo $res[$i]['arquivo'] ?>" title="Ver Arquivo" style="text-decoration: none" target="_blank">
										<img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo $arquivo_pasta ?>" width="40">
									</a>
								</td>
								<td style="text-align:center">
									<?php if ($res[$i]['pago'] != 'Sim') { ?>
										<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro" style="text-decoration: none">
											<i class="bi bi-pencil-square text-primary"></i>
										</a>

										<a href="index.php?pag=<?php echo $pagina ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro" style="text-decoration: none">
											<i class="bi bi-archive-fill text-danger mx-1"></i>
										</a>

										<a href="index.php?pag=<?php echo $pagina ?>&funcao=baixar&id=<?php echo $res[$i]['id'] ?>" title="Baixar Registro" style="text-decoration: none">
											<i class="bi bi-check-square-fill text-success mx-1"></i>

										</a>

									<?php } ?>

								</td>
							</tr>

						<?php } ?>

					</tbody>

				</table>
			</small>
		<?php } else {
			echo '<p>Não existem dados para serem exibidos!!';
		} ?>
	</div>


	<?php
	if (@$_GET['funcao'] == "editar") {
		$titulo_modal = 'Editar Registro';
		$query = $pdo->query("SELECT * from contas_pagar where id = '$_GET[id]'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if ($total_reg > 0) {
			$valor = $res[0]['valor'];
			$descricao = $res[0]['descricao'];
			$arquivo = $res[0]['arquivo'];
			$vencimento = $res[0]['data_vencimento'];

			$extensao2 = strchr($arquivo, '.');
			if ($extensao == '.pdf') {
				$arquivo_pasta = 'pdf.png';
			} else {
				$arquivo_pasta = $arquivo;
			}
		}
	} else {
		$titulo_modal = 'Inserir Registro';
	}
	?>

	<!-- Modal para Inserção/Edição -->
	<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" id="form">
					<div class="modal-body">

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Descrição</label>
							<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" required="" value="<?php echo @$descricao ?>">
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">

									<label for="exampleFormControlInput1" class="form-label">Valor</label>
									<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required="" value="<?php echo @$valor ?>">
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Vencimento</label>
									<input type="date" class="form-control" id="vencimento" name="vencimento" required="" value="<?php echo @$vencimento ?>">
								</div>

							</div>

						</div>

						<div class="form-group">
							<label>Arquivo</label>
							<input type="file" value="<?php echo @$foto ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
						</div>

						<div id="divImgConta" class="mt-4">
							<?php if (@$arquivo != "") { ?>
								<img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo @$arquivo_pasta ?>" width="200px" id="target">
							<?php  } else { ?>
								<img src="../../assets/imagens/<?php echo $pagina ?>/sem-foto.jpg" width="200px" id="target">
							<?php } ?>
						</div>

						<small>
							<div align="center" class="mt-1" id="mensagem">

							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" id="btn-fechar" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal">Fechar</button>
						<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>

						<input name="id_conta" type="hidden" value="<?php echo @$_GET['id'] ?>">

					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fim do Modal para Inserção/Edição -->

	<!-- Modal para Exclusão -->
	<div class="modal fade" tabindex="-1" id="modalDeletar">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Registro</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" id="form-excluir">
					<div class="modal-body">

						<p>Deseja Realmente Excluir o Registro?</p>

						<small>
							<div align="center" class="mt-1" id="mensagem-excluir">

							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" id="btn-fechar" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal">Fechar</button>
						<button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-faded cores-button-confirmar">Excluir</button>

						<input name="id_conta" type="text" value="<?php echo @$_GET['id'] ?>">

					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fim do Modal para Exclusão -->

	<!-- Modal paraPagamento da conta -->
	<div class="modal fade" tabindex="-1" id="modalBaixar">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Baixar Registro</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" id="form-baixar">
					<div class="modal-body">

						<p>Deseja Realmente confirmar o Recebimento do pagamento desta conta?</p>

						<small>
							<div align="center" class="mt-1" id="mensagem-baixar">

							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" id="btn-fechar-baixar" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal">Fechar</button>
						<button name="btn-baixar" id="btn-excluir" type="submit" class="btn btn-faded cores-button-confirmar">Baixar</button>

						<input name="id_conta" type="hidden" value="<?php echo @$_GET['id'] ?>">

					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Fim Modal paraPagamento da conta -->

	<?php
	if (@$_GET['funcao'] == "novo") { ?>
		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
				backdrop: 'static'
			})

			myModal.show();
		</script>
	<?php } ?>

	<?php
	if (@$_GET['funcao'] == "editar") { ?>
		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
				backdrop: 'static'
			})

			myModal.show();
		</script>
	<?php } ?>

	<?php
	if (@$_GET['funcao'] == "deletar") { ?>
		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {

			})

			myModal.show();
		</script>
	<?php } ?>

	<?php
	if (@$_GET['funcao'] == "baixar") { ?>
		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modalBaixar'), {

			})

			myModal.show();
		</script>
	<?php } ?>

	<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
	<script type="text/javascript">
		$("#form").submit(function() {
			var pag = "<?= $pagina ?>";
			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: pag + "/inserir.php",
				type: 'POST',
				data: formData,

				success: function(mensagem) {

					$('#mensagem').removeClass()

					if (mensagem.trim() == "Salvo com Sucesso!") {

						//$('#nome').val('');
						//$('#cpf').val('');
						$('#btn-fechar').click();
						window.location = "index.php?pag=" + pag;

					} else {

						$('#mensagem').addClass('text-danger')
					}

					$('#mensagem').text(mensagem)

				},

				cache: false,
				contentType: false,
				processData: false,
				xhr: function() { // Custom XMLHttpRequest
					var myXhr = $.ajaxSettings.xhr();
					if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
						myXhr.upload.addEventListener('progress', function() {
							/* faz alguma coisa durante o progresso do upload */
						}, false);
					}
					return myXhr;
				}
			});
		});
	</script>
	<!-- FIM DO AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->

	<!--AJAX PARA EXCLUIR DADOS -->
	<script type="text/javascript">
		$("#form-excluir").submit(function() {
			var pag = "<?= $pagina ?>";
			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: pag + "/excluir.php",
				type: 'POST',
				data: formData,

				success: function(mensagem) {

					$('#mensagem').removeClass()

					if (mensagem.trim() == "Excluído com Sucesso!") {

						$('#mensagem-excluir').addClass('text-success')

						$('#btn-fechar').click();
						window.location = "index.php?pag=" + pag;

					} else {

						$('#mensagem-excluir').addClass('text-danger')
					}

					$('#mensagem-excluir').text(mensagem)

				},

				cache: false,
				contentType: false,
				processData: false,

			});
		});
	</script>
	<!-- FIM DO AJAX PARA EXCLUIR DADOS -->

	<!--AJAX PARA PAGAR -->
	<script type="text/javascript">
		$("#form-baixar").submit(function() {
			var pag = "<?= $pagina ?>";
			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: pag + "/baixar.php",
				type: 'POST',
				data: formData,

				success: function(mensagem) {

					$('#mensagem-baixar').removeClass()

					if (mensagem.trim() == "Baixado com Sucesso!") {

						$('#mensagem-baixar').addClass('text-success')

						$('#btn-fechar-baixar').click();
						window.location = "index.php?pag=" + pag;

					} else {

						$('#mensagem-baixar').addClass('text-danger')
					}

					$('#mensagem-baixar').text(mensagem)

				},

				cache: false,
				contentType: false,
				processData: false,

			});
		});
	</script>
	<!-- FIM DO AJAX PARA PAGAR -->

	<!-- Script para ordenação -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable({
				"ordering": false
			});
		});
	</script>
	<!-- Fim do Script para ordenação -->

	<!--SCRIPT PARA CARREGAR IMAGEM -->
	<script type="text/javascript">
		function carregarImg() {

			var target = document.getElementById('target');
			var file = document.querySelector("input[type=file]").files[0];

			var arquivo = file['name'];
			resultado = arquivo.split(".", 2);
			//console.log(resultado[1]);

			if (resultado[1] === 'pdf') {
				$('#target').attr('src', "../assets/imagens/pagar/pdf.png");
				return;
			}

			var reader = new FileReader();

			reader.onloadend = function() {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);


			} else {
				target.src = "";
			}
		}
	</script>
	<!--FIM DO SCRIPT PARA CARREGAR IMAGEM -->