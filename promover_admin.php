<?php
require_once 'admin/config.php';

// ATENÇÃO: Edite o email abaixo para o email da sua conta
$email_to_promote = 'rclocucao@gmail.com'; 

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("UPDATE users SET role = 'admin', approved = 1 WHERE email = ?");
    $stmt->execute([$email_to_promote]);

    if ($stmt->rowCount() > 0) {
        echo "Sucesso! O utilizador '$email_to_promote' agora é Administrador.";
    } else {
        echo "Nenhum utilizador encontrado com o email '$email_to_promote'. Verifique se já se registou.";
    }

} catch (PDOException $e) {
    echo "Erro na base de dados: " . $e->getMessage();
}
?>
