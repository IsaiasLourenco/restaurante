<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$nome = $_POST['nome'];
$cnpj = $_POST['cnpj'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$categoria = $_POST['categoria'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM fornecedores WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];
$cnpj_banco = @$res[0]['cnpj'];

//BUSCAR O ID DO NOME DA CATEGORIA RELACIONADA
$query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_cat = $res2[0]['nome'];

if ($email != $email_banco) {
	$query = $pdo->prepare("SELECT * FROM fornecedores WHERE  email = :email");
	$query->bindValue(":email", "$email");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo 'Email já Cadastrado!';
		exit();
	}
}

if ($cnpj != $cnpj_banco) {
	$query = $pdo->prepare("SELECT * FROM fornecedores WHERE  cnpj = :cnpj");
	$query->bindValue(":cnpj", "$cnpj");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo 'CNPJ já Cadastrado!';
		exit();
	}
}

if ($id == "") {
	$query = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, categoria = :categoria");
} else {
	$query = $pdo->prepare("UPDATE fornecedores SET nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, categoria = :categoria WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":cnpj", "$cnpj");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cep", "$cep");
$query->bindValue(":rua", "$rua");
$query->bindValue(":numero", "$numero");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":categoria", "$categoria");

$query->execute();

echo 'Salvo com Sucesso!';
