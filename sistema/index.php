<?php require_once("../conexao.php");

$queryTela = $pdo->query("SELECT * FROM cargos WHERE nome = 'Tela' ");
$resTela = $queryTela->fetchAll(PDO::FETCH_ASSOC);
$id_cargoTela = @$resTela[0]['id'];

$queryFuncTela = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id_cargoTela' ");
$resFuncTela = $queryFuncTela->fetchAll(PDO::FETCH_ASSOC);
$total_reg_tela = @count($resFuncTela);

if ($total_reg_tela == 0) {
    //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
    $pdo->query("INSERT INTO cargos SET nome = 'Tela'");
    $id_cargoNovaTela = $pdo->lastInsertId();

    //INSERIR UM USUARIO/FUNCIONARIO MODO TELA NA TABELA CASO NÃO EXISTA NENHUM
    $pdo->query("INSERT INTO funcionarios SET nome = 'Tela', cpf = '11212121211', email = 'tela@tela.com', telefone = '19990000000', cep = '13843184', rua = 'Mococa', numero = '880', bairro = 'Lot Parque Itacolomy', cidade = 'Mogi Guaçu', estado = 'SP', senha = '0808', cargo = '$id_cargoNovaTela', datacad = curDate(), datanasc = '1977-08-08', imagem = 'sem-foto.jpg'");
}

    $queryAdm = $pdo->query("SELECT * FROM cargos WHERE nome = 'Administrador' ");
    $resAdm = $queryAdm->fetchAll(PDO::FETCH_ASSOC);
    $id_cargoAdm = @$resAdm[0]['id'];

    $queryFuncAdm = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id_cargoAdm' ");
    $resAdm = $queryFuncAdm->fetchAll(PDO::FETCH_ASSOC);
    $total_reg_adm = @count($resAdm);

    if ($total_reg_adm == 0) {
        //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
        $pdo->query("INSERT INTO cargos SET nome = 'Administrador'");
        $id_cargoNovoAdm = $pdo->lastInsertId();

        //INSERIR UM USUARIO/FUNCIONARIO NA TABELA CASO NÃO EXISTA NENHUM
        $pdo->query("INSERT INTO funcionarios SET nome = 'Isaias', cpf = '24707435831', email = 'isaias.lourenco@outlook.com', telefone = '19996745466', cep = '13843184', rua = 'Mococa', numero = '880', bairro = 'Lot Parque Itacolomy', cidade = 'Mogi Guaçu', estado = 'SP', senha = '0808', cargo = '$id_cargoNovoAdm', datacad = curDate(), datanasc = '1977-08-08', imagem = 'sem-foto.jpg'");
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
    <!-- <link rel="shortcut icon" href="../assets/imagens/ico.ico" type="image/x-icon"> -->
    <link rel="shortcut icon" href="../assets/imagens/ico.ico">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- Theme color -->
    <link id="switcher" href="../assets/css/theme-color/default-theme.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
                                    <br>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>