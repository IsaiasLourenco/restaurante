<?php
require_once("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$dataReserva = $_POST['dataReserva'];
$pessoas = $_POST['quantidade'];
$mensagem_reserva = $_POST['mensagem'];

$data = implode('/', array_reverse(explode('-', $dataReserva)));

$destinatario = $email_adm;

$assunto = $nome_site . ' Nova Reserva ';


$conteudo = ' Nome: ' . $nome . ' Telefone: ' . $telefone . ' Email: ' . $email . ' Data Reserva: ' . $dataReserva . ' Nº Pessoas: ' . $pessoas . ' Mensagem: ' . $mensagem_reserva;

$cabecalhos = "From: " . $email;

@mail($destinatario, $assunto, $conteudo, $cabecalhos);


//SALVAR NA TABELA DE RESERVAS POR EMAIL
$query = $pdo->prepare("INSERT INTO reservas_email SET nome = :nome, email = :email, telefone = :telefone, pessoas = :pessoas, data_reserva = :data_reserva, mensagem = :mensagem, reservado = 'Não'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":pessoas", "$pessoas");
$query->bindValue(":data_reserva", "$dataReserva");
$query->bindValue(":mensagem", "$mensagem_reserva");
$query->execute();


//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
$query = $pdo->query("SELECT * FROM funcionarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_banco = @$res[0]['email'];
$id_func = @$res[0]['id'];

if ($email != $email_banco) {
    $query1 = $pdo->prepare("SELECT * FROM funcionarios WHERE  email = :email");
    $query1->bindValue(":email", "$email");
    $query1->execute();
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    
    $total_reg = @count($res1);
    if ($total_reg > 0) {
        echo '<script laguage="javascript">window.alert ("E-mail já cadastrado")</script>';
        echo '<meta http-equiv="refresh" content="0; url=index.php#mu-reservation">';
        
    } else {
        //SALVAR NA TABELA DE CLIENTES QUEM FEZ A RESERVA
        $query2 = $pdo->prepare("INSERT INTO funcionarios SET nome = :nome, cpf = '000.000.000-00', email = :email, telefone = :telefone, cep = '00000-000', rua = 'Nono', numero = '00', bairro = 'Jimcobiloba', cidade = 'Mogi Guaçu', estado = 'SP', senha = '0808', cargo = '13', datanasc = '', datacad = curDate(), imagem = 'sem-foto.jpg'");
         $query2->bindValue(":nome", "$nome");
         $query2->bindValue(":email", "$email");
         $query2->bindValue(":telefone", "$telefone");
         $query2->execute();
         $id_funcionario = $pdo->lastInsertId();

        
         $query3 = $pdo->prepare("INSERT INTO clientes SET funcionario = '$id_funcionario', comentario = 'Alguma coisa que será editada depois.'");
         $query3->execute();

        

        echo '<script>alert("Enviado com Sucesso.");</script>';
        echo '<meta http-equiv="refresh" content="0; url=index.php#mu-reservation">';
    }

  
}
//COMUNICAR RESERVA POR WHATSAPP

# Mensagem Padrão
$mensagem = "Olá $nome, o $nome_site recebeu seu pedido de reserva e assim que concluírmos entraremos em contato connfirmando data, horário e número da mesa.%0A%0A 
Muito obrigado por confiar no nosso trabalho.";
#
echo "<a href='https://api.whatsapp.com/send?phone=$fone&text=$mensagem' target='_blank' title='Enviar Mensagem Via WhatsApp Web'><h1>Enviar Mensagem Via WhatsApp Web<br />$nome - $fone</h1></a>";
