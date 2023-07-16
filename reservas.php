<?php 
require_once("config.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data = $_POST['dataReserva'];
$pessoas = $_POST['quantidade'];
$mensagem = $_POST['mensagem'];

$data = implode('/', array_reverse(explode('-', $data)));

$destinatario = $email_adm;
$assunto = 'Nova Reserva';
$mensagem = 'Nome: '.$nome. "\r\n"."\r\n" .'Telefone: '.$telefone. "\r\n"."\r\n" .'Email: '.$email. "\r\n"."\r\n" .'Data Reserva: '.$data. "\r\n"."\r\n" .'Nº Pessoas: '.$pessoas. "\r\n"."\r\n" .'Mensagem: '.$mensagem;
$cabecalhos = "From: ".$email;
mail($destinatario, $assunto, $mensagem, $cabecalhos);

 ?>

<script>alert('Enviado com Sucesso.'); </script>

<meta http-equiv="refresh" content="0; url=index.php#mu-reservation">