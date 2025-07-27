<?php 
require_once("../../../conexao.php");
require_once("../verificar.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM mesas WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_banco = @$res[0]['nome'];


if($nome != $nome_banco){
	$query = $pdo->prepare("SELECT * FROM mesas WHERE  nome = :nome");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Mesa já Cadastrada!';
		exit();
	}
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO mesas SET nome = :nome, descricao = :descricao");
}else{
	$query = $pdo->prepare("UPDATE mesas SET nome = :nome, descricao = :descricao WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->execute();



echo 'Salvo com Sucesso!';
?>