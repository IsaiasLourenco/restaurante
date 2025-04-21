<?php 
@session_start();
// require_once("../../conexao.php");
require_once(__DIR__ . "/../../conexao.php");

$id_cargo = @$_SESSION['cargo'];
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if($nome_cargo != 'Administrador'){
    header("Location: ../");
    exit();
}

?>