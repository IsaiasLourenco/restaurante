<?php
$pagina = 'funcionarios';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/css/meucss.css">
</head>

<body>
	<h2>FUNCIONÁRIOS</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded cores-button-confirmar-novo">Novo Funcionario</a>
	<!-- Cabeçalho e corpo da tabela Dataset -->
	<small>
		<table id="example" class="table table-hover">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>CPF</th>
					<th>Telefone</th>
					<th>Cargo</th>
					<th>Data Cadastro</thstyle=>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = $pdo->query("SELECT * FROM funcionarios ORDER BY id ASC");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				for ($i = 0; $i < @count($res); $i++) {
					foreach ($res[$i] as $key => $value) {
					}
					$id_reg = $res[$i]['id'];
					$id_cargo = $res[$i]['cargo'];

					//BUSCAR O NOME DO CARGO RELACIONADO AO ID NA TABELA CARGOS
					$query2 = $pdo->query("SELECT * FROM cargos where id = '$id_cargo'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					@
					
					$nome_cargo = $res2[0]['nome'];

					$datacad = implode('/', array_reverse(explode('-', $res[$i]['datacad'])));
					$datanasc = implode('/', array_reverse(explode('-', $res[$i]['datanasc'])));

				?>
					<tr>
						<td><?php echo $res[$i]['nome'] ?></td>
						<td><?php echo $res[$i]['email'] ?></td>
						<td><?php echo $res[$i]['cpf'] ?></td>
						<td><?php echo $res[$i]['telefone'] ?></td>
						<td><?php echo $nome_cargo ?></td>
						<td><?php echo $datacad ?></td>

						<td>
							<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
								<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

							<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
								<i class="bi bi-trash text-danger"></i></a>

							<a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', 
													  '<?php echo $res[$i]["cep"] ?>', 
													  '<?php echo $res[$i]["rua"] ?>', 
													  '<?php echo $res[$i]["numero"] ?>', 
													  '<?php echo $res[$i]["bairro"] ?>', 
													  '<?php echo $res[$i]["cidade"] ?>', 
													  '<?php echo $res[$i]["estado"] ?>', 
													  '<?php echo $res[$i]["senha"] ?>', 
													  '<?php echo $res[$i]["imagem"] ?>', 
													  '<?php echo $datanasc ?>')" title="Ver Dados">
													  <i class="bi bi-info-circle-fill text-secondary"></i>
								</a>

						</td>
					</tr>

				<?php } ?>

			</tbody>
		</table>
	</small>
	<!-- Fim do Cabeçalho e corpo da tabela Dataset -->

	<!-- Modal Inserção e Edição -->
	<div onload="document.frmFunc.nome.focus();" class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<?php
					if (@$_GET['funcao'] == 'novo') {
						$titulo_modal = 'Inserir Registro';
					} else {
						$titulo_modal = 'Editar Registro';
						$id = @$_GET['id'];
						$query = $pdo->query("SELECT * FROM funcionarios WHERE  id = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$nome_func = @$res[0]['nome'];
						$cpf = @$res[0]['cpf'];
						$email = @$res[0]['email'];
						$telefone_func = @$res[0]['telefone'];
						$cep = @$res[0]['cep'];
						$rua = @$res[0]['rua'];
						$numero = @$res[0]['numero'];
						$bairro = @$res[0]['bairro'];
						$cidade = @$res[0]['cidade'];
						$estado = @$res[0]['estado'];
						$senha = @$res[0]['senha'];
						$datanasc = @$res[0]['datanasc'];
						$datacad = @$res[0]['datacad'];
						$cargo = @$res[0]['cargo'];
						$imagem = @$res[0]['imagem'];
					}
					?>
					<h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" id="form" name="frmFunc">
					<div class="modal-body">

						<div class="row">
							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome </label>
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus value="<?php echo @$nome_func ?>" required>
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">CPF </label>
									<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?php echo @$cpf ?>" required>
								</div>
							</div>

							<div class="col-5">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Email </label>
									<input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$email ?>" required>
								</div>
							</div>

						</div>

						<div class="row">

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Telefone </label>
									<input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx)xxxx-xxxx" value="<?php echo @$telefone_func ?>" required>
								</div>
							</div>

							<div class="col-2">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">CEP </label>
									<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$cep ?>">
								</div>
							</div>

							<div class="col-7">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Rua </label>
									<input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$rua ?>" readonly>
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

							<div class="col-5">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Bairro </label>
									<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$bairro ?>" readonly>
								</div>
							</div>

							<div class="col-5">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cidade </label>
									<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
								</div>
							</div>

						</div>

						<div class="row">

							<div class="col-1">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Estado </label>
									<input type="text" class="form-control" id="estado" name="estado" placeholder="UF" value="<?php echo @$estado ?>" readonly>
								</div>
							</div>

							<div class="col-2">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Senha </label>
									<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha ?>" required>
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Nascimento </label>
									<input type="date" class="form-control" id="datanasc" name="datanasc" placeholder="Nascimento" value="<?php echo @$datanasc ?>" required>
								</div>
							</div>

							<div class="col-3">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cargo </label>
									<select class="form-select" aria-label="Default select example" name="cargo">
										<?php
										$query = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for ($i = 0; $i < @count($res); $i++) {
											foreach ($res[$i] as $key => $value) {
											}
											$id_cargo = $res[$i]['id'];
											$nome_cargo = $res[$i]['nome'];
										?>
											<option <?php if (@$id_cargo == @$cargo) { ?> selected <?php } ?> value="<?php echo $id_cargo ?>"><?php echo $nome_cargo ?></option>
										<?php } ?>
									</select>
								</div>

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

						</div>

						<input type="hidden" name="id" value="<?php echo @$id ?>">

						<small>
							<div align="center" id="mensagem">
							</div>
						</small>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
						<button type="submit" class="btn btn-faded cores-button-confirmar" >Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Fim Modal Inserção e Edição -->

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
						<img src="" id="imagem_registro" width="50%">
					</div>

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

					<div class="mb-2">
						<span><b>Senha : </b></span><span id="senha_registro"></span>
					</div>

					<div class="mb-2">
						<span><b>Data Nascimento : </b></span><span id="data_nasc_registro"></span>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-faded cores-button-confirmar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<!--Fim Modal Dados -->

