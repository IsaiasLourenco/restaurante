<?php

require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$comentario = $_POST['comentario'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$senha = $_POST['senha'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];

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

$res = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = '000.000.000-00', email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha, cargo='13', datacad = curDate(), imagem = 'sem-foto.jpg'");

$res->bindValue(":nome", "$nome");
$res->bindValue(":email", "$email");
$res->bindValue(":telefone", "$telefone");
$res->bindValue(":cep", "$cep");
$res->bindValue(":rua", "$rua");
$res->bindValue(":numero", "$numero");
$res->bindValue(":bairro", "$bairro");
$res->bindValue(":cidade", "$cidade");
$res->bindValue(":estado", "$estado");
$res->bindValue(":senha", "$senha");
$res->execute();
$id_funcionario = $pdo->lastInsertId();

$query1 = $pdo->prepare("INSERT INTO clientes SET funcionario = '$id_funcionario', comentario = :comentario");
$query1->bindValue(":comentario", "$comentario");
$query1->execute();

echo 'Salvo com Sucesso!';