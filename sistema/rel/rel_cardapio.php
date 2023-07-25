<?php
require_once("../../conexao.php");
require_once("verificar.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cardápio</title>
    <link rel="shortcut icon" href="../../assets/imagens/ico.ico" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        @page {
            margin: 0px;
        }

        body {
            margin-top: 15px;
        }

        <?php if ($relatorio_pdf == 'Sim') { ?>.footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 10px;
            position: absolute;
            bottom: 0;
        }

        <?php } else { ?>.footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 10px;

        }

        <?php } ?>.cabecalho {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            margin: auto
        }

        .titulo {
            margin: 0;
            font-size: 28px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;

        }

        .subtitulo {
            margin: 0;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;
        }

        .areaTotais {
            border: 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right: 25px;
            margin-left: 25px;
            position: absolute;
            right: 20;
        }

        .areaTotal {
            border: 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right: 25px;
            margin-left: 25px;
            background-color: #f9f9f9;
            margin-top: 2px;
        }

        .pgto {
            margin: 1px;
        }

        .fonte13 {
            font-size: 13px;
        }

        .esquerda {
            display: inline;
            width: 50%;
            float: left;
        }

        .direita {
            display: inline;
            width: 50%;
            float: right;
        }

        .table {
            padding: 15px;
            font-family: Verdana, sans-serif;
            margin-top: 20px;
        }

        .texto-tabela {
            font-size: 12px;
        }

        .esquerda_float {

            margin-bottom: 10px;
            float: left;
            display: inline;
        }

        .titulos {
            margin-top: 10px;
        }

        .image {
            margin-top: -10px;
        }

        .margem-direita {
            margin-right: 80px;
        }

        .margem-direita50 {
            margin-right: 50px;
        }

        hr {
            margin: 8px;
            padding: 1px;
        }

        .titulorel {
            margin: 0;
            font-size: 25px;
            font-family: Arial, Helvetica, sans-serif;
            color: #6e6d6d;

        }

        .margem-superior {
            margin-top: 30px;
        }

        .areaSubtituloCab {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .area-tab {

            display: block;
            width: 100%;
            height: 30px;

        }

        .coluna {
            margin: 0px;
            float: left;
            height: 30px;
        }

        hr .hr-table {

            padding: 2px;
            margin: 0px;
        }

        .titulo-cardapio {
            width: 100%;
            background-color: #bcbcbc;
            color: #333333;
            padding: 3px;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 10px;
            text-align: center;
        }

        .subtitulo-cardapio {
            width: 100%;
            background-color: #f7f7f7;
            padding: 3px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 10px;
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="img-cabecalho my-4">
        <img src="<?php echo $url_local ?>assets/imagens/topo.jpg" width="100%">
    </div>

    <div class="container">

        <div align="center" class="">
            <span class="titulorel"> </span>
        </div>

        <hr>


        <!--PERIODO DE APURAÇÃO
		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="esquerda_float margem-direita50">
					<span class=""> <b> Período da Apuração </b> </span>
				</div>
				<div class="esquerda_float margem-direita50">
					<span class=""> <?php //echo $apuracao
                                    ?> </span>
				</div>

			</div>
		</div>

		<hr>
	-->
        <!-- Início das categorias -->
        <small>
            <div class="titulo-cardapio">Nosso Cardápio</div>


            <!-- Categoria de Pratos -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Pratos'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_pratos = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Pratos</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_pratos' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_pratos' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Pratos -->

            <!-- Categoria de Drinks -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Drinks'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_drinks = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Drinks</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_drinks' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_drinks' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Drinks -->

            <!-- Categoria de Sobremesas -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Sobremesas'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_sobremesas = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Sobremesas</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_sobremesas' order by id desc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_sobremesas' order by id desc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Sobremesas -->

            <!-- Categoria de Carnes -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Carnes'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_carnes = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Carnes</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_carnes' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_carnes' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Carnes -->

            <!-- Categoria de Assados -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Assados'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_assados = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Assados</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_assados' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_assados' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Assados -->

            <!-- Categoria de Massas -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Massas'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_massas = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Massas</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_massas' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_massas' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Massas -->

            <!-- Categoria de Pizzas -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Pizzas'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_pizzas = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Pizzas</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_pizzas' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_pizzas' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Pizzas -->

            <!-- Categoria de Lanches -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Lanches'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_lanches = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Lanches</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_lanches' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_lanches' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Lanches -->

            <!-- Categoria de Petiscos -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Petiscos'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_petiscos = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Petiscos</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_petiscos' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_petiscos' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Petiscos -->

            <!-- Categoria de Peixes -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Peixes'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_peixes = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Peixes</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_peixes' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_peixes' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Peixes -->

            <!-- Categoria de Vegano -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Vegano'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_vegano = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Vegano</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_vegano' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_vegano' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Vegano -->

            <!-- Categoria de Bebidas -->
            <?php
            $query_cat = $pdo->query("SELECT * FROM categorias where nome = 'Bebidas'");
            $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
            $Itens = @count($res_cat);

            if ($Itens > 0) {
                $id_vegano = $res_cat[0]['id'];
            ?>
                <br><br>
                <div class="subtitulo-cardapio">Bebidas</div>
                <section class="area-tab">

                    <div class="linha-cab">
                        <div class="coluna" style="width:25%"><b>Nome</b></div>
                        <div class="coluna" style="width:15%"><b>Valor</b></div>
                        <div class="coluna" style="width:50%"><b>Descrição</b></div>
                        <div class="coluna" style="width:10%"><b>Foto</b></div>

                    </div>

                </section>

                <hr class="hr-table">

                <?php
                $query = $pdo->query("SELECT * FROM pratos where categoria = '$id_vegano' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/pratos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

                <?php
                $query = $pdo->query("SELECT * FROM produtos where categoria = '$id_vegano' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome = $res[$i]['nome'];
                    $valor_venda = $res[$i]['valor_venda'];
                    $descricao = $res[$i]['descricao'];
                    $foto = $res[$i]['imagem'];
                    $id = $res[$i]['id'];
                    $valor_venda = number_format($valor_venda, 2, ',', '.');
                ?>

                    <section class="area-tab">

                        <div class="linha-cab">
                            <div class="coluna" style="width:25%"><?php echo $nome ?> </div>
                            <div class="coluna" style="width:15%">R$ <?php echo $valor_venda ?> </div>
                            <div class="coluna" style="width:50%"> <?php echo $descricao ?> </div>
                            <div class="coluna" style="width:10%"><img src="<?php echo $url_local ?>assets/imagens/produtos/<?php echo $foto ?>" width="30px"> </div>
                        </div>

                    </section>

                    <hr class="hr-table">

                <?php } ?>

            <?php } ?>
            <!-- Fim da Categoria de Bebidas -->



        </small>

    </div>

    <div class="footer">
        <p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p>
    </div>

</body>

</html>