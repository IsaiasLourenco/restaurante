<?php
require_once("../../conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if ($dataInicial != $dataFinal) {
    $apuracao = $dataInicialF . ' até ' . $dataFinalF;
} else {
    $apuracao = $dataInicialF;
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Pedidos</title>
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


    <?php if ($cabecalho_img_rel == 'Sim') { ?>


        <div class="img-cabecalho my-4">
            <img src="<?php echo $url_local ?>assets/imagens/topo.jpg" width="100%">
        </div>

    <?php } else { ?>


        <div class="cabecalho">

            <div class="row titulos">
                <div class="col-sm-2 esquerda_float image">
                    <img src="<?php echo $url_local ?>assets/imagens/logo1.png" width="90px" alt="Batman">
                </div>
                <div class="col-sm-10 esquerda_float">
                    <h2 class="titulo"><b><?php echo strtoupper($nome_site) ?></b></h2>

                    <div class="areaSubtituloCab">
                        <h6 class="subtitulo"><?php echo $endereco . ' Tel: ' . $whatsapp  ?></h6>

                        <p class="subtitulo"><?php echo $data_hoje ?></p>
                    </div>

                </div>
            </div>

        </div>

    <?php } ?>

    <div class="container">


        <div align="center" class="">
            <span class="titulorel">Relatório de Pedidos</span>
        </div>
        <small>
            <table class='table' width='100%' cellspacing='0' cellpadding='3'>
                <tr bgcolor='#f9f9f9'>
                    <th style="text-align: center;">Pago</th>
                    <th style="text-align: center;">Subtotal</th>
                    <th style="text-align: center;">Serviço</th>
                    <th style="text-align: center;">Couvert</th>
                    <th style="text-align: center;">Total</th>
                    <th style="text-align: center;">Mesa</th>
                    <th style="text-align: center;">Data</th>
                    <th style="text-align: center;">Garçom</th>
                </tr>

                <?php
                $query = $pdo->query("SELECT * FROM pedidos WHERE data_pedido >= '$dataInicial' AND data_pedido <= '$dataFinal' AND valor > 0 ORDER BY data_pedido ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $totalItens = @count($res);

                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $data = $res[$i]['data_pedido'];
                    $id_garcom = $res[$i]['garcom'];

                    //BUSCAR O NOME DO GARÇOM
                    $query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_garcom'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_garcom = $res2[0]['nome'];

                    $data = implode('/', array_reverse(explode('-', $data)));

                    if ($res[$i]['pago'] == 'Sim') {
                        $foto = 'verde.jpg';
                    } else {
                        $foto = 'vermelho.jpg';
                    }

                ?>

                    <tr>
                        <td style="text-align: center;"><img src="<?php echo $url_local ?>assets/imagens/<?php echo $foto ?>" width="13px"> </td>
                        <td style="text-align: center;">R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.') ?></td>
                        <td style="text-align: center;">R$ <?php echo number_format($res[$i]['comissao'], 2, ',', '.') ?></td>
                        <td style="text-align: center;">R$ <?php echo number_format($res[$i]['couvert'], 2, ',', '.') ?></td>
                        <td style="text-align: center;">R$ <?php echo number_format($res[$i]['subtotal'], 2, ',', '.') ?></td>
                        <td style="text-align: center;"><?php echo $res[$i]['mesa'] ?> </td>
                        <td style="text-align: center;"><?php echo $data ?> </td>
                        <th style="text-align: center;"><?php echo $nome_garcom ?></th>
                    </tr>
                <?php } ?>

            </table>
            <hr>
        </small>

        <div class="row">
            <div class="col-sm-8 esquerda">
                <span class=""> <b> Período da Apuração </b> </span>

                <span class=""> <?php echo $apuracao ?> </span>
            </div>
            <div class="col-sm-4 direita" align="right">
                <span class=""> <b> Total de Pedidos <?php echo $totalItens?> </b> </span>
            </div>
        </div>

    </div>
    </div>


    <div class="footer">
        <p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p>
    </div>




</body>

</html>