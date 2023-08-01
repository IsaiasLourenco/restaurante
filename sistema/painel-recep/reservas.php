<?php

if (@$pag_painel != "") {
    $pagina = $pag_painel . '/reservas';
} else {
    $pagina = 'reservas';
}
require_once("verificar.php");
$agora = date('Y-m-d');
?>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


<!-- Custom styles for this template-->
<link href="vendor/css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/css/h2.css" rel="stylesheet">


<!-- Cabeçalho -->
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-12">
        <div class="row mx-2">
            <h2>RESERVAS</h2>
            <div class="col-mb-6 col-lg-6 col-sm-12">
                <span>Data da Reserva</span>
            </div>
            <div class="col-mb-6 col-lg-6 col-sm-12">
                <div class="mb-3">
                    <form id="form-data">
                        <input onchange="mudarData(this.value)" type="date" class="form-control" id="data" name="data" placeholder="Data" value="<?php echo @$agora ?>">
                    </form>

                </div>
            </div>
        </div>
        <!-- Fim do Cabeçalho -->

        <!-- Chamada das mesas por função -->
        <div id="listar">

        </div>
        <!-- Fim do Chamada das mesas por função -->

    </div>

    <div class="col-lg-8 col-md-7 col-sm-12">
        <div id='listar-reservas'>
            
        </div>
    </div>
</div>

<!-- Modal Reservas-->
<div class="modal fade" id="modalReservas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nova Reserva - Mesa <span id="nome_mesa"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-reservas">
                <div class="modal-body">

                    <small>
                        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th style="text-align:center">Add Cliente</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = $pdo->query("SELECT * FROM clientes ORDER BY id ASC");
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                for ($i = 0; $i < @count($res); $i++) {
                                    foreach ($res[$i] as $key => $value) {
                                    }
                                    $id_cli = $res[$i]['id'];
                                    $nome_cli = $res[$i]['nome'];
                                ?>
                                    <tr>
                                        <td><?php echo $nome_cli ?></td>
                                        <td><?php echo $res[$i]['email'] ?></td>
                                        <td><?php echo $res[$i]['telefone'] ?></td>
                                        <td style="text-align:center">
                                            <a href="" onclick="pegarCliente('<?php echo $id_cli ?>', '<?php echo $nome_cli ?>')" title="Add Cliente"><i class="bi bi-person-plus-fill mr-1 text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>


                                <?php } ?>

                            </tbody>
                        </table>
                    </small>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome </label>
                                <input type="text" class="form-control" id="nome_cli" name="nome" placeholder="Nome" readonly required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pessoas </label>
                                <input type="number" class="form-control" id="pessoas" name="pessoas" placeholder="Nº de pessoas" value="1" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data </label>
                                <input type="date" class="form-control" id="data-reserva" name="data-reserva" placeholder="Nome" value="<?php echo @$agora ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Observações </label>
                        <textarea type="text" class="form-control" id="obs" name="obs"></textarea>
                    </div>

                    <input type="hidden" id="id_mesa" name="id_mesa">
                    <input type="hidden" id="id_cli" name="id_cli">

                    <small>
                        <div align="center" id="mensagem-reservas">
                        </div>
                    </small>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-faded" style="background-color:#333333; border-color:#f5f0f0; color:#f5f0f0" data-bs-dismiss="modal" id="btn-fechar-reservas">Fechar</button>
                    <button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Reservar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim Modal Reservas-->

<!-- Modal Excluir Reserva-->
<div class="modal fade" id="modalExcluirReservas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-excluir">
                <div class="modal-body">

                    Deseja Realmente Excluir esta Reserva?

                    <input type="hidden" name="id_reserva" id="id_reserva">

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
<!-- Fim do Modal Excluir Reserva-->

<!-- Ajax para limitar nº de itens no Datable e listar produtos -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false,
            "lengthMenu": [
                [2, 3, 4, -1],
                [2, 3, 4, "Todos"]
            ]
        });
        mostrarMesas();
        mostrarReservas();
    });
</script>
<!-- Fim do Ajax para limitar nº de itens no Datable e listar produtos -->

<!-- Ajax para Mostrar Mesas -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function mostrarMesas() {
        $.ajax({
            url: pag + "/listar-mesas.php",
            method: 'POST',
            data: $('#form-data').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }
</script>
<!-- Fim do Ajax para Mostrar Mesas -->

<!-- Ajax para chamar Modal Reservas -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function modalReservas(id_mesa) {
        event.preventDefault();
        $('#id_mesa').val(id_mesa);
        $('#nome_mesa').text(id_mesa);
        var myModal = new bootstrap.Modal(document.getElementById('modalReservas'), {

        });
        myModal.show();
    }
</script>
<!-- Fim do Ajax para chamar Modal Reservas -->

<!-- Ajax para mudar data no Modal Reservas -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function mudarData(data) {
        mostrarMesas();
        mostrarReservas();
        $('#data-reserva').val(data);
    }
</script>
<!-- Fim do Ajax para mudar data no Modal Reservas -->

<!-- Ajax para buscar Clientes -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function pegarCliente(id_cli, nome_cli) {
        event.preventDefault();
        $('#id_cli').val(id_cli);
        $('#nome_cli').val(nome_cli);
    }
</script>
<!-- Fim do Ajax para buscar Clientes -->

<!-- Ajax para inserir ou editar dados na tabela reserva-->
<script type="text/javascript">
    $("#form-reservas").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);
        var pag = "<?= $pagina ?>";

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem-reservas').removeClass()
                $('#mensagem-reservas').text('')

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    $('#nome').val('');
                    $('#pessoas').val('1');
                    $('#btn-fechar-reservas').click();
                    //window.location = "index.php?pag=" + pag;
                    var data = $('#data-reserva').val(data);
                    mudarData(data);
                    
                } else {

                    $('#mensagem-reservas').addClass('text-danger')
                    $('#mensagem-reservas').text(mensagem)
                }
                
            },
            
            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim do Ajax para inserir ou editar dados na tabela reserva -->

<!-- Ajax para excluir Reserva -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function modalExcluirReservas(id) {
        event.preventDefault();
        $('#id_reserva').val(id);
        var myModal = new bootstrap.Modal(document.getElementById('modalExcluirReservas'), {

        });
        myModal.show();
    }
</script>
<!-- Fim Ajax para excluir Reserva -->

<!-- Ajax para excluir reserva -->
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
                $('#mensagem-excluir').text('')

                if (mensagem.trim() == "Excluído com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-excluir').click();
                    //window.location = "index.php?pag=" + pag;
                    var data = $('#data-reserva').val(data);
                    mudarData(data);

                } else {

                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }



            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>
<!-- Fim do Ajax para excluir reserva -->

<!-- Ajax para Mostrar Reservas -->
<script type="text/javascript">
    var pag = "<?= $pagina ?>";

    function mostrarReservas() {
        $.ajax({
            url: pag + "/listar-reservas.php",
            method: 'POST',
            data: $('#form-data').serialize(),
            dataType: "html",

            success: function(result) {
                $("#listar-reservas").html(result);
            }
        });
    }
</script>
<!-- Fim do Ajax para Mostrar Reservas -->