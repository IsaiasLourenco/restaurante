<?php 
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM cargos WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_banco = @$res[0]['nome'];


if($nome != $nome_banco){
	$query = $pdo->prepare("SELECT * FROM cargos WHERE  nome = :nome");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Cargo já Cadastrado!';
		exit();
	}
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO cargos SET nome = :nome");
}else{
	$query = $pdo->prepare("UPDATE cargos SET nome = :nome WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->execute();



echo 'Salvo com Sucesso!';
?>