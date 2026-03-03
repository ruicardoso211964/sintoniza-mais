<?php
// Configuração da Base de Dados
// Preencha com os dados do seu alojamento cPanel

define('DB_HOST', 'localhost');
define('DB_USER', 'sintoniz_mais');
define('DB_PASS', 'gaspar211964');
define('DB_NAME', 'sintoniz_mais');

// Opções PDO para tratamento de erros e codificação
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
]);

/**
 * Função helper para obter conexão PDO
 */
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        return new PDO($dsn, DB_USER, DB_PASS, DB_OPTIONS);
    } catch (PDOException $e) {
        // Em produção, não mostrar detalhes do erro ao utilizador final
        die("Erro de ligação à base de dados: " . $e->getMessage());
    }
}
?>
