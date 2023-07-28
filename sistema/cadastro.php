<?php
@session_start();
require_once("../conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>CADASTRO DE CLIENTES</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="vendor/css//cadastro.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../sistema/vendor/css/h2.css">

    <link rel="stylesheet" href="../vendor/css/h2.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../assets/imagens/logo1.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </div>
    </nav>
    <h2>CADASTRO DE CLIENTES</h2>

    <span id="msgAlerta" style="text-align: center;"></span>
    <!-- <form method="post" id="form"> -->
    <form class="form-horizontal" method="post" id="form-cliente">

        <fieldset>

            <div class="panel-body">
                <div class="form-group">

                    <div class="col-md-11 control-label">
                        <p class="help-block">
                            <h11>* </h11><strong>Campo Obrigatório</strong>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <!-- Text input-->

                    <input type="hidden" name="url" id="url" value="<?php echo $url_local; ?>clientes">

                    <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>
                    <div class="col-md-5">
                        <input id="nome" name="nome" class="form-control input-md" type="text">
                    </div>

                    <!-- Prepended text-->
                    <label class="col-md-2 control-label" for="prependedtext">Celular <h11>*</h11></label>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input id="prependedtext" name="telefone" class="form-control" placeholder="XX XXXXX-XXXX" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$" OnKeyPress="formatar('## #####-####', this)">
                        </div>
                    </div>

                </div>

                <!-- Prepended text-->
                <div class="form-group">
                    <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="prependedtext" name="email" class="form-control" placeholder="email@email.com" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                        </div>
                    </div>
                </div>

                <!-- Search input-->
                <div class="form-group">
                    <label class="col-md-2 control-label" for="CEP">CEP <h11>*</h11></label>
                    <div class="col-md-2">
                        <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" type="search" maxlength="8" pattern="[0-9]+$">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0" onclick="pesquisacep(cep.value)">Pesquisar</button>
                    </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                    <label class="col-md-2 control-label" for="prependedtext">Endereço</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">Rua</span>
                            <input id="rua" name="rua" class="form-control" readonly type="text">
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="input-group-addon">Nº <h11>*</h11></span>
                            <input id="numero" name="numero" class="form-control" type="text">
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">Bairro</span>
                            <input id="bairro" name="bairro" class="form-control" readonly type="text">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="prependedtext"></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">Cidade</span>
                            <input id="cidade" name="cidade" class="form-control" readonly type="text">
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="input-group-addon">Estado</span>
                            <input id="estado" name="estado" class="form-control" readonly type="text">
                        </div>

                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Cadastrar"></label>

                    <input type="submit" name="cadCli" id="cadCli" value="Cancelar" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0">

                    <input type="submit" name="cadCli" id="cadCli" value="Cadastrar" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">

					<!-- <div class="col-md-8">
						<button type="button" class="btn btn-faded" data-bs-dismiss="modal" id="btn-fechar" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0">Cancelar</button>
						<button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Cadastrar</button>
					</div> -->

                </div>

            </div>

        </fieldset>

    </form>

    <script src="vendor/js/cadastro.js"></script>
    <script src="vendor/js/cadCli.js"></script>
    
</body>

</html>