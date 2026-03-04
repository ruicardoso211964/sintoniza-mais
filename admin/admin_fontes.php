<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
require_once 'config.php';
require_once 'FonteManager.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'Gestor da Estação') {
    die("Acesso negado. Apenas administradores.");
}

$manager = new FonteManager();

// Handlers Básicos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
        $manager->delete($_POST['id']);
        header("Location: admin_fontes.php");
        exit;
    }
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $nome = $_POST['nome'] ?? '';
        $url_base = $_POST['url_base'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        if ($nome && $url_base && $categoria) {
            $manager->create($nome, $url_base, $categoria);
        }
        header("Location: admin_fontes.php");
        exit;
    }
}

$fontes = $manager->getAll();

$userName = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin';
$userRole = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Admin';
?>
<!DOCTYPE html>
<html class="dark" lang="pt-PT"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3c83f6",
                        "background-light": "#f5f7f8",
                        "background-dark": "#020617",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-item-active {
            background: rgba(60, 131, 246, 0.15);
            border-right: 3px solid #3c83f6;
        }
        .source-row:hover .action-icons {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">
<div class="flex h-screen overflow-hidden">
<!-- Sidebar Navigation -->
<aside class="w-64 border-r border-slate-200 dark:border-slate-800 flex flex-col bg-background-light dark:bg-background-dark shrink-0">
<div class="p-6 flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
<span class="material-symbols-outlined">radio</span>
</div>
<div>
<h1 class="text-lg font-bold tracking-tight">Sintoniza+</h1>
<p class="text-xs text-slate-500 dark:text-slate-400">Administração</p>
</div>
</div>
<nav class="flex-1 px-3 space-y-1 mt-4">
<a class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="../dashboard.php">
<span class="material-symbols-outlined text-[22px]">dashboard</span>
<span class="text-sm font-medium">Dashboard Sintoniza+</span>
</a>
<a class="flex items-center gap-3 px-3 py-3 rounded-lg text-primary sidebar-item-active" href="#">
<span class="material-symbols-outlined text-[22px]">database</span>
<span class="text-sm font-medium">Fontes de Conteúdo</span>
</a>
<a class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-[22px]">gavel</span>
<span class="text-sm font-medium">Moderação</span>
</a>
<a class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-[22px]">group</span>
<span class="text-sm font-medium">Utilizadores</span>
</a>
<div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800">
<a class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-[22px]">settings</span>
<span class="text-sm font-medium">Definições</span>
</a>
</div>
</nav>
<div class="p-4 mt-auto">
<div class="glass-panel p-4 rounded-xl flex items-center gap-3">
<img alt="Admin" class="w-10 h-10 rounded-full bg-slate-200 object-cover border border-slate-700" src="../assets/img/logo.png" />
<div class="overflow-hidden">
<p class="text-sm font-semibold truncate"><?php echo $userName; ?></p>
<p class="text-xs text-slate-500 truncate"><?php echo $userRole; ?></p>
</div>
<a href="../logout.php" title="Sair" class="ml-auto text-slate-400 hover:text-white transition-colors">
    <span class="material-symbols-outlined">logout</span>
</a>
</div>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 overflow-y-auto bg-slate-50 dark:bg-background-dark/50">
<header class="p-8 pb-4">
<div class="flex flex-wrap items-center justify-between gap-6">
<div>
<h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Gestão de Fontes</h2>
<p class="text-slate-500 dark:text-slate-400 mt-1 max-w-lg">Adicione, edite ou remova as fontes de conteúdo da plataforma para manter os feeds atualizados.</p>
</div>
<button onclick="document.getElementById('addModal').classList.remove('hidden')" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-primary/20 active:scale-95">
<span class="material-symbols-outlined">add_circle</span>
<span>Adicionar Nova Fonte</span>
</button>
</div>
<!-- Tabs -->
<div class="flex gap-8 mt-10 border-b border-slate-200 dark:border-slate-800">
<button class="pb-4 text-sm font-bold border-b-2 border-primary text-primary">Todas as Fontes</button>
<button class="pb-4 text-sm font-medium text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Ativas</button>
<button class="pb-4 text-sm font-medium text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Inativas</button>
<button class="pb-4 text-sm font-medium text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Pendentes</button>
</div>
</header>
<section class="p-8">
<!-- Source Cards List -->
<div class="space-y-3">
<!-- Column Headers -->
<div class="grid grid-cols-12 px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
<div class="col-span-4">Nome da Fonte</div>
<div class="col-span-3">URL</div>
<div class="col-span-3">Tipo de Conteúdo</div>
<div class="col-span-2 text-right">Ações</div>
</div>
<!-- Dynamic Rows -->
<?php foreach ($fontes as $fonte): ?>
    <div class="source-row grid grid-cols-12 items-center px-6 py-5 glass-panel rounded-xl group transition-all hover:bg-white/5 hover:border-slate-700">
        <div class="col-span-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-primary">rss_feed</span>
            </div>
            <span class="font-semibold truncate"><?php echo htmlspecialchars($fonte['nome']); ?></span>
        </div>
        <div class="col-span-3 text-sm text-slate-400 font-mono truncate px-2" title="<?php echo htmlspecialchars($fonte['url_base']); ?>">
            <?php echo htmlspecialchars($fonte['url_base']); ?>
        </div>
        <div class="col-span-3">
            <span class="px-3 py-1 text-xs font-bold rounded-full <?php echo $manager->getCategoryBadgeClass($fonte['categoria']); ?>">
                <?php echo htmlspecialchars($fonte['categoria']); ?>
            </span>
        </div>
        <div class="col-span-2 flex justify-end gap-3 action-icons opacity-0 transition-opacity">
            <button class="p-2 hover:bg-slate-700 rounded-lg text-slate-400 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-lg">edit</span>
            </button>
            <form method="POST" action="admin_fontes.php" onsubmit="return confirm('Eliminar fonte?');" class="m-0">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $fonte['id']; ?>">
                <button type="submit" class="p-2 hover:bg-red-500/10 rounded-lg text-slate-400 hover:text-red-500 transition-colors">
                    <span class="material-symbols-outlined text-lg">delete</span>
                </button>
            </form>
        </div>
    </div>
<?php
endforeach; ?>
<?php if (empty($fontes)): ?>
    <div class="text-center py-10 text-slate-500">Nenhuma fonte de conteúdo encontrada.</div>
<?php
endif; ?>
</div>
</div>
<!-- Pagination -->
<div class="mt-8 flex items-center justify-between">
<p class="text-sm text-slate-500">A mostrar <?php echo count($fontes); ?> de <?php echo count($fontes); ?> fontes</p>
<div class="flex items-center gap-1">
<button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">1</button>
<button class="w-10 h-10 flex items-center justify-center rounded-lg text-slate-400 hover:bg-slate-800 transition-colors font-medium">2</button>
<button class="w-10 h-10 flex items-center justify-center rounded-lg text-slate-400 hover:bg-slate-800 transition-colors font-medium">3</button>
<button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</section>
</main>
</div>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-700 rounded-2xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-slate-700 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Adicionar Fonte</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-slate-400 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="admin_fontes.php" class="p-6 space-y-4">
            <input type="hidden" name="action" value="add">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Nome da Fonte</label>
                <input type="text" name="nome" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">URL Base (Site/RSS)</label>
                <input type="url" name="url_base" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary" placeholder="https://...">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Categoria (ex: news, music, video)</label>
                <input type="text" name="categoria" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary">
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-5 py-2.5 rounded-lg font-medium text-slate-300 hover:bg-slate-800 transition-colors">Cancelar</button>
                <button type="submit" class="px-5 py-2.5 rounded-lg font-bold bg-primary text-white hover:bg-primary/90 transition-colors">Guardar Fonte</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fechar modal ao clicar fora
    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>
</body></html>