<?php
require_once 'config.php';

try {
    $email = 'rclocucao@gmail.com';
    $password = 'gaspar211964';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $pdo = getDBConnection();

    // Inserir ou atualizar na base de dados
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role, approved) 
                           VALUES ('Admin', ?, ?, 'admin', 1) 
                           ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), role = 'admin', approved = 1");
    $stmt->execute([$email, $hash]);

    echo "SUCESSO: Utilizador $email atualizado/criado como Administrador Total.";
}
catch (Exception $e) {
    echo "ERRO: " . $e->getMessage();
}
?>
