<?php
require_once("../../../conexao.php");


$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cargo = $_POST['cargo'];
$senha = $_POST['senha'];
$datanasc = $_POST['datanasc'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM funcionarios WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];
$cpf_banco = @$res[0]['cpf'];

//BUSCAR O ID DO NOME DA CATEGORIA RELACIONADA
$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res2[0]['nome'];

if ($email != $email_banco) {
	$query = $pdo->prepare("SELECT * FROM funcionarios WHERE  email = :email");
	$query->bindValue(":email", "$email");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo 'Email já Cadastrado!';
		exit();
	}
}

if ($cpf != $cpf_banco) {
	$query = $pdo->prepare("SELECT * FROM funcionarios WHERE  cpf = :cpf");
	$query->bindValue(":cpf", "$cpf");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo 'CPF já Cadastrado!';
		exit();
	}
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../../assets/imagens/funcionarios/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {
	$imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'JPG' or $ext == 'jpeg' or $ext == 'gif') {
	move_uploaded_file($imagem_temp, $caminho);
} else {
	echo 'Extensão de Imagem não permitida!';
	exit();
}

if ($id == "") {
	$query = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cargo = :cargo, senha = :senha, datanasc = :datanasc, datacad = curDate(), imagem = :imagem");
	$query->bindValue(":imagem", "$imagem");
} else {
	if ($imagem == "sem-foto.jpg") {
		$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cargo = :cargo, senha = :senha, datanasc = :datanasc, datacad = curDate() WHERE id = '$id'");
	} else {
		$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cargo = :cargo, senha = :senha, datanasc = :datanasc, datacad = curDate(), imagem = :imagem WHERE id = '$id'");
		$query->bindValue(":imagem", "$imagem");
	}
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cep", "$cep");
$query->bindValue(":rua", "$rua");
$query->bindValue(":numero", "$numero");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":cargo", "$cargo");
$query->bindValue(":senha", "$senha");
$query->bindValue(":datanasc", "$datanasc");
$query->execute();
$id_funcionario = $pdo->lastInsertId();

//BUSCAR O NOME DO CARGO
$query = $pdo->query("SELECT * FROM cargos WHERE  id = '$cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = @$res[0]['nome'];

if($nome_cargo == 'Chef'){
	$query = $pdo->prepare("INSERT INTO chef SET funcionario = $id_funcionario");
}

if($nome_cargo == 'Cliente'){
	$query = $pdo->prepare("INSERT INTO clientes SET funcionario = $id_funcionario");
}

$query->execute();
echo 'Salvo com Sucesso!';
