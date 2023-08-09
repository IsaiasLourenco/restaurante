<?php
require_once("conexao.php");

$nome = @$res[0]['nome'];
$email = @$res[0]['email'];
$telefone = @$res[0]['telefone'];
$cep = @$res[0]['cep'];
$rua = @$res[0]['rua'];
$numero = @$res[0]['numero'];
$bairro = @$res[0]['bairro'];
$cidade = @$res[0]['cidade'];
$estado = @$res[0]['estado'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM clientes");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];

if ($email != $email_banco) {
	$query = $pdo->prepare("SELECT * FROM cllientes WHERE email = '$email'");
	$query->bindValue(":email", "$email");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if ($total_reg > 0) {
		echo 'Usuário já Cadastrado!';
		exit();
	}
}

$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado");

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
$query->execute();
echo 'Salvo com Sucesso!';
