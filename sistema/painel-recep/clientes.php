<?php
$pagina = 'clientes';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../assets/css/meucss.css">
	<link rel="stylesheet" href="../../assets/css/font-awesome.css">
</head>

<body>
	<h2>CLIENTES</h2>
	<a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn cores-button-confirmar-novo">Novo Cliente</a>

	<small>
		<table id="example" class="table table-hover table-sm my-4" style="width:98%;">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Senha</th>
					<th>Ações</th>

				</tr>
			</thead>
			<tbody>
				<?php

				$query1 = $pdo->query("SELECT * FROM cargos WHERE nome = 'Cliente'");
				$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
				$id_cargo = $res1[0]['id'];

				$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id_cargo' ORDER BY id ASC");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				for ($i = 0; $i < @count($res); $i++) {
					foreach ($res[$i] as $key => $value) {
					}
					$id_reg = $res[$i]['id'];

					$query1 = $pdo->query("SELECT * FROM clientes WHERE funcionario = '$id_reg'");
					$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
					@$id_cli = $res1[0]['id'];
					@$id_func = $res1[0]['funcionario'];

				?>
					<tr>
						<td><?php echo $res[$i]['nome'] ?></td>
						<td><?php echo $res[$i]['email'] ?></td>
						<td><?php echo $res[$i]['telefone'] ?></td>
						<td><?php echo $res[$i]['senha'] ?></td>

						<td>
							<a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
								<i class="bi bi-pencil-square mr-1 text-primary"></i></a>

							<a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
								<i class="bi bi-trash text-danger"></i></a>

							<a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $res[$i]["cep"] ?>', '<?php echo $res[$i]["rua"] ?>', '<?php echo $res[$i]["numero"] ?>', '<?php echo $res[$i]["bairro"] ?>', '<?php echo $res[$i]["cidade"] ?>', '<?php echo $res[$i]["estado"] ?>', '<?php echo $res1[0]['comentario'] ?>')" title="Ver Dados">
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
						$botao_modal = "btn-cadastrar";
					} else {
						$titulo_modal = 'Editar Registro';
						$botao_modal = "btn-editar";
						$id = @$_GET['id'];
						$query = $pdo->query("SELECT * FROM clientes WHERE  funcionario = '$id'");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$comentario = @$res[0]['comentario'];

						$query1 = $pdo->query("SELECT * FROM funcionarios WHERE  id = '$id'");
						$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
						$nome_cli = @$res1[0]['nome'];
						$email = @$res1[0]['email'];
						$telefone_forn = @$res1[0]['telefone'];
						$cep = @$res1[0]['cep'];
						$rua = @$res1[0]['rua'];
						$numero = @$res1[0]['numero'];
						$bairro = @$res1[0]['bairro'];
						$cidade = @$res1[0]['cidade'];
						$estado = @$res1[0]['estado'];
						$senha = @$res1[0]['senha'];
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
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_cli ?>" required>
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

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Comentário </label>
							<textarea class="form-control" type="text" name="comentario" id="comentario" maxlength="2000"><?php echo @$comentario ?></textarea>
						</div>

						<div class="row">

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

						</div>

						<div class="row">

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cidade </label>
									<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Estado </label>
									<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" value="<?php echo @$estado ?>" readonly>
								</div>
							</div>

							<div class="col-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Senha </label>
									<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha ?>" required>
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

						<button type="button" class="btn cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>

						<button type="submit" class="btn cores-button-confirmar" name="<?php echo $botao_modal ?>">Salvar</button>

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

						<button type="button" class="btn cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>

						<button type="submit" class="btn cores-button-confirmar" name="btn-excluir">Excluir</button>

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

					<div class="mb-2">
						<span><b>Comentário : </b></span><span id="comentario_registro"></span>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn cores-button-confirmar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<!--Fim do Modal Dados -->
</body>

</html>

<!-- CHAMA MODAL NOVO -->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
	<script>
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'));
		{
			backdrop: 'static'
		}
		myModal.show();
	</script>
<?php }
?>
<!-- FIM CHAMA MODAL NOVO -->

<!-- Ajax chama Inclusão e Edição -->
<?php
if (@$_GET['funcao'] == 'editar') { ?>
	<script>
		var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>
<!-- Ajax chama Inclusão e Edição -->

<!-- Ajax chama Exclusão -->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

		})

		myModal.show();
	</script>
<?php } ?>
<!-- Ajax chama Exclusão -->

<!-- Ordena -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	});
</script>
<!-- Ordena -->

