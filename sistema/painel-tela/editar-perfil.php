<?php
require_once("../../conexao.php");
require_once("verificar.php");

$especialidade = $_POST['especialidade'];
$facebook = $_POST['facebook'];
$youtube = $_POST['youtube'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];

$id_cujo = $_POST['id_perfil'];

$query = $pdo->prepare("UPDATE chef SET especialidade = :especialidade, instagram = :instagram, youtube = :youtube, linkedin = :linkedin, facebook = :facebook WHERE funcionario = $id_cujo");

$query->bindValue(":especialidade", "$especialidade");
$query->bindValue(":instagram", "$instagram");
$query->bindValue(":youtube", "$youtube");
$query->bindValue(":linkedin", "$linkedin");
$query->bindValue(":facebook", "$facebook");
$query->execute();


echo 'Salvo com Sucesso!';
?>