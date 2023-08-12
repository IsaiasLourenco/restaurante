<?php
$pagina = 'compras';
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
    <h2>COMPRAS</h2>

    <small>
        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
            <thead>
                <tr>
                    <th style="text-align:center">Pago</th>
                    <th>Total</th>
                    <th>Data da Compra</th>
                    <th>Funcionário</th>
                    <th>Fornecedor</th>
                    <th style="text-align:center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT * FROM compras ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                    $id_func = $res[$i]['funcionario'];
                    $id_forn = $res[$i]['fornecedor'];

                    if ($res[$i]['pago'] == 'Sim') {
                        $pago = 'text-success';
                    } else {
                        $pago = 'text-danger';
                    }

                    //BUSCAR O NOME DO FUCIONÁRIO RELACIONADO AO ID NA TABELA COMPRAS
                    $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_func = $res2[0]['nome'];

                    //BUSCAR O NOME DO FORNECEDOR RELACIONADO AO ID NA TABELA COMPRAS
                    $query2 = $pdo->query("SELECT * FROM fornecedores where id = '$id_forn'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_forn = $res2[0]['nome'];
                ?>
                    <tr>
                        <td style="text-align: center;"><i class="bi bi-square-fill <?php echo $pago ?>"></i></td>
                        <td>R$ <?php echo number_format($res[$i]['total'], 2, ',', '.')  ?></td>
                        <td><?php echo  implode('/', array_reverse(explode('-', $res[$i]['data_compra']))) ?></td>
                        <td><?php echo $nome_func ?></td>
                        <td><?php echo $nome_forn ?></td>
                        <td style="text-align:center">

                            <?php if ($res[$i]['pago'] != 'Sim') { ?>

                                <a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
                                    <i class="bi bi-trash text-danger"></i></a>

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
                    <h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-excluir">
                    <div class="modal-body">

                        <input type="hidden" name="id" value="<?php echo @$_GET['id'] ?>">

                        <span class="mb-2">Deseja Realmente Excluir este Registro?</span>
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

<!-- Ajax para focar no nome 
    <script>
        document.getElementById("submit").onclick = function() {
            document.getElementById("nome").focus();
        }
    </script>
    Fim Ajax para focar no nome -->