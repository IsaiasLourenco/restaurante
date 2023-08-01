<?php 
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$mesa = $_POST['id_mesa'];
$obs = $_POST['obs'];
$garcom = $_POST['garcom'];

// $cpf_funcionario = $$_SESSION['cpf'];
// $query1 = $pdo->query("SELECT * FROM funcionarios WHERE cpf = '$cpf_funcionario'");
// $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
// $id_funcionario = $res1[0]['id'];

$query = $pdo->prepare("INSERT INTO pedidos SET mesa = :mesa,  obs = :obs, funcionario = :funcionario, data_pedido = curDate(), garcom = :garcom, status_pedido = 'Aberta'");


$query->bindValue(":garcom", "$garcom");
$query->bindValue(":mesa", "$mesa");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");


$query->execute();


echo 'Salvo com Sucesso!';
?>