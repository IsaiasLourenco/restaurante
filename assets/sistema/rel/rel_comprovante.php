<?php

require_once("../../conexao.php");

$agora = date('d/m/Y H:i');

$id = $_GET['id'];

//BUSCAR AS INFORMAÇÕES DO PEDIDO
$res = $pdo->query("SELECT * from pedidos where id = '$id' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$total_venda = $dados[0]['valor'];
$mesa = $dados[0]['mesa'];
$garcom = $dados[0]['garcom'];
$data = $dados[0]['data_pedido'];
$obs = $dados[0]['obs'];
$comissao = $dados[0]['comissao'];
$couvert = $dados[0]['couvert'];
$subtotal = $dados[0]['subtotal'];
$pago = $dados[0]['pago'];

$data = implode('/', array_reverse(explode('-', $data)));

$res = $pdo->query("SELECT * from funcionarios where id = '$garcom' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$nome_garcom = $dados[0]['nome'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechamento Mesa nº <?php echo $id ?> </title>
    <link rel="stylesheet" href="../../assets/css/rel_comp.css">
    <link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">
</head>

<body>
    <table class="printer-ticket">

        <tr>
            <th class="title" colspan="3"><?php echo $nome_site ?></th>
        </tr>

        <tr>
            <th colspan="3">Fechamento Mesa <?php echo $mesa ?> - Garçom: <?php echo $nome_garcom ?></th>
        </tr>

        <tr>
            <th colspan="3"><?php echo $agora ?> - Pago? - <strong><?php echo $pago ?></strong></th>
        </tr>
        <tr>
            <th colspan="3">
                <?php echo $endereco ?> <br />
                <strong>Telefone</strong> <?php echo $telefone ?> <br />
                <strong>CNPJ</strong> <?php echo $cnpj ?>
            </th>
        </tr>

        <tr>
            <th class="ttu margem-superior" colspan="3">
                Detalhamento de Consumo
            </th>
        </tr>

        <tr>
            <th colspan="3">
                CUPOM NÃO FISCAL
            </th>
        </tr>

        <tbody>

            <?php

            $res = $pdo->query("SELECT * from itens_pedido where pedido = '$id' order by id asc");
            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
            $linhas = count($dados);

            $sub_tot;
            for ($i = 0; $i < count($dados); $i++) {
                foreach ($dados[$i] as $key => $value) {
                }

                $id_produto = $dados[$i]['item'];
                $quantidade = $dados[$i]['quantidade'];
                $id_item = $dados[$i]['id'];
                $tipo = $dados[$i]['tipo'];

                if ($tipo == 'Produto') {
                    $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
                    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
                    $nome_produto = $dados_p[0]['nome'];
                    $valor = $dados_p[0]['valor_venda'];
                } else {
                    $res_p = $pdo->query("SELECT * from pratos where id = '$id_produto' ");
                    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
                    $nome_produto = $dados_p[0]['nome'];
                    $valor = $dados_p[0]['valor'];
                }

                $total_item = $valor * $quantidade;
            ?>

                <tr>

                    <td colspan="2" width="50%"><?php echo $quantidade ?> - <?php echo $nome_produto ?>

                    </td>

                    <td align="right">R$ <?php

                                            @$total_item;
                                            @$sub_tot = @$sub_tot + @$total_item;
                                            $sub_total = $sub_tot;

                                            $sub_total = number_format($sub_total, 2, ',', '.');
                                            $total_item = number_format($total_item, 2, ',', '.');
                                            $total = number_format($total_venda, 2, ',', '.');

                                            echo $total_item;
                                            ?></td>
                </tr>
            <?php } ?>

        </tbody>

        <tfoot>

            <tr>
                <td colspan="3" class="cor">
                    --------------------------------------------------------------------------------------
                </td>
            </tr>

            <tr>
                <td colspan="2">SubTotal</td>
                <td align="right">R$ <?php echo $total ?></td>
            </tr>

            <tr>
                <td colspan="2">Couvert Artístico</td>
                <td align="right">R$ <?php echo $couvert ?></td>
            </tr>

            <?php if ($comissao != 0) { ?>
                <tr>
                    <td colspan="2">Taxa de Serviço</td>
                    <td align="right">R$ <?php echo $comissao ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" class="cor">
                --------------------------------------------------------------------------------------
                </td>
            </tr>

            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td align="right"><strong>R$ <?php echo $subtotal ?></strong></td>
            </tr>

            <?php if ($obs != "") { ?>
                <tr>
                    <td colspan="3" class="cor">
                    --------------------------------------------------------------------------------------
                    </td>
                </tr>

                <tr>
                    <td colspan="2">Observações</td>
                    <td align="right"><?php echo $obs ?></td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="3" class="cor">
                --------------------------------------------------------------------------------------
                </td>
            </tr>

            <tr>
                <td colspan="3" style="text-align:center" target="_blank">
                    https://www.vetor256.com
                </td>
            </tr>
        </tfoot>

    </table>
</body>

</html>