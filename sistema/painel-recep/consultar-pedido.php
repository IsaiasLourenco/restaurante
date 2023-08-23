<?php
$pagina = 'consultar-pedido';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/meucss.css">
</head>

<body>
    <h2>PEDIDOS</h2>

    <small>
        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
            <thead>
                <tr>
                    <th style="text-align:center">Pago</th>
                    <th style="text-align:center">SubTotal</th>
                    <th style="text-align:center">Serviço</th>
                    <th style="text-align:center">Couvert</th>
                    <th style="text-align:center">Garçom</th>
                    <th style="text-align:center">Total</th>
                    <th style="text-align:center">Mesa</th>
                    <th style="text-align:center">Data</th>
                    <th style="text-align:center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT * FROM pedidos WHERE valor > 0 ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                    $id_garcom = $res[$i]['garcom'];

                    if ($res[$i]['pago'] == 'Sim') {
                        $pago = 'text-success';
                    } else {
                        $pago = 'text-danger';
                    }

                    //BUSCAR O NOME DO GARÇOM
                    $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_garcom'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_garcom = $res2[0]['nome'];

                    if ($pago != 'Sim') {
                        $mostracomissao = $res[$i]['comissao'];
                    } else {
                        $comissao = $res[$i]['comissao'];
                        $valor = $res[$i]['valor'];
                        $mostracomissao = $comissao * $valor;
                    }

                ?>
                    <tr>
                        <td style="text-align: center;"><i class="bi bi-square-fill <?php echo $pago ?>"></i></td>
                        <td style="text-align:center">R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.')  ?></td>
                        <td style="text-align:center">R$ <?php echo $mostracomissao ?></td>
                        <td style="text-align:center">R$ <?php echo number_format($res[$i]['couvert'], 2, ',', '.')  ?></td>
                        <td style="text-align:center"><?php echo $nome_garcom ?></td>
                        <td style="text-align:center">R$ <?php echo number_format($res[$i]['subtotal'], 2, ',', '.')  ?></td>
                        <td style="text-align:center"><?php echo $res[$i]['mesa'] ?></td>
                        <td style="text-align:center"><?php echo  implode('/', array_reverse(explode('-', $res[$i]['data_pedido']))) ?></td>


                        <td style="text-align:center">

                            <a href="../rel/rel_comprovante_class.php?id=<?php echo $id_reg ?>" target="_blank" title="Gerar Comprovante">
                                <i class="bi bi-printer-fill text-primary"></i></a>

                            <?php if ($res[$i]['pago'] != 'Sim') { ?>

                                <?php if ($mostracomissao != 0 and $mostracomissao != 'Sim') { ?>
                                    <a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Comissão">
                                        <i class="bi bi-trash text-danger"></i></a>
                                <?php } ?>

                                <a href="index.php?pag=<?php echo $pagina ?>&funcao=baixar&id=<?php echo $id_reg ?>" title="Confirmar Pagamento">
                                    <i class="bi bi-check-square-fill text-success"></i></a>

                            <?php } ?>

                        </td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </small>

    <!-- Modal para Exclusão -->
    <div class="modal fade" id="excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir Taxa de Serviço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-excluir">
                    <div class="modal-body">

                        <input type="hidden" name="id" value="<?php echo @$_GET['id'] ?>">

                        <span class="mb-2">Deseja Realmente Excluir a comissão deste pedido?</span>
                        <br><br>
                        <small>
                            <div align="center" id="mensagem-excluir">
                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                        <button type="submit" class="btn btn-faded cores-button-confirmar">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim Modal para Exclusão -->

    <!-- Modal paraPagamento da conta -->
    <div class="modal fade" tabindex="-1" id="modalBaixar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Baixar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-baixar">
                    <div class="modal-body">

                        <p>Deseja Realmente confirmar o Recebimento do pagamento deste pedido?</p>

                        <small>
                            <div align="center" class="mt-1" id="mensagem-baixar">

                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-fechar-baixar" class="btn cores-button-recusar" data-bs-dismiss="modal">Fechar</button>
                        <button name="btn-baixar" id="btn-excluir" type="submit" class="btn cores-button-confirmar">Baixar</button>

                        <input name="id_conta" type="hidden" value="<?php echo @$_GET['id'] ?>">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim Modal paraPagamento da conta -->

</body>

</html>

<!--Script para excluir arquivo -->
<?php
if (@$_GET['funcao'] == 'excluir') { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('excluir'), {

        })

        myModal.show();
    </script>
<?php } ?>
<!--Fim Script para excluir arquivo -->

<!--Script para baixar pedid -->
<?php
if (@$_GET['funcao'] == 'baixar') { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalBaixar'), {

        })

        myModal.show();
    </script>
<?php } ?>
<!--Fim Script para baixar pedid -->

<!-- Ajax para renderizar datatable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>
<!-- Fim Ajax para renderizar datatable -->

<!-- Ajax para excluir dados -->
<script type="text/javascript">
    $("#form-excluir").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";

        $.ajax({
            url: pag + "/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem-excluir').removeClass()

                if (mensagem.trim() == "Excluído com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-excluir').click();
                    window.location = "index.php?pag=" + pag;

                } else {

                    $('#mensagem-excluir').addClass('text-danger')
                }

                $('#mensagem-excluir').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim Ajax para excluir dados -->

<!-- Ajax para baixar pagamento -->
<script type="text/javascript">
    $("#form-baixar").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";

        $.ajax({
            url: pag + "/baixar.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem-baixar').removeClass()

                if (mensagem.trim() == "Baixado com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-baixar').click();
                    window.location = "index.php?pag=" + pag;

                } else {

                    $('#mensagem-baixar').addClass('text-danger')
                }

                $('#mensagem-baixar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim Ajax para baixar pagamento -->

<!-- Ajax para focar no nome -->
<script>
    document.getElementById("submit").onclick = function() {
        document.getElementById("nome").focus();
    }
</script>
<!--Fim Ajax para focar no nome -->