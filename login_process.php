<?php
session_start();
require_once 'admin/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Por favor, preencha todos os campos.";
        header("Location: login.php");
        exit();
    }

    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT id, username, password_hash, role, approved FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Check if approved
            if ($user['approved'] == 1) {
                // Login Success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: dashboard.php");
                exit();
            } else {
                // Account not approved
                $_SESSION['error'] = "A sua conta aguarda aprovação do administrador.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Email ou password incorretos.";
            header("Location: login.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro de sistema: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
