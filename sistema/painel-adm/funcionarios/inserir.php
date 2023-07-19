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
$data_nasc = $_POST['datanasc'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM funcionarios WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];

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

if ($id == "") {
	$query = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cargo = :cargo, datanasc = :data_nasc, datacad = curDate()");
} else {
	$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cargo = :cargo, datanasc = :datanasc, datacad = curDate() WHERE id = '$id'");
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
$query->bindValue(":datanasc", "$data_nasc");
$query->execute();
$id_funcionario = $pdo->lastInsertId();

//EDIÇÃO DE DADOS NA TABELA DOS USUÁRIOS <-- LINKADO --> À TABELA DE FUNCIONÁRIOS
if ($id == "") {
	$query = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = :cpf, email = :email, senha = '123', cargo = '$nome_cargo'");
} else {
	$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, senha = '123', cargo = '$nome_cargo' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email");
$query->execute();

if($nome_cargo == 'Chef'){
	$query = $pdo->prepare("INSERT INTO chef SET funcionario = '$id_funcionario	'");
}

$query->execute();

echo 'Salvo com Sucesso!';
