<?php
// Script de diagnóstico de email
require_once 'admin/config_logs.php';

$recipient = 'rclocucao@gmail.com'; // O seu email
$subject = 'Teste de Envio de Email Sintoniza+';
$message = 'Se recebeu este email, o seu servidor PHP está configurado corretamente para enviar emails nativos.';
$headers = 'From: noreply@sintoniza.plus' . "\r\n" .
           'Reply-To: noreply@sintoniza.plus' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

echo "<h1>Teste de Envio de Email</h1>";
echo "<p>Tentando enviar email para: <strong>$recipient</strong></p>";

// Remover o @ para ver warnings no browser
if (mail($recipient, $subject, $message, $headers)) {
    echo "<p style='color: green;'><strong>Sucesso!</strong> A função mail() retornou TRUE. Verifique a sua caixa de entrada (e spam).</p>";
} else {
    echo "<p style='color: red;'><strong>Falha!</strong> A função mail() retornou FALSE.</p>";
    echo "<p>Causas prováveis:</p>";
    echo "<ul>";
    echo "<li>Servidor SMTP não configurado no php.ini (comum em XAMPP/Localhost).</li>";
    echo "<li>Porta 25 bloqueada pelo ISP.</li>";
    echo "<li>Servidor de correio local não está a correr.</li>";
    echo "</ul>";
    
    // Logar o erro
    logErro("Teste de email falhou para $recipient");
    echo "<p>Erro registado em logs/sistema_erros.log</p>";
}
?>
