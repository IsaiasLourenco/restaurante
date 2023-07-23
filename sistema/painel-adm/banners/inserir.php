<?php
require_once("../../../conexao.php");

$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$descricao = $_POST['descricao'];
$link = $_POST['link'];
$id = $_POST['id'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM banners WHERE  id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$titulo_banco = @$res[0]['titulo'];

if($titulo != $titulo_banco){
	$query = $pdo->prepare("SELECT * FROM banners WHERE  titulo = :titulo");
	$query->bindValue(":titulo", "$titulo");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Banner já Cadastrado!';
		exit();
	}
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../assets/imagens/banners/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO banners SET titulo = :titulo, subtitulo = :subtitulo, link = :link, descricao = :descricao, imagem = :imagem");
	$query->bindValue(":imagem", "$imagem");
}else{
	if($imagem == "sem-foto.jpg"){
		$query = $pdo->prepare("UPDATE banners SET titulo = :titulo, subtitulo = :subtitulo, link = :link, descricao = :descricao WHERE id = '$id'");
	}else{
		$query = $pdo->prepare("UPDATE banners SET titulo = :titulo, subtitulo = :subtitulo, link = :link, descricao = :descricao, imagem = :imagem WHERE id = '$id'");
		$query->bindValue(":imagem", "$imagem");
	}
	
}

$query->bindValue(":titulo", "$titulo");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":subtitulo", "$subtitulo");
$query->bindValue(":link", "$link");

$query->execute();




echo 'Salvo com Sucesso!';
?>