<?php

require_once("../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$senha = $_POST['senha'];

//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM clientes WHERE email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    echo 'Usuário já Cadastrado!';
    exit();
}

$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cep", "$cep");
$query->bindValue(":rua", "$rua");
$query->bindValue(":numero", "$numero");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":senha", "$senha");
$query->execute();

$res = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = '000.000.000-00', email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha, cargo='13', datacad = curDate(), imagem = 'sem-foto.jpg'");

$res->bindValue(":nome", "$nome");
$res->bindValue(":email", "$email");
$res->bindValue(":telefone", "$telefone");
$res->bindValue(":cep", "$cep");
$res->bindValue(":rua", "$rua");
$res->bindValue(":numero", "$numero");
$res->bindValue(":bairro", "$bairro");
$res->bindValue(":cidade", "$cidade");
$res->bindValue(":estado", "$estado");
$res->bindValue(":senha", "$senha");
$res->execute();
echo 'Salvo com Sucesso!';
