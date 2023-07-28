<?php
require_once("../../../conexao.php");

$data_reser = $_POST['data'];

echo "<div class='col-md-12 mt-2'>";

$query = $pdo->query("SELECT * FROM mesas ORDER BY id ASC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $id_mesa = $res[$i]['id'];
    $nome_mesa = $res[$i]['nome'];
    $descricao_mesa = $res[$i]['descricao'];

    echo "<div class='mx-2 mb-4' style='float:left'>";

    $query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$id_mesa' AND data_reser = '$data_reser'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    if (@count($res2) > 0) {
        $id_reserva = $res2[0]['id'];
        echo "<a href='#' onclick='modalExcluirReservas($id_reserva)' type='button' class='btn btn-faded' style='width:auto; height:auto; background-color:#333333; border-color:#f5f0f0; color:#f5f0f0' title='" . $descricao_mesa . "' >Mesa " . $nome_mesa . "</a>";
            }else {
            echo "<a href='#' onclick='modalReservas($id_mesa)' type='button' class='btn btn-faded' style='width:auto; height:auto; background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0' title='" . $descricao_mesa . "' >Mesa " . $nome_mesa . "</a>";
        }
        echo "</div>";
    }
echo "</div>";
?>