<?php
$pagina = 'pratos';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../vendor/css/h2.css">
</head>

<body>
	<h2>PRATOS</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded cores-button-confirmar-novo">Novo Prato</a>

	<small>
		<table id="example" class="table table-hover table-sm my-4" style="width:98%;">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Valor</th>
					<th>Categoria</th>
					<th style="text-align:center">Imagem</th>
					<th style="text-align:center">Ações</th>
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
						<td><?php echo $res[$i]['nome'] ?></td>
						<td>R$ <?php echo $valor ?></td>
						<td><?php echo $nome_cat ?></td>
						<td style="text-align:center"><img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo $res[$i]['imagem'] ?>" height="20px" width="40"></td>
						<td style="text-align:center">
							<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
								<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

							<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
								<i class="bi bi-trash text-danger"></i></a>

							<a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $valor ?>', '<?php echo $nome_cat ?>', '<?php echo $res[$i]["imagem"] ?>', '<?php echo $res[$i]["descricao"] ?>')" title="Ver Dados">
								<i class="bi bi-info-circle-fill text-secondary"></i></a>

							<?php if ($res[$i]["ativo"] == 'Sim') { ?>

								<a href="" onclick="ativo('<?php echo $res[$i]["id"] ?>', 'Não')" title="Desativar">
									<i class="bi bi-check-square-fill text-success"></i></a>

							<?php  } else { ?>

								<a href="" onclick="ativo('<?php echo $res[$i]["id"] ?>', 'Sim')" title="Ativar">
									<i class="bi bi-square text-danger"></i></a>

							<?php  } ?>

						</td>
					</tr>

				<?php } ?>

			</tbody>
		</table>
	</small>

	<!-- Modal Inserção Edição-->
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
						$query = $pdo->query("SELECT * FROM pratos WHERE  id = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$nome_prato = @$res[0]['nome'];
						$descricao = @$res[0]['descricao'];
						$valor = @$res[0]['valor'];

						$categoria = @$res[0]['categoria'];

						$imagem = @$res[0]['imagem'];
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
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_prato ?>" required>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Valor </label>
									<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required value="<?php echo @$valor ?>">
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Categoria </label>
									<select class="form-select" aria-label="Default select example" name="categoria">
										<?php
										$query = $pdo->query("SELECT * FROM categorias order by nome asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for ($i = 0; $i < @count($res); $i++) {
											foreach ($res[$i] as $key => $value) {
											}
											$id_item = $res[$i]['id'];
											$nome_item = $res[$i]['nome'];
										?>
											<option <?php if (@$id_item == @$categoria) { ?> selected <?php } ?> value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

										<?php } ?>

									</select>
								</div>
							</div>

						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Descrição </label>
							<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto" value="<?php echo @$descricao ?>">
						</div>

						<div class="form-group">
							<label>Imagem</label>
							<input type="file" value="<?php echo @$imagem ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
						</div>

						<div id="divImgConta" class="mt-4">
							<?php if (@$imagem != "") { ?>
								<img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo @$imagem ?>" width="170px" id="target">
							<?php  } else { ?>
								<img src="../../assets/imagens/<?php echo $pagina ?>/sem-foto.jpg" width="170px" id="target">
							<?php } ?>
						</div>

						<input type="hidden" name="id" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem">
							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
						<button type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fim Modal Inserção Edição-->

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
						<button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
						<button type="submit" class="btn btn-faded cores-button-confirmar">Excluir</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Fim Modal Exclusão-->

	<!-- Modal Dados-->
	<div class="modal fade" id="modal-dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="nome_registro"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">

					<div class="row">
						<div class="col-6">
							<div class="mb-2">
								<span><b>Valor : </b></span><span>R$ </span><span id="valor_registro"></span>
							</div>
						</div>
						<div class="col-6">

							<div class="mb-2">
								<span><b>Categoria : </b></span><span id="categoria_registro"></span>
							</div>

						</div>
					</div>

					<div class="mb-2">
						<img src="" id="imagem_registro" width="100%">
					</div>

					<div class="mb-2">
						<span id="descricao_registro"></span>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-faded cores-button-confirmar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
					</div>

				</div>

			</div>
		</div>
	</div>
	<!-- Fim Modal Dados-->
</body>

</html>

<!-- Ajax Modal Novo-->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim Ajax Modal Novo-->

<!-- Ajax Modal Editar-->
<?php
if (@$_GET['funcao'] == 'editar') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim Ajax Modal Editar-->

<!-- Ajax Modal Excluir-->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim Ajax Modal Excluir-->

<!-- JavaScript-->
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>
<!-- Fim JavaScript-->

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
<!-- Fim Ajax para inserir ou editar dados -->

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
<!--Dim Ajax para excluir dados -->

<!-- Ajax para Modal dados -->
<script type="text/javascript">
	function dados(nome, valor, categoria, imagem, descricao) {
		var pag = "<?= $pagina ?>";
		event.preventDefault();
		var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {

		});

		myModal.show();
		$('#nome_registro').text(nome);
		$('#valor_registro').text(valor);

		$('#categoria_registro').text(categoria);

		$('#imagem_registro').attr('src', '../../assets/imagens/' + pag + '/' + imagem);
		$('#descricao_registro').text(descricao);
	}
</script>
<!--Fim Ajax para Modal dados -->

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
	function carregarImg() {

		var target = document.getElementById('target');
		var file = document.querySelector("input[type=file]").files[0];

		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);
		//console.log(resultado[1]);

		if (resultado[1] === 'pdf') {
			$('#target').attr('src', "../../assets/imagens/produtos/pdf.png");
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

<!--SCRIPT PARA ATIVAR PRATO -->
<script type="text/javascript">
	function ativo(id, ativo) {
		var pag = "<?= $pagina ?>";
		event.preventDefault();

		$.ajax({
			url: pag + "/ativar.php",
			method: 'POST',
			data: {
				id,
				ativo
			},
			dataType: "text",

			success: function(mensagem) {

				console.log(mensagem);
				if (mensagem.trim() == "Ativado com Sucesso!") {

					window.location = "index.php?pag=" + pag;

				}
			},


		});

	}
</script>
<!--FIM DO SCRIPT PARA ATIVAR PRATO -->