<!-- Script Cadastro Cliente -->
<?php
if (isset($_POST['btn-cadastrar'])) {

	$email_novo = $_POST['email'];
	@$cpf_novo = $_POST['cpf'];

	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$queryC = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo' OR cpf = '$cpf_novo'");
	$res = $queryC->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo "<script language='javascript'>window.alert('Esse registro já está existe!')</script>";
		echo "<script language='javascript'>window.location='index.php'</script>";
		exit();
	}

	$hoje = date('Y-m-d');
	$cpf = '000.000.000-00';
	$query1 = $pdo->query("SELECT * FROM cargos WHERE nome = 'Cliente'");
	$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
	$id_cg = $res1[0]['id'];
	$imagem = 'Sem-foto.jpg';
	$query = $pdo->prepare("INSERT INTO funcionarios (nome, cpf, email, telefone, cep, rua, numero, bairro, cidade, estado, senha, cargo, datanasc, datacad, imagem) VALUES (:nome, :cpf, :email, :telefone, :cep, :rua, :numero, :bairro, :cidade, :estado, :senha, :cargo, :datanasc, :datacad, :imagem)");
	$query->bindValue(":nome", $_POST['nome']);
	$query->bindValue(":cpf", $cpf);
	$query->bindValue(":email", $_POST['email']);
	$query->bindValue(":telefone", $_POST['telefone']);
	$query->bindValue(":cep", $_POST['cep']);
	$query->bindValue(":rua", $_POST['rua']);
	$query->bindValue(":numero", $_POST['numero']);
	$query->bindValue(":bairro", $_POST['bairro']);
	$query->bindValue(":cidade", $_POST['cidade']);
	$query->bindValue(":estado", $_POST['estado']);
	$query->bindValue(":senha", $_POST['senha']);
	$query->bindValue(":cargo", $id_cg);
	$query->bindValue(":datanasc", $hoje);
	$query->bindValue(":datacad", $hoje);
	$query->bindValue(":imagem", $imagem);
	$query->execute();
	$id_funcionario = $pdo->lastInsertId();

	$queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
	$queryCli->bindValue(":funcionario", $id_funcionario);
	$queryCli->bindValue(":comentario", $_POST['comentario']);
	$queryCli->execute();

	echo "<script language='javascript'>window.alert('Cadastrado com Sucess!!')</script>";
	echo "<script language='javascript'>window.location='index.php?pag=clientes'</script>";
	exit();
}
?>
<!-- Fim Script Cadastro Cliente -->

<!-- Script Edição Cliente -->
<?php
if (isset($_POST['btn-editar'])) {

	$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha WHERE id = :id");
	$query->bindValue(":nome", $_POST['nome']);
	$query->bindValue(":email", $_POST['email']);
	$query->bindValue(":telefone", $_POST['telefone']);
	$query->bindValue(":cep", $_POST['cep']);
	$query->bindValue(":rua", $_POST['rua']);
	$query->bindValue(":numero", $_POST['numero']);
	$query->bindValue(":bairro", $_POST['bairro']);
	$query->bindValue(":cidade", $_POST['cidade']);
	$query->bindValue(":estado", $_POST['estado']);
	$query->bindValue(":senha", $_POST['senha']);
	$query->bindValue(":id", $_GET['id']);
	$query->execute();

	$queryCli = $pdo->prepare("UPDATE clientes SET comentario = :comentario WHERE funcionario = :id");
	$queryCli->bindValue(":comentario", $_POST['comentario']);
	$queryCli->bindValue(":id", $_GET['id']);
	$queryCli->execute();

	echo "<script language='javascript'>window.alert('Editado com Sucesso!!')</script>";
	echo "<script language='javascript'>window.location='index.php?pag=clientes'</script>";
	exit();
}

?>
<!-- Fim Script Edição Cliente -->

<!-- Script Excluir Cliente -->
<?php
if (isset($_POST['btn-excluir'])) {

	$query = $pdo->query("DELETE FROM funcionarios WHERE id = '$_GET[id]'");
	$queryCli = $pdo->query("DELETE FROM clientes WHERE funcionario = '$_GET[id]'");
	echo "<script language='javascript'>window.alert('Será?')</script>";
	echo "<script language='javascript'>window.location='index.php?pag=clientes'</script>";
	exit();
}

?>
<!-- Fim Script Excluir Cliente -->

<!-- Ajax para excluir dados -->
<!-- <script type="text/javascript">
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
</script> -->
<!-- Ajax para excluir dados -->

<!-- Ajax chama Modal Dados -->
<script type="text/javascript">
	function dados(nome, cep, rua, numero, bairro, cidade, estado, comentario) {
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
		$('#comentario_registro').text(comentario);
	}
</script>
<!-- Ajax chama Modal Dados -->