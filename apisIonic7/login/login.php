<?php
require_once('../conexao.php');
$postjson = json_decode(file_get_contents('php://input'), true);

$usuario = $postjson['usuario'];
$senha = $postjson['senha'];


if ($usuario == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Usuário!'));
    exit();
}

if ($senha == "") {
    echo json_encode(array('mensagem' => 'Preencha o Campo Senha!'));
    exit();
}


$query_con = $pdo->prepare("SELECT * from usuarios WHERE (email = :usuario or cpf = :usuario) and senha = :senha");
$query_con->bindValue(":usuario", $usuario);
$query_con->bindValue(":senha", $senha);
$query_con->execute();
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {

    $dados = array(
        'id' => $res[0]['id'],
        'nome' => $res[0]['nome'],
        'email' => $res[0]['email'],
        'cpf' => $res[0]['cpf'],
        'senha' => $res[0]['senha'],
        'nivel' => $res[0]['nivel'],
        
    );

    $result = json_encode(array('mensagem' => 'Logado com Sucesso', 'ok' => true, 'usu'=>$dados));
    echo $result;
}else{
    $result = json_encode(array('mensagem' => 'Dados incorretos', 'ok' => false));
    echo $result;
}




