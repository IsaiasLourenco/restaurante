<?php
require_once("../../../conexao.php");

echo "<h2>RESERVAS</h2>";

$data_reser_reservas = $_POST['data'];

echo "<div class='row mx-1'>";

$query = $pdo->query("SELECT * FROM reservas WHERE data_reser = '$data_reser_reservas' AND checkout = 'Não' order by mesa asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){	}
		$id_cliente = $res[$i]['cliente'];
		$nome_mesa = $res[$i]['mesa'];
		$obs = $res[$i]['obs'];

		$query2 = $pdo->query("SELECT * FROM clientes where id = '$id_cliente'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

		$queryFu = $pdo->query("SELECT * FROM funcionarios where id = '$id_cliente'");
		$resFu = $queryFu->fetchAll(PDO::FETCH_ASSOC);

		$nome_cli = $resFu[0]['nome'];
		$telefone_cli = $resFu[0]['telefone'];

		echo "<div class='col-lg-4 col-md-6 col-md-12 mb-3'>";
			echo "<div class='card shadow h-100'>";
				echo "<div class='card-body'>";
					echo "<div class='row no-gutters align-items-center'>";
						echo "<div class='col mr-2'>";
							echo "<div class='text-xs text-primary text-uppercase' style='font-size: 12px; font-weight: bold'>".$nome_cli."</div>";
							echo "<div class='text-xs text-primary' style='font-size: 12px; font-weight: bold'>".$telefone_cli." </div>";
							echo "<div class='text-xs text-primary' style='font-size: 12px'>".$obs." </div>";
						echo "</div>";
						echo "<div class='col-auto' align='center'>
						<i class='fas fa-pizza-slice text-primary' style='font-size: 32px'></i><br><span class='text-xs text-primary' style='font-size: 12px''>Mesa ".$nome_mesa."</span>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";

		}

	echo "</div>";


 ?>