<?php
require_once("../../../conexao.php");

$data_reser_mesas = $_POST['data'];

echo "<div class='col-md-12 mt-2'>";

$queryMesa = $pdo->query("SELECT * FROM mesas ORDER BY id ASC");
$resMesa = $queryMesa->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($resMesa); $i++) {
    foreach ($resMesa[$i] as $key => $value) {
    }
    $id_mesa = $resMesa[$i]['id'];
    $nome_mesa = $resMesa[$i]['nome'];
    $descricao_mesa = $resMesa[$i]['descricao'];

    echo "<div class='mx-2 mb-4' style='float:left'>";

    $query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$id_mesa' AND data_reser = '$data_reser_mesas' AND checkout = 'Não'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    if (@count($res2) > 0) {
        $id_reserva = $res2[0]['id'];
        echo "<a href='#' onclick='modalExcluirReservas($id_reserva)' type='button' class='btn cores-button-recusar' style='width:auto; height:auto;' title='" . $descricao_mesa . "' >Mesa " . $nome_mesa . "</a>";
            }else {
            echo "<a href='#' onclick='modalReservas($id_mesa)' type='button' class='btn cores-button-confirmar' style='width:auto; height:auto;' title='" . $descricao_mesa . "' >Mesa " . $nome_mesa . "</a>";
        }
        echo "</div>";
    }
echo "</div>";
?>