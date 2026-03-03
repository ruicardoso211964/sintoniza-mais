<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debug: Check if config file exists
$configFile = __DIR__ . '/admin/config.php';
if (!file_exists($configFile)) {
    die("ERRO CRÍTICO: Ficheiro de configuração não encontrado em: $configFile");
}
require_once $configFile;

// Define admin email for notifications
define('ADMIN_EMAIL', 'rclocucao@gmail.com');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Questionnaire Fields
    $radio_name = trim($_POST['radio_name'] ?? '');
    $radio_role = trim($_POST['radio_role'] ?? '');
    $interest_reason = trim($_POST['interest_reason'] ?? '');
    $referral_source = trim($_POST['referral_source'] ?? '');

    // Basic Validation
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Por favor, preencha todos os campos obrigatórios.";
        header("Location: login.php");
        exit();
    }

    try {
        $pdo = getDBConnection();

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Este email já está registado.";
            header("Location: login.php");
            exit();
        }

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user (approved = 0 by default)
        $sql = "INSERT INTO users (username, email, password_hash, approved, role, radio_name, radio_role, interest_reason, referral_source) VALUES (?, ?, ?, 0, 'user', ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$username, $email, $password_hash, $radio_name, $radio_role, $interest_reason, $referral_source])) {
            
            // Send Email to Admin
            $subject = "Novo Registo Pendente: " . $username;
            $message = "Um novo utilizador registou-se no Sintoniza+.\n\n";
            $message .= "--- Dados do Utilizador ---\n";
            $message .= "Nome: " . $username . "\n";
            $message .= "Email: " . $email . "\n";
            $message .= "Rádio/Projeto: " . $radio_name . "\n";
            $message .= "Cargo: " . $radio_role . "\n";
            $message .= "Como conheceu: " . $referral_source . "\n\n";
            $message .= "--- Interesse na Plataforma ---\n";
            $message .= $interest_reason . "\n\n";
            $message .= "Por favor, aceda à base de dados para aprovar este utilizador.";
            
            $domain = $_SERVER['SERVER_NAME']; // sintonizamais.pt
            $headers = "From: Sintoniza+ <noreply@$domain>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Return-Path: noreply@$domain\r\n";
            $headers .= "Sender: noreply@$domain\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Attempt to send email with logging
            $logConfigFile = __DIR__ . '/admin/config_logs.php';
            
            if (file_exists($logConfigFile)) {
                 require_once $logConfigFile;
                 
                 if (mail(ADMIN_EMAIL, $subject, $message, $headers)) {
                    logErro("SUCESSO: Email aceite para " . ADMIN_EMAIL);
                 } else {
                    logErro("FALHA: Email recusado para " . ADMIN_EMAIL);
                    $_SESSION['debug_error'] = "O servidor recusou o envio do email.";
                 }
            } else {
                 // Fallback if log config is missing (so it doesn't crash)
                 if (!mail(ADMIN_EMAIL, $subject, $message, $headers)) {
                     $_SESSION['debug_error'] = "Falha no envio (e sistema de logs não encontrado).";
                 }
            }


            $_SESSION['success'] = "Registo efetuado com sucesso! A sua conta aguarda aprovação do administrador. Receberá um email quando estiver ativa.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Ocorreu um erro ao registar. Tente novamente.";
            header("Location: login.php");
            exit();
        }

    } catch (PDOException $e) {
        // DEBUG: Mostrar erro diretamente sem redirecionar
        die("<h1>ERRO DE SISTEMA</h1><p>" . $e->getMessage() . "</p><p>Volte atrás e tente novamente.</p>");
    }
} else {
    header("Location: login.php");
    exit();
}
?>
