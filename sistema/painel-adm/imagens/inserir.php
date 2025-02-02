<?php
require_once("../../../conexao.php");

$id = $_POST['id'];
$categoria = $_POST['categorias_img'];

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') . '-' . @$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/', '-', $nome_img);

$caminho = '../../../assets/imagens/gallery/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {
	$imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
	move_uploaded_file($imagem_temp, $caminho);
} else {
	echo 'Extensão de Imagem não permitida!';
	exit();
}



if ($id == "") {
	$query = $pdo->prepare("INSERT INTO imagens SET categorias_img = :categoria, imagem = :imagem");
	$query->bindValue(":imagem", "$imagem");
} else {
	if ($imagem == "sem-foto.jpg") {
		$query = $pdo->prepare("UPDATE imagens SET categorias_img = :categoria WHERE id = '$id'");
	} else {
		$query = $pdo->prepare("UPDATE imagens SET categorias_img = :categoria, imagem = :imagem WHERE id = '$id'");
		$query->bindValue(":imagem", "$imagem");
	}
}

$query->bindValue(":categorias_img", "$categoria");
$query->execute();




echo 'Salvo com Sucesso!';
