<?php
require_once("../../../conexao.php");
@session_start();
$titulo = $_POST['titulo'];
$descricao_1 = $_POST['descricao_1'];
$descricao_2 = $_POST['descricao_2'];
$descricao_3 = $_POST['descricao_3'];
$tag = $_POST['tag'];
$id = $_POST['id'];
$id_usuario = $_SESSION['id'];

//MODIFICANDO O NOME DO TITULO PARA O CAMPO TITULO URL
$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-",
	strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ!?,;."),
		"aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$nome_novo = str_replace("?", "", $nome_novo);
$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../assets/imagens/blog/' .$nome_img;
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
	$query = $pdo->prepare("INSERT INTO blog SET titulo = :titulo, descricao_1 = :descricao_1, descricao_2 = :descricao_2, descricao_3 = :descricao_3, tag = :tag, imagem = :imagem, url_titulo = '$nome_url', autor = '$id_usuario', data_postagem = curDate()");
	$query->bindValue(":imagem", "$imagem");
}else{
	if($imagem == "sem-foto.jpg"){
		$query = $pdo->prepare("UPDATE blog SET titulo = :titulo, descricao_1 = :descricao_1, descricao_2 = :descricao_2, descricao_3 = :descricao_3, tag = :tag, url_titulo = '$nome_url', autor = '$id_usuario', data_postagem = curDate() WHERE id = '$id'");
	}else{
		$query = $pdo->prepare("UPDATE blog SET titulo = :titulo, descricao_1 = :descricao_1, descricao_2 = :descricao_2, descricao_3 = :descricao_3, tag = :tag, imagem = :imagem, url_titulo = '$nome_url', autor = '$id_usuario', data_postagem = curDate() WHERE id = '$id'");
		$query->bindValue(":imagem", "$imagem");
	}

}

$query->bindValue(":titulo", "$titulo");
$query->bindValue(":descricao_1", "$descricao_1");
$query->bindValue(":descricao_2", "$descricao_2");
$query->bindValue(":descricao_3", "$descricao_3");
$query->bindValue(":tag", "$tag");


$query->execute();

echo 'Salvo com Sucesso!';
?>