<?php
$pagina = 'comissoes';
require_once("verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../assets/css/comissao.css">
</head>

<body>
    <h2>COMISSÕES</h2>

    <small>
        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
            <thead>
                <tr>
                    <th style="text-align:center">Valor</th>
                    <th style="text-align:center">Comissão</th>
                    <th style="text-align:center">Mesa</th>
                    <th style="text-align:center">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_comissoes = 0;
                $query = $pdo->query("SELECT * FROM pedidos WHERE pago = 'Sim' AND comissao > 0 AND garcom = '$id_usuario)' ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                    $total_comissoes += $res[$i]['comissao'];
                ?>
                    <tr>
                        <td style="text-align:center">R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.')  ?></td>
                        <td style="text-align:center">R$ <?php echo number_format($res[$i]['comissao'], 2, ',', '.')  ?></td>
                        <td style="text-align:center"><?php echo $res[$i]['mesa'] ?></td>
                        <td style="text-align:center"><?php echo  implode('/', array_reverse(explode('-', $res[$i]['data_pedido']))) ?></td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </small>
    <p class="totalComissao">TOTAL: <strong>R$ <?php echo number_format($total_comissoes, 2, ',', '.') ?></strong></p>
</body>

</html>



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