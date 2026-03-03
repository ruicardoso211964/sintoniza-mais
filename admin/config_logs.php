<?php
// Define o caminho para o ficheiro de log de forma absoluta e segura
// dirname(__DIR__) sobe um nível a partir de 'admin' para a raiz do site
define('LOG_FILE', dirname(__DIR__) . '/logs/sistema_erros.log');

/**
 * Regista uma mensagem de erro no ficheiro de log
 * @param string $mensagem A mensagem a registar
 */
function logErro($mensagem) {
    // Cria a diretoria de logs se não existir
    $logDir = dirname(LOG_FILE);
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $data = date('Y-m-d H:i:s');
    $logEntry = "[$data] $mensagem" . PHP_EOL;
    
    // Escreve no ficheiro (adiciona ao final)
    error_log($logEntry, 3, LOG_FILE);
}
?>
