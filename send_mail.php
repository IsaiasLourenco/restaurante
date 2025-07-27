<?php
require_once('config.php');
$nome = $_POST['nome_contato'];
$email = $_POST['email_contato'];
$mensagem = $_POST['mensagem'];
$assunto = 'Novo e-mail de Restaurante';
$remetente = 'isaias@vetor256.com';

$conteudo = "Nome: $nome\r\nEmail: $email\r\n\r\nMensagem: $mensagem\r\n";

$cabecalhos = "From: $remetente\r\n";
$cabecalhos .= "Reply-To: $email\r\n";
$cabecalhos .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (empty($mensagem)) {
    echo "Erro: Mensagem não foi enviada corretamente!";
    exit();
}

mail($remetente, $assunto, $conteudo, $cabecalhos); 

?>

<script>
    alert('Email enviado com sucesso!')
</script>    
<meta http-equiv="refresh" content="0; url=index.php"> 