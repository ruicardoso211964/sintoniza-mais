<?php
require_once 'config.php';

class FonteManager {
    private $pdo;

    public function __construct() {
        $this->pdo = getDBConnection();
    }

    // Criar nova fonte
    public function create($nome, $url_base, $url_rss, $categoria, $ativa = 1) {
        $sql = "INSERT INTO fontes_conteudo (nome, url_base, url_rss, categoria, ativa) VALUES (:nome, :url_base, :url_rss, :categoria, :ativa)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':url_base' => $url_base,
            ':url_rss' => $url_rss,
            ':categoria' => $categoria,
            ':ativa' => $ativa
        ]);
    }

    // Ler todas as fontes
    public function getAll() {
        $sql = "SELECT * FROM fontes_conteudo ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Ler uma fonte específica por ID
    public function getById($id) {
        $sql = "SELECT * FROM fontes_conteudo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Atualizar fonte
    public function update($id, $nome, $url_base, $url_rss, $categoria, $ativa) {
        $sql = "UPDATE fontes_conteudo SET nome = :nome, url_base = :url_base, url_rss = :url_rss, categoria = :categoria, ativa = :ativa WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':url_base' => $url_base,
            ':url_rss' => $url_rss,
            ':categoria' => $categoria,
            ':ativa' => $ativa
        ]);
    }

    // Apagar fonte
    public function delete($id) {
        $sql = "DELETE FROM fontes_conteudo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Devolve array de cores/classes baseadas na categoria para UI ficar bonita
    public function getCategoryBadgeClass($categoria) {
        // Normaliza a categoria para lowercase para comparação
        $cat = mb_strtolower($categoria, 'UTF-8');
        
        if (strpos($cat, 'notícias') !== false || strpos($cat, 'news') !== false) {
            return 'text-cyan-300 bg-cyan-900/50';
        }
        if (strpos($cat, 'eventos') !== false || strpos($cat, 'agenda') !== false) {
            return 'text-amber-300 bg-amber-900/50';
        }
        if (strpos($cat, 'meteoro') !== false || strpos($cat, 'tempo') !== false) {
            return 'text-blue-300 bg-blue-900/50';
        }
        if (strpos($cat, 'música') !== false || strpos($cat, 'musical') !== false) {
            return 'text-lime-300 bg-lime-900/50';
        }
        if (strpos($cat, 'artistas') !== false) {
            return 'text-fuchsia-300 bg-fuchsia-900/50';
        }
        
        // Default
        return 'text-slate-300 bg-slate-700/50';
    }
}
?>
