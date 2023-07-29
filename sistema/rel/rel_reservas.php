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
    <title>Relatório de Reservas</title>
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
            <span class="titulorel">Relatório de Reservas </span>
        </div>

        <table class='table' width='100%' cellspacing='0' cellpadding='3'>
            <tr bgcolor='#f9f9f9'>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Mesa</th>
                <th>Lugares</th>
                <th">Data</th>


            </tr>
            <?php
            $saldo = 0;
            $query = $pdo->query("SELECT * FROM reservas WHERE data_reser >= '$dataInicial' AND data_reser <= '$dataFinal' ORDER BY data_reser DESC");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            $totalItens = @count($res);

            for ($i = 0; $i < @count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }
                $id_cliente = $res[$i]['cliente'];
                $id_mesa = $res[$i]['mesa'];
                $qtde_p = $res[$i]['pessoas'];
                $data = $res[$i]['data_reser'];
                $id = $res[$i]['id'];

                $data = implode('/', array_reverse(explode('-', $data)));

                $query_usu = $pdo->query("SELECT * FROM clientes where id = '$id_cliente'");
                $res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
                $nome_cliente = $res_usu[0]['nome'];
                $telefone_cliente = $res_usu[0]['telefone'];

                $query_mesa = $pdo->query("SELECT * FROM mesas where id = '$id_mesa'");
                $res_mesa = $query_mesa->fetchAll(PDO::FETCH_ASSOC);
                $nome_mesa = $res_mesa[0]['nome'];
                $descricao_mesa = $res_mesa[0]['descricao'];

            ?>

                <tr>
                    <td><?php echo $nome_cliente ?> </td>
                    <td><?php echo $telefone_cliente ?> </td>
                    <td style="text-align: center;"><?php echo $nome_mesa ?> </td>
                    <td style="text-align: center;"><?php echo $qtde_p ?> </td>
                    <td><?php echo $data ?> </td>
                </tr>
            <?php } ?>



        </table>

        <hr>


        </div>
    </div>


    <div class="footer">
        <p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p>
    </div>




</body>

</html>