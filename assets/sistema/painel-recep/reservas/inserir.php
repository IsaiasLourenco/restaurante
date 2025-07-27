    <?php
    require_once("../../../conexao.php");
    @session_start();

    if (@$_POST['id_res_email'] != "") {
        $id_reserva_email = $_POST['id_res_email'];
        $email = $_POST['email'];
        $pessoas = $_POST['pessoas'];
        $data_reser = $_POST['data'];
        $obs = $_POST['mensagem'];

        $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $id_cli = $res[0]['id'];
        $tel_cli = $res[0]['telefone'];

        $mesa = "";

        $query = $pdo->query("SELECT * FROM mesas ORDER BY id DESC");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $id_mesa = $res[$i]['id'];
            $nome_mesa = $res[$i]['nome'];

            $query2 = $pdo->query("SELECT * FROM reservas WHERE mesa = '$id_mesa' AND data_reser = '$data_reser'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            if (@count($res2) == 0) {
                $queryPedido = $pdo->query("SELECT * FROM pedidos WHERE status_pedido = 'Aberta' AND mesa = '$id_mesa' ");
                $resPedido = $queryPedido->fetchAll(PDO::FETCH_ASSOC);
                if (@count($resPedido) == 0) {
                    $mesa = $id_mesa;
                }
            } else {
            }
        }
    } else {

        $nome = $_POST['nome'];
        $id_cli = $_POST['id_cli'];
        $mesa = $_POST['id_mesa'];
        $pessoas = $_POST['pessoas'];
        $data_reser = $_POST['data-reserva'];
        $obs = $_POST['obs'];

        // echo $nome;
        // exit();

        if ($nome == "") {
            echo $id_cli, 'Selecione um cliente!';
            exit();
        }
        $query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_cli'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $tel_cli = $res[0]['telefone'];
    }

    if ($mesa == "") {
        echo 'Não existem mesas disponíveis para essa data! Quer escolher outra data?';

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
    $id_reserva = $pdo->lastInsertId();

    // Limpa o número de telefone
    $tel_cli = preg_replace('/[^0-9]/', '', $tel_cli);
    $data_reser = implode('/', array_reverse(explode('-', 'data_reser')));
    $mesa = str_pad($mesa, 3, '0', STR_PAD_LEFT);

    // Codifica a mensagem para URL
    $mensagem = urlencode("Reserva da mesa $mesa confirmada para o dia $data_reser.Obrigado por escolher o $nome_site!🍕🍕");

    // Gera o link do WhatsApp
    $link_whatsapp = "https://api.whatsapp.com/send?phone=$tel_cli&text=$mensagem";

    unset($_SESSION['link_whatsapp']);
    // Atualiza a sessão com o novo link
    $_SESSION['link_whatsapp'] = $link_whatsapp;

    echo 'Salvo com Sucesso!';
    exit();

    ?>