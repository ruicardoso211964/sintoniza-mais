<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

echo "<h1>Diagnóstico e Reparação da Base de Dados</h1>";

try {
    $pdo = getDBConnection();
    
    // 1. Verificar colunas existentes
    $stmt = $pdo->query("SHOW COLUMNS FROM users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Colunas Atuais na Tabela 'users':</h3>";
    echo "<ul>";
    foreach ($columns as $col) {
        echo "<li>" . htmlspecialchars($col) . "</li>";
    }
    echo "</ul>";

    // 2. Definir colunas necessárias e seus SQLs de criação
    $required_columns = [
        'radio_name' => "ADD COLUMN `radio_name` varchar(100) DEFAULT NULL AFTER `approved`",
        'radio_role' => "ADD COLUMN `radio_role` varchar(100) DEFAULT NULL AFTER `radio_name`",
        'radio_website' => "ADD COLUMN `radio_website` varchar(255) DEFAULT NULL AFTER `radio_role`",
        'interest_reason' => "ADD COLUMN `interest_reason` text DEFAULT NULL AFTER `radio_website`",
        'referral_source' => "ADD COLUMN `referral_source` varchar(100) DEFAULT NULL AFTER `interest_reason`"
    ];

    $missing = [];
    foreach ($required_columns as $colName => $sql) {
        if (!in_array($colName, $columns)) {
            $missing[$colName] = $sql;
        }
    }

    // 3. Ação
    if (empty($missing)) {
        echo "<h2 style='color:green'>Tudo OK! A base de dados já tem todas as colunas necessárias.</h2>";
        echo "<p>Pode voltar e tentar fazer o registo agora.</p>";
    } else {
        echo "<h2 style='color:orange'>Faltam " . count($missing) . " colunas!</h2>";
        
        if (isset($_POST['fix'])) {
            echo "<div style='background:#f0f0f0; padding:10px; border:1px solid #ccc;'>";
            foreach ($missing as $colName => $sql) {
                try {
                    $pdo->exec("ALTER TABLE `users` " . $sql);
                    echo "<p style='color:green'>+ Coluna <strong>$colName</strong> adicionada com sucesso.</p>";
                } catch (PDOException $e) {
                    echo "<p style='color:red'>Erro ao adicionar $colName: " . $e->getMessage() . "</p>";
                }
            }
            echo "</div>";
            echo "<h3>Concluído. Atualize a página para confirmar.</h3>";
        } else {
            echo "<p>As seguintes colunas estão em falta:</p><ul>";
            foreach ($missing as $col => $sql) {
                echo "<li><strong>$col</strong></li>";
            }
            echo "</ul>";
            echo "<form method='post'><button type='submit' name='fix' style='padding:10px 20px; font-size:18px; background:blue; color:white; cursor:pointer;'>Reparar Automaticamente Agora</button></form>";
        }
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red'>Erro Fatal de Conexão: " . $e->getMessage() . "</h2>";
}
?>
