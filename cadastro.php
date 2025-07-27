<?php
require_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes - <?php echo $nome_site ?></title>

    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">

    <link rel="shortcut icon" href="assets/imagens/ico.ico" type="image/x-icon">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/meucss.css">
</head>

<body>

    <nav class="navbar navbar-default mu-main-navbar nav-leiLgpd" role="navigation">
        <div class="container">
            <div class="navbar-header">

                <!-- LOGO -->
                <a class="navbar-brand" href="index.php"><img src="assets/imagens/logo1.png" alt="Logo img"></a>
            </div>
            <a style="color:antiquewhite; text-align:right" href="index.php#mu-client-testimonial"><i class="fa-solid fa-right-from-bracket" style="color:antiquewhite; text-align:right;"></i> SAIR</a>
        </div>
    </nav>

    <form>
        <div class="testbox">
            <h1>Cadastre-se</h1>

            <form method="POST">
                <hr>
                <div class="accounttype">
                    &nbsp &nbsp &nbsp<i class="fa-solid fa-utensils" style="color:#c1a35f"></i>

                    <label><?php echo $nome_site ?></label=>

                </div>
                <hr>

                <label id="icon" for="email"><i class="icon-envelope "></i></label>
                <input type="text" name="email" id="email" placeholder="Email" tabindex="1" required />

                &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp
                <label id="icon" for="nome"><i class="icon-user"></i></label>
                <input type="text" name="nome" id="nome" placeholder="Nome" tabindex="2" required />

                &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp
                <label id="icon" for="senha"><i class="icon-shield"></i></label>
                <input type="password" name="senha" id="senha" placeholder="Senha" tabindex="3" required />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

                &nbsp &nbsp<i class="fa-solid fa-camera" style="color:#c1a35f"></i><label> Poste suas fotos e comente </label><i class="fa-solid fa-comments" style="color:#c1a35f"></i><br><br>



                <p>Ao se resgistrar, você concorda com nossos <a href="politica.php">termos e condições</a>.</p>
                <button style="border:none" type="submit" name="btn-cadastrar"><a href="#" class="button">Registro</a></button>

            </form>
        </div>
    </form>
</body>

</html>

<!-- Ajax Cadastro Cliente -->
<?php

if (isset($_POST['btn-cadastrar'])) {
    $hoje = date('Y-m-d');
    $email_novo = $_POST['email'];

    //BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
    $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo "<script language='javascript'>window.alert('E-mail já cadastrado!')</script>";
        echo "<script language='javascript'>window.location='cadastro.php'</script>";
        exit();
    }

    $queryCargo = $pdo->query("SELECT * FROM cargos WHERE nome = 'Cliente' ");
    $resCargo = $queryCargo->fetchAll(PDO::FETCH_ASSOC);
    $total_reg_cli = @count($resCargo);
    if ($total_reg_cli == 0) {

        //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
        $pdo->query("INSERT INTO cargos SET nome = 'Cliente'");
        $id_cargoNovoCli = $pdo->lastInsertId();

        $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
        $query->bindValue(":nome", $_POST['nome']);
        $query->bindValue(":email", $_POST['email']);
        $query->bindValue(":senha", $_POST['senha']);
        $query->bindValue(":cargo", $id_cargoNovoCli);
        $query->bindValue(":datacad", $hoje);
        $query->execute();
        $id_NovoFunc = $pdo->lastInsertId();
        $comentario = 'Alguma coisa a ser editada depois!!';

        $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
        $queryCli->bindValue(":funcionario", $id_NovoFunc);
        $queryCli->bindValue(":comentario", $comentario);
        $queryCli->execute();

        echo "<script language='javascript'>window.alert('Cadastrado com Sucess!!')</script>";
        echo "<script language='javascript'>window.location='index.php#mu-client-testimonial'</script>";
        exit();
    }
    $id_cargo = $resCargo[0]['id'];
    $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
    $query->bindValue(":nome", $_POST['nomeCad']);
    $query->bindValue(":email", $_POST['emailCad']);
    $query->bindValue(":senha", $_POST['senhaCad']);
    $query->bindValue(":datacad", $hoje);
    $query->bindValue(":cargo", $id_cargo);
    $query->execute();
    $id_NovoFunc = $pdo->lastInsertId();
    $comentario = 'Alguma coisa a ser editada depois!!';
    $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
    $queryCli->bindValue(":funcionario", $id_NovoFunc);
    $queryCli->bindValue(":comentario", $comentario);
    $queryCli->execute();

    echo "<script language='javascript'>window.alert('Cadastrado com Sucesso!!')</script>";
    echo "<script language='javascript'>window.location='index.php#mu-client-testimonial'</script>";
}
?>
<!-- Fim Ajax Cadastro Cliente -->