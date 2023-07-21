<?php require_once("../conexao.php");

$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '1' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg == 0) {
    //INSERIR UM USUARIO/FUNCIONARIO NA TABELA CASO NÃO EXISTA NENHUM
    $pdo->query("INSERT INTO funcionarios SET nome = 'Isaias', cpf = '24707435831', email = 'isaias.lourenco@outlook.com', telefone = '19996745466', cep = '13843184', rua = 'Mococa', numero = '880', bairro = 'Lot Parque Itacolomy', cidade = 'Mogi Guaçu', estado = 'SP', senha = '0808', cargo = '1', datacad = curDate(), datanasc = '1977-08-08', imagem = ''");
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN - <?php echo $nome_site ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/imagens/ico.ico" type="image/x-icon">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- -->
    <link href="vendor/css/login.css" rel="stylesheet">
    <!-- Theme color -->
    <link id="switcher" href="../assets/css/theme-color/default-theme.css" rel="stylesheet">
    
</head>

<body>
    <!-- Start Login section -->
    <div class="container">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <form id="login-form" class="form" action="autenticar.php" method="post">
                                <h3 class="text-center text-info"><img src="../assets/imagens/logo1.png" width="150px"></h3>
                                <div class="form-group">
                                    <label for="username" class="">CPF ou e-mail</label><br>
                                    <input type="text" name="nome" id="nome" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="">Senha</label><br>
                                    <input type="password" name="senha" id="senha" class="form-control" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="remember-me" class="text-light"><span>Me manter conectado</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                    <input type="submit" name="submit" class="btn btn-faded btn-md" style="background-color:#c1a35f; border-color:#f5f0f0; color:#333333" value="Logar">
                                </div>

                                <div id="register-link" class="text-light" style="text-align: right;">
                                    <a href="cadastro.php" target="_blank" class="text-light">Faça seu cadastro</a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login section -->

</body>

</html>