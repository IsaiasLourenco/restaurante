<?php 
require_once("../../../conexao.php");
require_once("../verificar.php");

$nome = $_POST['nome'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM categorias_img WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_banco = @$res[0]['nome'];


if($nome != $nome_banco){
	$query = $pdo->prepare("SELECT * FROM categorias_img WHERE  nome = :nome");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Categoria já Cadastrada!';
		exit();
	}
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO categorias_img SET nome = :nome");
}else{
	$query = $pdo->prepare("UPDATE categorias_img SET nome = :nome WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->execute();



echo 'Salvo com Sucesso!';
?>