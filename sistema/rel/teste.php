<?php
@session_start();
require_once("../../conexao.php");

//recuperar os dados do usuário
$id_usuario = $_SESSION['id'];
$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
  $nome_usu = $res[0]['nome'];
  $email_usu = $res[0]['email'];
  $cpf_usu = $res[0]['cpf'];
  $telefone_usu = $res[0]['telefone'];
  $cep_usu = $res[0]['cep'];
  $rua_usu = $res[0]['rua'];
  $numero_usu = $res[0]['numero'];
  $bairro_usu = $res[0]['bairro'];
  $cidade_usu = $res[0]['cidade'];
  $estado_usu = $res[0]['estado'];
  $datanasc = $res[0]['datanasc'];
  $datacad_usu = $res[0]['datacad'];
  $senha_usu = $res[0]['senha'];
  $nivel_usu = $res[0]['cargo'];
  $foto_perfil = $res[0]['imagem'];
} else {
  $foto_perfil = 'sem-foto.jpg';
}

?>
