<?php
session_start();
require_once("../../conexao.php");
$nome = $_POST['nome_perfil'];
$email = $_POST['email_perfil'];
$cpf = $_POST['cpf_perfil'];
$senha = $_POST['senha_perfil'];
$id = $_SESSION['id'];

$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cpf_banco = $res[0]['cpf'];
$email_banco = $res[0]['email'];

if ($cpf != $cpf_banco) {
    $query = $pdo->prepare("SELECT * FROM funcionarios WHERE cpf = :cpf");
    $query->bindValue(":cpf", "$cpf");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo 'CPF já cadastrado';
        exit();
    }
}

if ($email != $email_banco) {
    $query = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email");
    $query->bindValue(":email", "$email");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo 'Email já cadastrado';
        exit();
    }
}

$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha WHERE id = :id");
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":senha", "$senha");
$query->bindValue(":id", "$id");
$query->execute();

echo 'Salvo com Sucesso!';
