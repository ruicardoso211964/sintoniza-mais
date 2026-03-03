<?php
require_once 'admin/config.php';

// ATENÇÃO: Edite o email e a nova password aqui
$email = 'rclocucao@gmail.com'; 
$new_password = 'admin123'; // Password temporária

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Gerar hash da nova password
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
    $stmt->execute([$password_hash, $email]);

    if ($stmt->rowCount() > 0) {
        echo "<h1>Sucesso!</h1>";
        echo "<p>A password para o utilizador <strong>$email</strong> foi alterada para: <strong>$new_password</strong></p>";
        echo "<p><a href='login.php'>Clique aqui para fazer Login</a></p>";
    } else {
        echo "<h1>Erro</h1>";
        echo "<p>Não foi possível encontrar o utilizador ou a password já é essa.</p>";
    }

} catch (PDOException $e) {
    echo "Erro na base de dados: " . $e->getMessage();
}
?>
