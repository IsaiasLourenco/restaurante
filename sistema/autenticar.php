<?php
require_once("../conexao.php");
@session_start();
$nome = $_POST['nome'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM funcionarios WHERE (email = :nome OR cpf = :nome) AND senha = :senha");
$query->bindValue(":nome", "$nome");
$query->bindValue(":senha", "$senha");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    $_SESSION['nome'] = $res[0]['nome'];
    $_SESSION['cpf'] = $res[0]['cpf'];
    $_SESSION['email'] = $res[0]['email'];
    $_SESSION['cargo'] = $res[0]['cargo'];
    $_SESSION['id'] = $res[0]['id'];

    //REDIRECIONAR CONFORME CARGO
    if($res[0]['cargo'] == '1'){
        echo "<script language='javascript'> window.location='painel-adm' </script>";
    }else if ($res[0]['cargo'] == '3'){
        echo "<script language='javascript'> window.location='painel-chef' </script>";
    }else{
        echo "<script language='javascript'> window.location='index.php'</script>";
    }

};
