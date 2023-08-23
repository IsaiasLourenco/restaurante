<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

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
$query = $pdo->query("SELECT * FROM clientes WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];

if ($email != $email_banco) {
	$query = $pdo->prepare("SELECT * FROM clientes WHERE  email = :email");
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
	$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, email = :email, telefone = :telefone, comentario = :comentario, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha");
} else {
	$query = $pdo->prepare("UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone, comentario = :comentario, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":comentario", "$comentario");
$query->bindValue(":cep", "$cep");
$query->bindValue(":rua", "$rua");
$query->bindValue(":numero", "$numero");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":senha", "$senha");

$query->execute();

echo 'Salvo com Sucesso!';
