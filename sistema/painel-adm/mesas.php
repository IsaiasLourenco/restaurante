<?php
$pagina = 'mesas';
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
    <h2>MESAS</h2>
    <a href="index.php?pag=<?php echo $pagina ?>&funcao=novo" type="button" class="btn btn-faded mt-2 mb-4" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Nova Mesa</a>

    <small>
        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th style="text-align:center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT * FROM mesas ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                ?>
                    <tr>
                        <td><?php echo $res[$i]['nome'] ?></td>
                        <td><?php echo $res[$i]['descricao'] ?></td>
                        <td style="text-align:center">
                            <a href="index.php?pag=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id_reg ?>" title="Editar Registro">
                                <i class="bi bi-pencil-square mr-1 text-primary"></i></a>
                            <a href="index.php?pag=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id_reg ?>" title="Excluir Registro">
                                <i class="bi bi-trash text-danger"></i></a>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </small>

    <!-- Modal para Inserção ou Edição -->
    <div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    if (@$_GET['funcao'] == 'novo') {
                        $titulo_modal = 'Inserir Registro';
                    } else {
                        $titulo_modal = 'Editar Registro';
                        $id = @$_GET['id'];
                        $query = $pdo->query("SELECT * FROM mesas WHERE  id = '$id'");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        $nome_mesa = @$res[0]['nome'];
                        $descricao_mesa = @$res[0]['descricao'];
                    }
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form">
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nome </label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_mesa ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Descrição </label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome" value="<?php echo @$descricao_mesa ?>" required>
                        </div>

                        <input type="hidden" name="id" value="<?php echo @$id ?>">

                        <small>
                            <div align="center" id="mensagem">
                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                        <button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                        <input type="hidden" name="id" value="<?php echo @$id ?>">

                        <span class="mb-2">Deseja Realmente Excluir este Registro?</span>
                        <br><br>
                        <small>
                            <div align="center" id="mensagem-excluir">
                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                        <button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!--Script para adicionar arquivo -->
<?php
if (@$_GET['funcao'] == 'novo') { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>
<!--Final Script para adicionar arquivo -->

<!--Script para editar arquivo -->
<?php
if (@$_GET['funcao'] == 'editar') { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('cadastro'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>
<!--Fim Script para editar arquivo -->

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

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
    $("#form").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag=" + pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim Ajax para inserir ou editar dados -->


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