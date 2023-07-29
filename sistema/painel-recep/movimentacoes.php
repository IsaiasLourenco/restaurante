<?php
$pagina = 'movimentacoes';
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
    <h2>MOVIMENTAÇÕES</h2>

    <small>
        <table id="example" class="table table-hover table-sm my-4" style="width:98%;">
            <thead>
                <tr>
                    <th style="text-align: center;">Tipo</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Funcionário</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT * FROM movimentacoes ORDER BY id ASC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                    $id_func = $res[$i]['funcionario'];
                    $descricao = $res[$i]['descricao'];

                    if ($res[$i]['tipo'] == 'Entrada') {
                        $move = 'text-success';
                        
                    } else {
                        $move = 'text-danger';
                    }

                    //BUSCAR O NOME DO FUCIONÁRIO RELACIONADO AO ID NA TABELA COMPRAS
                    $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_func = $res2[0]['nome'];

                ?>
                    <tr>
                        <td style="text-align: center;"><i class="bi bi-square-fill <?php echo $move ?> "></i></td>
                        <td><?php echo $res[$i]['descricao'] ?></td>
                        <td>R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.')  ?></td>
                        <td><?php echo $nome_func ?></td>
                        <td><?php echo  implode('/', array_reverse(explode('-', $res[$i]['data_mov']))) ?></td>
                        
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </small>


</body>

</html>

<!-- Ajax para renderizar datatable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>
<!-- Fim Ajax para renderizar datatable -->