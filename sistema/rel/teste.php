<?php

require_once("../../conexao.php");

$agora = date('d/m/Y H:i');

$res = $pdo->query("SELECT * from itens_pedido where pedido = '52' order by id asc");
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
<?php } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <form action="">
        <div class="row">
            <form method="post" id="form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ID Produto </label>
                                <input type="text" class="form-control" id="idProd" name="idProd" placeholder="Produto" value="<?php echo @$id_produto ?>" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Qtde </label>
                                <input type="text" class="form-control" id="qtde" name="qtde" placeholder="Qtde" value="<?php echo @$quantidade ?>" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ID ID Item </label>
                                <input type="text" class="form-control" id="idItem" name="idItem" placeholder="idItem" value="<?php echo @$id_item ?>" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tipo </label>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo" value="<?php echo @$tipo ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome Produto </label>
                                <input type="text" class="form-control" id="data" name="data" placeholder="CEP" value="<?php echo @$nome_produto ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Valor </label>
                                <input type="text" class="form-control" id="obs" name="obs" placeholder="Obs" value="<?php echo @$valor ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Total </label>
                                <input type="text" class="form-control" id="comissao" name="comissao" placeholder="Comissão" value="<?php echo @$total_item ?>">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Couvert </label>
                                <input type="text" class="form-control" id="couvert" name="couvert" placeholder="Couvert" value="<?php echo @$couvert ?>" readonly>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Total </label>
                                <input type="text" class="form-control" id="total" name="total" placeholder="Total" value="<?php echo @$subtotal ?>" readonly>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pago </label>
                                <input type="text" class="form-control" id="pago" name="pago" placeholder="Pago" value="<?php echo @$pago ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="id" value="<?php echo @$id ?>">

                    <small>
                        <div align="center" id="mensagem">
                        </div>
                    </small>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                    <button type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>
                </div>
            </form>
        </div>
    </form>
</body>

</html>