<?php
$pagina = 'fornecedores';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../vendor/css/h2.css">

</head>

<body>
	<h2>FORNECEDORES</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded mt-2 mb-4" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Novo Fornecedor</a>

	<small>
		<table id="example" class="table table-hover table-sm my-4" style="width:98%;">
			<thead>
				<tr>
					<th>Nome</th>
					<th>CNPJ</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Categoria de Produto</th>
					<th>Ações</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$query = $pdo->query("SELECT * FROM fornecedores ORDER BY id ASC");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				for ($i = 0; $i < @count($res); $i++) {
					foreach ($res[$i] as $key => $value) {
					}
					$id_reg = $res[$i]['id'];
					$id_cat = $res[$i]['categoria'];

					//BUSCAR O NOME DA CATEGORIA RELACIONADA AO ID NA TABELA CATEGORIAS
					$query2 = $pdo->query("SELECT * FROM categorias where id = '$id_cat'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					$nome_cat = $res2[0]['nome'];

				?>
					<tr>
						<td><?php echo $res[$i]['nome'] ?></td>
						<td><?php echo $res[$i]['cnpj'] ?></td>
						<td><?php echo $res[$i]['email'] ?></td>
						<td><?php echo $res[$i]['telefone'] ?></td>
						<td><?php echo $nome_cat ?></td>

						<td>
							<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
								<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

							<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
								<i class="bi bi-trash text-danger"></i></a>

							<a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $res[$i]["cep"] ?>', '<?php echo $res[$i]["rua"] ?>', '<?php echo $res[$i]["numero"] ?>', '<?php echo $res[$i]["bairro"] ?>', '<?php echo $res[$i]["cidade"] ?>', '<?php echo $res[$i]["estado"] ?>')" title="Ver Dados">
								<i class="bi bi-info-circle-fill text-secondary"></i></a>

						</td>
					</tr>

				<?php } ?>

			</tbody>
		</table>
	</small>

	<!-- Modal Inserção e Edição -->
	<div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<?php
					if (@$_GET['funcao'] == 'novo') {
						$titulo_modal = 'Inserir Registro';
					} else {
						$titulo_modal = 'Editar Registro';
						$id = @$_GET['id'];
						$query = $pdo->query("SELECT * FROM fornecedores WHERE  id = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$nome_forn = @$res[0]['nome'];
						$cnpj = @$res[0]['cnpj'];
						$email = @$res[0]['email'];
						$telefone_forn = @$res[0]['telefone'];
						$cep = @$res[0]['cep'];
						$rua = @$res[0]['rua'];
						$numero = @$res[0]['numero'];
						$bairro = @$res[0]['bairro'];
						$cidade = @$res[0]['cidade'];
						$estado = @$res[0]['estado'];
						$categoria = @$res[0]['categoria'];
					}
					?>
					<h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" id="form">
					<div class="modal-body">

						<div class="row">
							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome </label>
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_forn ?>" required>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Email </label>
									<input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$email ?>" required>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Telefone </label>
									<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?php echo @$telefone_forn ?>" required>
								</div>
							</div>

						</div>

						<div class="row">

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">CNPJ </label>
									<input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" value="<?php echo @$cnpj ?>">
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">CEP </label>
									<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$cep ?>">
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Rua </label>
									<input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$rua ?>" readonly>
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cat Produto Fornecido </label>
									<select class="form-select" aria-label="Default select example" name="categoria">
										<?php
										$query = $pdo->query("SELECT * FROM categorias ORDER BY nome ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for ($i = 0; $i < @count($res); $i++) {
											foreach ($res[$i] as $key => $value) {
											}
											$id_cat = $res[$i]['id'];
											$nome_cat = $res[$i]['nome'];
										?>
											<option <?php if (@$id_cat == @$categoria) { ?> selected <?php } ?> value="<?php echo $id_cat ?>"><?php echo $nome_cat ?></option>
										<?php } ?>
									</select>
								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-2">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Número </label>
									<input type="text" class="form-control" id="numero" name="numero" placeholder="Número" value="<?php echo @$numero ?>">
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Bairro </label>
									<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$bairro ?>" readonly>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cidade </label>
									<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
								</div>
							</div>

							<div class="col-2">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Estado </label>
									<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" value="<?php echo @$estado ?>" readonly>
								</div>
							</div>

						</div>

						<input type="hidden" name="id" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem">
							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded" data-bs-dismiss="modal" id="btn-fechar" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0">Fechar</button>
						<button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Fim do Modal Inserção e Edição -->

	<!-- Modal Exclusão-->
	<div class="modal fade" id="excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" id="form-excluir">
					<div class="modal-body">

						Deseja Realmente Excluir este Registro?

						<input type="hidden" name="id" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem-excluir">
							</div>
						</small>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
						<button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Excluir</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Fim do Modal Exclusão-->

	<!-- Modal Dados -->
	<div class="modal fade" id="modal-dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="nome_registro"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">

					<div class="mb-2">
						<span><b>CEP : </b></span><span id="cep_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Rua : </b></span><span id="rua_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Nº : </b></span><span id="numero_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Bairro : </b></span><span id="bairro_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Cidade : </b></span><span id="cidade_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Estado : </b></span><span id="estado_registro"></span>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<!--Fim do Modal Dados -->
</body>

</html>


<!-- Ajax chama Inclusão e Edição -->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>

<?php
if (@$_GET['funcao'] == 'editar') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>

<!-- Ajax chama Exclusão -->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

		})

		myModal.show();
	</script>
<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
	$("#form").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);
		var pag = "<?= $pagina ?>";

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

		});

	});
</script>

<!-- Ajax para excluir dados -->
<script type="text/javascript">
	$("#form-excluir").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);
		var pag = "<?= $pagina ?>";

		$.ajax({
			url: pag + "/excluir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem-excluir').removeClass()

				if (mensagem.trim() == "Excluído com Sucesso!") {

					//$('#nome').val('');
					//$('#cpf').val('');
					$('#btn-fechar-excluir').click();
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

<!-- Ajax chama Modal Dados -->
<script type="text/javascript">
	function dados(nome, cep, rua, numero, bairro, cidade, estado) {
		event.preventDefault();
		var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {

		});

		myModal.show();
		$('#nome_registro').text(nome);
		$('#cep_registro').text(cep);
		$('#rua_registro').text(rua);
		$('#numero_registro').text(numero);
		$('#bairro_registro').text(bairro);
		$('#cidade_registro').text(cidade);
		$('#estado_registro').text(estado);
	}
</script>