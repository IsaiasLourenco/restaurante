<?php
@session_start();

if (isset($_SESSION['link_whatsapp'])) {
    echo $_SESSION['link_whatsapp']; // Retorna o link do WhatsApp
    unset($_SESSION['link_whatsapp']); // Remove o link da sessão após usá-lo
} else {
    echo "Erro: Link do WhatsApp não encontrado."; // Mensagem de fallback para depuração
}
?>