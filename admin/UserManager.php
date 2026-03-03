<?php
require_once 'config.php';

class UserManager {
    private $pdo;

    public function __construct() {
        $this->pdo = getDBConnection();
    }

    // Obter todos os utilizadores ordenados por estado (Pendentes primeiro) e Data
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY approved ASC, created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Aprovar Utilizador
    public function approve($id) {
        $stmt = $this->pdo->prepare("UPDATE users SET approved = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Remover Utilizador (Rejeitar)
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Obter estatísticas para a dashboard
    public function getStats() {
        $total = $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $pending = $this->pdo->query("SELECT COUNT(*) FROM users WHERE approved = 0")->fetchColumn();
        return ['total' => $total, 'pending' => $pending];
    }

    // Obter user por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar utilizador
    public function update($id, $username, $email, $radio_name, $radio_role, $password = null) {
        if (!empty($password)) {
            // Se foi fornecida uma nova password, atualiza-a também (com hash)
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = ?, email = ?, radio_name = ?, radio_role = ?, password_hash = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $email, $radio_name, $radio_role, $password_hash, $id]);
        } else {
            // Se não, mantém a password antiga
            $sql = "UPDATE users SET username = ?, email = ?, radio_name = ?, radio_role = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $email, $radio_name, $radio_role, $id]);
        }
    }
}
?>
