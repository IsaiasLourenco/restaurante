<?php
$pagina = 'produtos';
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
	<h2>PRODUTOS</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded cores-button-confirmar-novo">Novo Produto</a>

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

							<a href="" onclick="dados(	'<?php echo $res[$i]["nome"] ?>', 
														'<?php echo $valor_compra ?>', 
														'<?php echo $valor_venda ?>', 
														'<?php echo $nome_cat ?>', 
														'<?php echo $nome_forn ?>', 
														'<?php echo $res[$i]["estoque"] ?>', 
														'<?php echo $res[$i]["imagem"] ?>', 
														'<?php echo $res[$i]["descricao"] ?>')" 
														title="Ver Dados">
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

	<!-- Modal Inserção ou Edição -->
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
						$query = $pdo->query("SELECT * FROM produtos WHERE  id = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$nome_prod = @$res[0]['nome'];
						$descricao = @$res[0]['descricao'];
						$valor_compra = @$res[0]['valor_compra'];
						$valor_venda_prod = @$res[0]['valor_venda'];
						$categoria = @$res[0]['categoria'];
						$fornecedor = @$res[0]['fornecedor'];
						$estoque = @$res[0]['estoque'];
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
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_prod ?>" required>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Valor Venda </label>
									<input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor da Venda" required value="<?php echo @$valor_venda_prod ?>">
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
	<!-- Modal Inserção ou Edição -->

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
	<!-- Fim Modal Exclusão-->

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
						<span><b>Valor Venda : </b></span><span>R$ </span><span id="venda_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Valor Compra : </b></span><span>R$ </span><span id="compra_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Categoria : </b></span><span id="categoria_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Fornecedor : </b></span><span id="fornecedor_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Estoque : </b></span><span id="estoque_registro"></span>
					</div>

					<div class="mb-2">
						<img src="" id="imagem_registro" width="50%">
					</div>

					<div class="mb-2">
						<span id="descricao_registro"></span>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-faded cores-button-confirmar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
					</div>

				</div>

			</div>
		</div>
	</div>
	<!--Fim Modal Dados -->

	<!-- Modal Compras -->
	<div class="modal fade" id="modal-comprar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="nome-comprar"></h5>
					<h5 class="modal-title" id="nome-comprar">Comprar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<form method="post" id="form-comprar">
					<div class="modal-body">

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Quantidade </label>
							<input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" required>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Valor Compra </label>
							<input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor da Compra" required>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Fornecedores </label>
							<select class="form-select" aria-label="Default select example" name="fornecedor">
								<?php
								$query = $pdo->query("SELECT * FROM fornecedores order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for ($i = 0; $i < @count($res); $i++) {
									foreach ($res[$i] as $key => $value) {
									}
									$id_item = $res[$i]['id'];
									$nome_item = $res[$i]['nome'];
								?>
									<option value="<?php echo $id_item ?>"><?php echo $nome_item ?></option>

								<?php } ?>

							</select>
						</div>

						<input type="hidden" id="id-comprar" name="id_comprar" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem-comprar">
							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-comprar">Fechar</button>
						<button type="submit" class="btn btn-faded cores-button-confirmar">Comprar</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- Fim Modal Compras -->
</body>

</html>

<!-- Chama modal de cadastro -->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim do Chama modal de cadastro -->

<!-- Chama modal de edição -->
<?php
if (@$_GET['funcao'] == 'editar') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim do Chama modal de cadastro -->

<!-- Chama modal de exclusão -->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim do Chama modal de exclusão -->

<!-- Ordenação da Datable Produtos -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>
<!-- Fim da Ordenação da Datable Produtos -->

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
<!-- Fim do Ajax para inserir ou editar dados -->

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
<!-- Fim do Ajax para excluir dados -->

<!-- Ajax para visualizar dados adicionais -->
<script type="text/javascript">
	function dados(nome, valor_compra, valor_venda, categoria, fornecedor, estoque, imagem, descricao) {
		var pag = "<?= $pagina ?>";
		event.preventDefault();
		var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {

		});

		myModal.show();
		$('#nome_registro').text(nome);
		$('#compra_registro').text(valor_compra);
		$('#venda_registro').text(valor_venda);
		$('#categoria_registro').text(categoria);
		$('#fornecedor_registro').text(fornecedor);
		$('#estoque_registro').text(estoque);
		$('#imagem_registro').attr('src', '../../assets/imagens/' + pag + '/' + imagem);
		$('#descricao_registro').text(descricao);

		var verModal = "Sim";
		console.error(verModal);
	}
</script>
<!-- Ajax para visualizar dados adicionais -->

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
<!--FIM SCRIPT PARA CARREGAR IMAGEM -->

<!-- Ajax para chamar modal comprar produtos -->
<script type="text/javascript">
	function comprarProdutos(id) {
		event.preventDefault();

		$('#id-comprar').val(id);

		var myModal = new bootstrap.Modal(document.getElementById('modal-comprar'), {

		});

		myModal.show();

	}
</script>
<!--Fim Ajax para chamar modal comprar produtos -->

<!-- Ajax para comprar produtos -->
<script type="text/javascript">
	$("#form-comprar").submit(function() {
		event.preventDefault();

		var formData = new FormData(this);
		var pag = "<?= $pagina ?>";

		$.ajax({
			url: pag + "/comprar.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem-comprar').removeClass()

				if (mensagem.trim() == "Salvo com Sucesso!") {

					//$('#nome').val('');
					//$('#cpf').val('');
					$('#btn-fechar-comprar').click();
					window.location = "index.php?pag=" + pag;

				} else {

					$('#mensagem-comprar').addClass('text-danger')
				}

				$('#mensagem-comprar').text(mensagem)

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>
<!--Fim Ajax para comprar produtos -->