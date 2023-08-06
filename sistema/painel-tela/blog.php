<?php
$pagina = 'blog';
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
	<h2>BLOG</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded mt-2 mb-4" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Nova Postagem</a>

	<!-- Dataset Produtos -->
	<small>
		<table id="example" class="table table-hover table-sm my-4" style="width:98%;">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>Autor</th>
					<th>Data</th>
					<th style="text-align:center">Imagem</th>
					<th style="text-align:center">Ações</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$query = $pdo->query("SELECT * FROM blog WHERE autor = '$id_usuario' ORDER BY id ASC");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				for ($i = 0; $i < @count($res); $i++) {
					foreach ($res[$i] as $key => $value) {
					}
					$id_reg = $res[$i]['id'];
					$id_autor = $res[$i]['autor'];

					//BUSCAR O NOME DO FUNCIONÁRIO RELACIONADO AO ID NA TABELA BLOG	
					$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_autor'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					$nome_autor = $res2[0]['nome'];

				?>
					<tr>
						<td><?php echo $res[$i]['titulo'] ?></td>
						<td><?php echo $nome_autor ?></td>
						<td><?php echo implode('/', array_reverse(explode('-', $res[$i]['data_postagem']))) ?></td>
						<td style="text-align:center"><img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo $res[$i]['imagem'] ?>" height="20px" width="30px"></td>
						<td style="text-align:center">
							<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
								<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

							<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
								<i class="bi bi-trash text-danger"></i></a>
							</a>

							<a href="" onclick="dados('<?php echo $res[$i]['titulo'] ?>', '<?php echo $res[$i]['descricao_1'] ?>', '<?php echo $res[$i]['descricao_2'] ?>', '<?php echo $res[$i]['descricao_3'] ?>', '<?php echo $res[$i]['tag'] ?>', '<?php echo $res[$i]['visitas'] ?>', '<?php echo $res[$i]['url_titulo'] ?>','<?php echo $res[$i]['imagem'] ?>')" title="Ver Dados">
								<i class="bi bi-info-circle-fill text-secondary"></i></a>

						</td>
					</tr>

				<?php } ?>

			</tbody>
		</table>
	</small>
	<!-- Fim do Dataset Produtos -->

	<!-- Modal Inserir/Editar -->
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
						$query = $pdo->query("SELECT * FROM blog WHERE  id = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);

						$titulo_blog = @$res[0]['titulo'];
						$descricao_1 = @$res[0]['descricao_1'];
						$descricao_2 = @$res[0]['descricao_2'];
						$descricao_3 = @$res[0]['descricao_3'];		
						$author = @$res[0]['autor'];
						$tag = @$res[0]['tag'];
						$ddata_postagem = @$res[0]['data_postagem'];
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
									<label for="exampleFormControlInput1" class="form-label">Título </label>
									<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?php echo @$titulo_blog ?>" required>
								</div>
							</div>

							<div class="col-8">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Palavras Chaves </label>
									<input type="text" class="form-control" id="tag" name="tag" placeholder="Palavras Chaves" value="<?php echo @$tag ?>" required>
								</div>
							</div>

						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Descrição 1 </label>
							<textarea maxlength="2000" type="text" class="form-control" id="descricao_1" name="descricao_1"><?php echo @$descricao_1 ?> </textarea>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Descrição 2 </label>
							<textarea maxlength="2000" type="text" class="form-control" id="descricao_2" name="descricao_2"><?php echo @$descricao_2 ?> </textarea>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Descrição 3 </label>
							<textarea maxlength="2000" type="text" class="form-control" id="descricao_3" name="descricao_3"><?php echo @$descricao_3 ?> </textarea>
						</div>

						<div class="form-group">
							<label>Imagem</label>
							<input type="file" value="<?php echo @$imagem ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
						</div>

						<div id="divImgConta" class="mt-4">
							<?php if (@$imagem != "") { ?>
								<img src="../../assets/imagens/<?php echo $pagina ?>/<?php echo @$imagem ?>" width="170px" id="target">
							<?php  } else { ?>
								<img src="../../assets/imagens/blog/sem-foto.jpg" width="170px" id="target">
							<?php } ?>
						</div>

						<input type="hidden" name="id" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem">
							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
						<button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fim do Modal Inserir/Editar -->

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
	<!-- Fim Modal Exclusão-->

	<!-- Modal Dados -->
	<div class="modal fade" id="modal-dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="titulo_registro"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">

					<div class="mb-2">
						<span><b>Primeira Descrição : </b></span><span id="descricao_1_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Segundo Descrição : </b></span><span id="descricao_2_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Terceira Descrição : </b></span><span id="descricao_3_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Palavras Chave : </b></span><span id="tag_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Quantidade de Visitas : </b></span><span id="visitas_registro"></span>
					</div>

					<div class="mb-2">
						<a target="blank" href="../../"><span id="url_titulo_registro"></span></a>
					</div>

					<div class="mb-2">
						<img src="" id="imagem_registro" width="50%">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
					</div>

				</div>

			</div>
		</div>
	</div>
	<!--Fim Modal Dados -->

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
	function dados(titulo, descricao_1, descricao_2, descricao_3, tag, visitas, url_titulo, imagem) {
		event.preventDefault();
		var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {

		});

		myModal.show();
		$('#titulo_registro').text(titulo);
		$('#descricao_1_registro').text(descricao_1);
		$('#descricao_2_registro').text(descricao_2);
		$('#descricao_3_registro').text(descricao_3);
		$('#tag_registro').text(tag);
		$('#visitas_registro').text(visitas);
		$('#url_titulo_registro').text(url_titulo);
		$('#imagem_registro').attr('src', '../../assets/imagens/blog/' + imagem);
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