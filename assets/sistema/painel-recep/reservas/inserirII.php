<?php   
require_once("../../../conexao.php");
@session_start();

$response = []; // Array para armazenar retorno padronizado

if (@$_POST['id_res_email'] != "") {
    $id_reserva_email = $_POST['id_res_email'];
    $email = $_POST['email'];
    $pessoas = $_POST['pessoas'];
    $data_reser = $_POST['data'];
    $obs = $_POST['mensagem'];

    $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($res)) {
        echo json_encode(['status' => 'error', 'message' => 'Cliente não encontrado!']);
        exit();
    }

    $id_cli = $res[0]['id'];
    $tel_cli = $res[0]['telefone'];

    $mesa = ""; // Inicializa como vazio
    $query = $pdo->query("SELECT * FROM mesas ORDER BY id DESC");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < @count($res); $i++) {
        $id_mesa = $res[$i]['id'];
        $query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$id_mesa' AND data_reser = '$data_reser'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

        if (@count($res2) == 0) {
            $queryPedido = $pdo->query("SELECT * FROM pedidos WHERE status_pedido = 'Aberta' AND mesa = '$id_mesa'");
            $resPedido = $queryPedido->fetchAll(PDO::FETCH_ASSOC);

            if (@count($resPedido) == 0) {
                $mesa = $id_mesa;
            }
        }
    }
} else {
    $nome = $_POST['nome'];
    $id_cli = $_POST['id_cli'];
    $mesa = $_POST['id_mesa'];
    $pessoas = $_POST['pessoas'];
    $data_reser = $_POST['data-reserva'];
    $obs = $_POST['obs'];

    if (empty($nome)) {
        echo json_encode(['status' => 'error', 'message' => 'Selecione um cliente!']);
        exit();
    }

    $query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_cli'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($res)) {
        echo json_encode(['status' => 'error', 'message' => 'Cliente não encontrado!']);
        exit();
    }

    $tel_cli = $res[0]['telefone'];
}

if (empty($mesa)) {
    echo json_encode(['status' => 'error', 'message' => 'Não existem mesas disponíveis para essa data! Quer escolher outra data?']);
    exit();
}

$id_usuario = $_SESSION['id'];

$query = $pdo->prepare("INSERT INTO reservas SET cliente = :id_cli, mesa = :id_mesa, pessoas = :pessoas, obs = :obs, funcionario = :funcionario, data_reser = :data_reser, checkin = 'Não', checkout = 'Não'");
$query->bindValue(":id_cli", "$id_cli");
$query->bindValue(":id_mesa", "$mesa");
$query->bindValue(":pessoas", "$pessoas");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");
$query->bindValue(":data_reser", "$data_reser");
$query->execute();

$tel_cli = preg_replace('/[^0-9]/', '', $tel_cli);
$data_reser = implode('/', array_reverse(explode('-', 'data_reser')));
$mesa = str_pad($mesa, 3, '0', STR_PAD_LEFT);
$mensagem = urlencode("Reserva da mesa $mesa confirmada para o dia $data_reser.Obrigado por escolher o $nome_site!🍕🍕");
$link_whatsapp = "https://api.whatsapp.com/send?phone=$tel_cli&text=$mensagem";

echo json_encode(['status' => 'success', 'message' => 'Salvo com Sucesso!', 'link' => $link_whatsapp]);
exit();