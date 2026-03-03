<?php
// Script simples para visualizar logs (apenas para debug, proteger ou remover em produção final)
define('LOG_FILE', __DIR__ . '/logs/sistema_erros.log');

echo '<!DOCTYPE html>
<html lang="pt" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizador de Logs</title>
    <style>
        body { background-color: #101922; color: #fff; font-family: monospace; padding: 20px; }
        .log-container { background-color: #1e293b; padding: 15px; border-radius: 8px; overflow-x: auto; white-space: pre-wrap; }
        h1 { color: #137fec; }
        .refresh-btn { background: #137fec; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Logs do Sistema</h1>
    <button class="refresh-btn" onclick="location.reload()">Atualizar Logs</button>
    <div class="log-container">';

if (file_exists(LOG_FILE)) {
    $logs = file_get_contents(LOG_FILE);
    if (empty($logs)) {
        echo "Ficheiro de log vazio.";
    } else {
        echo htmlspecialchars($logs);
    }
} else {
    echo "<p style='color:red'>ERRO: Ficheiro de log não encontrado.</p>";
    echo "<p>O sistema está à procura em: <strong>" . LOG_FILE . "</strong></p>";
    echo "<p>A diretoria atual é: " . __DIR__ . "</p>";
    
    // Tentar criar para testar permissões
    if (file_put_contents(LOG_FILE, "Teste de criação de log.\n")) {
         echo "<p style='color:green'>SUCESSO: O sistema conseguiu criar o ficheiro agora. Atualize a página.</p>";
    } else {
         echo "<p style='color:orange'>AVISO: O sistema não tem permissão para criar ficheiros nesta pasta.</p>";
    }
}

echo '</div>
</body>
</html>';
?>
