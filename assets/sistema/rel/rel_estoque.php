<?php
require_once("../../conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estoque</title>
    <link rel="shortcut icon" href="../../assets/imagens/ico.ico" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        @page {
            margin: 0px;

        }

        .footer {
            margin-top: 20px;
            width: 100%;
            background-color: #ebebeb;
            padding: 10px;
            position: absolute;
            bottom: 0;
        }

        .cabecalho {
            background-color: #ebebeb;
            padding: 10px;
            margin-bottom: 30px;
            width: 100%;
            height: 100px;
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
    </style>
</head>

<body>

        <div class="img-cabecalho my-4">
            <img src="<?php echo $url_local ?>/assets/imagens/topo.jpg" width="100%">
        </div>    

    <div class="container">

        <div align="center" class="">
            <span class="titulorel">Produtos com necessidade de compra</span>
        </div>

        <table class='table' width='100%' cellspacing='0' cellpadding='3'>
            <tr bgcolor='#f9f9f9'>
                <th>Nome</th>
                <th>Valor Compra</th>
                <th>Valor Venda</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
                <th>Estoque</th>
                <th>Imagem</th>


            </tr>
            <?php

            $query = $pdo->query("SELECT * FROM produtos WHERE estoque < '$nivel_estoque' ORDER BY id ASC");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            $totalItens = @count($res);

            for ($i = 0; $i < @count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }
                $nome = $res[$i]['nome'];
                $valor_compra = $res[$i]['valor_compra'];
                $valor_venda = $res[$i]['valor_venda'];
                $id_cat = $res[$i]['categoria'];
                $id_forn = $res[$i]['fornecedor'];
                $estoque = $res[$i]['estoque'];
                $foto = $res[$i]['imagem'];
                $id = $res[$i]['id'];

                $query = $pdo->query("SELECT * FROM categorias WHERE id = '$id_cat'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i=0; $i < @count($res) ; $i++) { 
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome_cat = $res[$i]['nome'];
                }

                $query = $pdo->query("SELECT * FROM fornecedores WHERE id = '$id_forn'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);
                for ($i=0 ; $i < @count($res)  ; $i++ ) { 
                    foreach ($res[$i] as $key => $value) {
                    }
                    $nome_forn = $res[$i]['nome'];
                }

                $valor_compra = number_format($valor_compra, 2, ',', '.');
                $valor_venda = number_format($valor_venda, 2, ',', '.');
            ?>

                <tr>

                    <td style="width: auto;"><?php echo $nome ?> </td>
                    <td style="width: auto;">R$ <?php echo $valor_compra ?> </td>
                    <td style="width: auto;">R$ <?php echo $valor_venda ?> </td>
                    <td style="width: auto;"><?php echo $nome_cat ?> </td>
                    <td style="width: auto;"><?php echo $nome_forn ?> </td>
                    <td style="width: auto;"><?php echo $estoque ?> </td>
                    <td style="width: auto;"><img src="<?php echo $url_local ?>/assets/imagens/produtos/<?php echo $foto ?>" width="35px"> </td>


                </tr>
            <?php } ?>

        </table>

        <div class="row margem-superior">
            <div class="col-md-12">
                <div class="" align="right">

                    <span class=""> <b> Total de Produtos : <?php echo $totalItens ?> </b> </span>
                </div>

            </div>
        </div>

    </div>

    <div class="footer">
        <p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p>
    </div>
</body>

</html>