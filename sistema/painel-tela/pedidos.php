<?php
$pagina = 'pedidos';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vendor/css/h2.css">
</head>

<body>
    <h2>ITENS DOS PEDIDOS</h2>

    <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
        <thead>
            <tr>
                <th style="text-align:center">Item</th>
                <th style="text-align:center">Quantidade</th>
                <th style="text-align:center">Mesa</th>
                <th style="text-align:center">Garçom</th>
                <th style="text-align:center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $pdo->query("SELECT * FROM itens_pedido WHERE status_item = 'Preparando' ORDER BY id ASC");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < @count($res); $i++) {
                foreach ($res[$i] as $key => $value) {
                }
                $id_reg = $res[$i]['id'];
                $id_pedido = $res[$i]['pedido'];
                $id_item = $res[$i]['item'];

                //BUSCAR O PEDIDO PARA BUSCAR O NOME DO GARÇOM
                $query2 = $pdo->query("SELECT * FROM pedidoS where id = '$id_pedido'");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $id_garcom = $res2[0]['garcom'];

                $query3 = $pdo->query("SELECT * FROM funcionarios where id = '$id_garcom'");
                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                $nome_garcom = $res3[0]['nome'];

                //BUSCAR O PRODUTO
                $query4 = $pdo->query("SELECT * FROM pratos where id = '$id_item'");
                $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                $nome_item = $res4[0]['nome'];

            ?>
                <tr>
                    <td style="text-align:center"><?php echo $nome_item ?></td>
                    <td style="text-align:center"><?php echo $res[$i]['quantidade'] ?></td>
                    <td style="text-align:center"><?php echo $res[$i]['mesa'] ?></td>
                    <td style="text-align:center"><?php echo $nome_garcom ?></td>


                    <td style="text-align:center">
                        <a href="index.php?pag=<?php echo $pagina ?>&funcao=finalizar&id=<?php echo $id_reg ?>" title="Confirmar Prato Pronto">
                            <i class="bi bi-check-square-fill text-success"></i></a>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

    <!-- Modal para finalizar prato -->
    <div class="modal fade" tabindex="-1" id="modalFinalizar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Prato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-finalizar">
                    <div class="modal-body">

                        <p>Deseja Realmente confirmar a Finalização do preparo do Prato a seguir?</p>

                        <small>
                            <div align="center" class="mt-1" id="mensagem-finalizar">

                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-fechar-baixar" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal">Fechar</button>
                        <button name="btn-baixar" id="btn-finalizar" type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Baixar</button>

                        <input name="id_prato" type="hidden" value="<?php echo @$_GET['id'] ?>">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim Modal para finalizar prato -->

</body>

</html>

<!--Script para fianlizar prato -->
<?php
if (@$_GET['funcao'] == 'finalizar') { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalFinalizar'), {

        })

        myModal.show();
    </script>
<?php } ?>
<!--Fim Script para finalizar prato -->

<!-- Ajax para renderizar datatable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>
<!-- Fim Ajax para renderizar datatable -->

<!-- Ajax para finalizar prato -->
<script type="text/javascript">
    $("#form-finalizar").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";

        $.ajax({
            url: pag + "/finalizar.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem-finalizar').removeClass()

                if (mensagem.trim() == "Prato finalizado com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-finalizar').click();
                    window.location = "index.php?pag=" + pag;

                } else {

                    $('#mensagem-finalizar').addClass('text-danger')
                }

                $('#mensagem-finalizar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim Ajax para finalizar prato -->

<!-- Ajax para focar no nome -->
<script>
    document.getElementById("submit").onclick = function() {
        document.getElementById("nome").focus();
    }
</script>
<!--Fim Ajax para focar no nome -->