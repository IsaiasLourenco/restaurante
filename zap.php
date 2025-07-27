<?php
$nome = "Marcelo Ensina Fácil"; # Trazer Nome do Banco de Dados
$fone = "5511999999999"; # Trazer Telefone do Banco de Dados
# Mensagem Padrão
$mensagem = "Falae $nome, tudo bem meu amigo?%0A%0A
Essa é uma mensagem teste.%0A%0A
To fazendo aquele teste que me pediu.%0A%0A
Uma semi-automatização simples.%0A%0A
Acesse https://meusite.com.br para saber mais.";
#
echo "<a href='https://api.whatsapp.com/send?phone=$fone&text=$mensagem' target='_blank' title='Enviar Mensagem Via WhatsApp Web'><h1>Enviar Mensagem Via WhatsApp Web<br />$nome - $fone</h1></a>";
?>
