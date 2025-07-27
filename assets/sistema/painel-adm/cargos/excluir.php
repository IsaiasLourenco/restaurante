<?php 
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) == 0){
	$pdo->query("DELETE from cargos WHERE id = '$id'");
}else{
	echo 'Existem '.@count($res).' funcionários associados a este cargo, exclua primeiramente estes funcionários para depois excluir o cargo!';
	exit();
}

echo 'Excluído com Sucesso!';
?>