<?php
require_once('../conexao.php');
$postjson = json_decode(file_get_contents('php://input'), true);

$nome = $postjson['nome'];
$email = $postjson['email'];
$cpf = $postjson['cpf'];
$senha = $postjson['senha'];
$nivel = $postjson['nivel'];
$id = @$postjson['id'];
$antigo = @$postjson['antigo'];
$antigo2 = @$postjson['antigo2'];

if ($nome == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Nome!'));
    exit();
}

if ($email == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Email!'));
    exit();
}

if ($cpf == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo CPF!'));
    exit();
}

if ($senha == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Senha!'));
    exit();
}

if ($nivel == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Nível!'));
    exit();
}


// EVITAR DUPLICIDADE NO EMAIL
if ($antigo != $email) {

    $query_con = $pdo->prepare("SELECT * from usuarios WHERE email = :email");
    $query_con->bindValue(":email", $email);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res_con) > 0) {
        echo json_encode(array('mensagem' => 'Email já Cadastrado!'));
        exit();
    }
}


if ($antigo2 != $cpf) {
    // EVITAR DUPLICIDADE NO CPF
    $query_con = $pdo->prepare("SELECT * from usuarios WHERE cpf = :cpf");
    $query_con->bindValue(":cpf", $cpf);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if (@count($res_con) > 0) {
        echo json_encode(array('mensagem' => 'CPF já Cadastrado!'));
        exit();
    }
}

if ($id == "") {
    $res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel");
} else {
    $res = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel WHERE id = :id");
    $res->bindValue(":id", $id);
}

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":senha", $senha);
$res->bindValue(":nivel", $nivel);
$res->execute();


$result = json_encode(array('mensagem' => 'Salvo com Sucesso', 'ok' => true));
echo $result;
