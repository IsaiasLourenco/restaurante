<?php
require_once("../../conexao.php");
$id = $_POST['id_perfil'];
$nome = $_POST['nome_perfil'];
$cpf = $_POST['cpf_perfil'];
$email = $_POST['email_perfil'];
$telefone = $_POST['telefone_perfil'];
$cep = $_POST['cep_perfil'];
$rua = $_POST['rua_perfil'];
$numero = $_POST['numero_perfil'];
$bairro = $_POST['bairro_perfil'];
$cidade = $_POST['cidade_perfil'];
$estado = $_POST['estado_perfil'];
$senha = $_POST['senha_perfil'];

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../assets/imagens/produtos/' .$nome_img;
if (@$_FILES['imagem-perfil']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem-perfil']['tmp_name'];
$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}
if ($imagem == "sem-foto.jpg") {
    $query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha WHERE id = :id");   
} else {
    $query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha WHERE id = :id");
    $query->bindValue(":imagem", "$imagem");
}

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
$query->bindValue(":senha", "$senha");
$query->bindValue(":id", "$id");
$query->execute();

echo 'Salvo com Sucesso!';

?>