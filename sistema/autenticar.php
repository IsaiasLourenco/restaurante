<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../conexao.php");
@session_start();

$nome = $_POST['nome'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM funcionarios WHERE (email = :nome OR cpf = :nome) AND senha = :senha");
$query->bindParam(":nome", $nome, PDO::PARAM_STR);
$query->bindParam(":senha", $senha, PDO::PARAM_STR);
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = count($res);
if ($total_reg > 0) {
    $_SESSION['nome'] = $res[0]['nome'];
    $_SESSION['cpf'] = $res[0]['cpf'];
    $_SESSION['email'] = $res[0]['email'];
    $_SESSION['cargo'] = $res[0]['cargo'];
    $id_cargo = $res[0]['cargo'];
    $_SESSION['id'] = $res[0]['id'];

    $query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $nome_cargo = !empty($res) ? $res[0]['nome'] : "Desconhecido";

    // Redirecionar conforme cargo
    if ($nome_cargo == 'Administrador') {
        header("Location: painel-adm");
        exit();
    } elseif ($nome_cargo == 'Chef') {
        header("Location: painel-chef");
        exit();
    } elseif ($nome_cargo == 'Recepcionista') {
        header("Location: painel-recep");
        exit();
    } elseif ($nome_cargo == 'Cliente') {
        header("Location: painel-cliente");
        exit();
    } elseif ($nome_cargo == 'Garçom') {
        header("Location: painel-garcon");
        exit();
    } elseif ($nome_cargo == 'Tela') {
        header("Location: painel-tela");
        exit();
    } else {
        echo "<script>window.alert('Dados incorretos!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
} else {
    echo "<script>
        window.alert('Dados incorretos!');
        window.location.href='index.php';
    </script>";
}