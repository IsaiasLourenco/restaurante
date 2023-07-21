<?php 
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM fornecedores WHERE categoria = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) == 0){
	$pdo->query("DELETE from categorias WHERE id = '$id'");
}else{
	echo 'Existem '.@count($res).' fornecedores associados a este cargo, exclua primeiramente estes fornecedores para depois excluir a categoria!';
	exit();
}

echo 'Excluído com Sucesso!';
?>