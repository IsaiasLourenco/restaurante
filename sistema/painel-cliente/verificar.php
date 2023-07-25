<?php 
@session_start();

$id_cargo = @$_SESSION['cargo'];
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if($nome_cargo != 'Cliente'){
    echo "<script language='javascript'>window.location='../'</script>";
    exit();
}

?>