</body>

</html>


<!-- Ajax chama Inclusão -->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Fim Ajax chama Inclusão -->

<!-- Ajax chama Modal Edição -->
<?php
if (@$_GET['funcao'] == 'editar') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!--Fim Ajax chama Modal Edição -->

<!-- Ajax chama Modal Exclusão -->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

		})

		myModal.show();
	</script>
<?php } ?>
<!--Fim Ajax chama Modal Exclusão -->

<!-- Ajax chama renderização imagem -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>
<!--Fim Ajax chama renderização imagem -->

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
<!--Fim Ajax para inserir ou editar dados -->

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
<!--Fim Ajax para excluir dados -->

<!-- Ajax para visualizar dados adicionais -->
<script type="text/javascript">
	function dados(nome, cep, rua, numero, bairro, cidade, estado, senha, imagem, datanasc) {
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
		$('#senha_registro').text(senha);
		$('#imagem_registro').attr('src', '../../assets/imagens/funcionarios/' + imagem);
		$('#data_nasc_registro').text(datanasc);

		var verModal = "Sem erro";
		//console.error(verModal);

		try{
			console.error(verModal);
			myModal.show();
		}catch(e) {
			verModal = "Deu Pau!!";
			event.preventDefault();
			console.error("Erro ao chamar Modal. O erro foi:" + e);
		} finally{
			verModal = "Deu Pau!!";
			event.preventDefault();
			console.error("Erro ao chamar Modal. O erro foi:" + error);
		}
		
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
			$('#target').attr('src', "../../assets/imagens/funcionarios/pdf.png");
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
<!-- FIM DO SCRIPT PARA CARREGAR IMAGEM -->