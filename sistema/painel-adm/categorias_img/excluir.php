<?php
require_once("../../../conexao.php");
require_once("../verificar.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM produtos WHERE categorias_img = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (@count($res) == 0) {
	$query1 = $pdo->query("SELECT * FROM pratos WHERE categorias_img = '$id'");
	$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);

	if (@count($res1) == 0) {
		$query2 = $pdo->query("SELECT * FROM imagens WHERE categorias_img = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

		if (@count($res2) == 0) {
			$pdo->query("DELETE from categorias_img WHERE id = '$id'");
		} else {
			echo 'Existe(m) ' . @count($res2) . ' prato(s) associado(s) a esta categoria, exclua primeiramente este(s)para depois excluir a categoria!';
		}
	} else {
		echo 'Existe(m) ' . @count($res1) . ' prato(s) associado(s) a esta categoria, exclua primeiramente este(s)para depois excluir a categoria!';
	}
} else {
	echo 'Existe(m) ' . @count($res) . ' produto(s) associado(s) a esta categoria, exclua primeiramente este(s)para depois excluir a categoria!';
}



echo 'Excluído com Sucesso!';
