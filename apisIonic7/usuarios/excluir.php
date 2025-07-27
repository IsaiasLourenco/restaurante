<?php
require_once('../conexao.php');
$postjson = json_decode(file_get_contents('php://input'), true);

$id = @$postjson['id'];

$res = $pdo->query("DELETE FROM usuarios where id = '$id'");

$result = json_encode(array('mensagem' => 'Excluído com Sucesso', 'ok' => true));
echo $result;
