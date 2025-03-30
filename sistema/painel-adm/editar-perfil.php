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

$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha WHERE id = :id");

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