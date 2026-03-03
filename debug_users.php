<?php
require_once 'admin/config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>Lista de Utilizadores na Base de Dados</h1>";
    
    $stmt = $pdo->query("SELECT id, username, email, role, approved FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Aprovado</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['role']) . "</td>";
            echo "<td>" . htmlspecialchars($user['approved']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não existem utilizadores registados na tabela 'users'.</p>";
    }

} catch (PDOException $e) {
    echo "Erro na base de dados: " . $e->getMessage();
}
?>
