<?php
session_start();

// Verifica se o utilizador está logado, se não, redireciona para o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userName = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Radialista';
$userRole = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Membro';
?>
<!DOCTYPE html>
<html class="dark" lang="pt-PT"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#06b6d4",
                        "accent-orange": "#f97316",
                        "accent-purple": "#a855f7",
                        "background-light": "#f5f7f8",
                        "background-dark": "#020617",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.75rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'neon-blue': '0 0 15px rgba(6, 182, 212, 0.5)',
                    }
                },
            },
        }</script>
<style>
        .glass-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-active {
            background: rgba(6, 182, 212, 0.15);
            border-left: 3px solid #06b6d4;
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.2);
            color: #06b6d4 !important;
        }
        .sidebar-active span {
             color: #06b6d4 !important;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="flex h-screen overflow-hidden">
<!-- Sidebar Navigation -->
<aside class="w-72 border-r border-slate-800 flex flex-col shrink-0 bg-background-dark">
<div class="p-8">
<div class="flex items-center gap-3">
<div class="size-12 rounded-lg flex items-center justify-center overflow-hidden"><img alt="Sintoniza+ Logo" class="w-full h-full object-contain" src="assets/img/logo.png"/></div>
<div>
<h1 class="text-white text-xl font-extrabold tracking-tight">Sintoniza<span class="text-primary">+</span></h1>
<p class="text-slate-400 text-[10px] uppercase tracking-widest font-bold">Premium Radio SaaS</p>
</div>
</div>
</div>
<nav class="flex-1 px-4 space-y-2">
<a class="sidebar-active flex items-center gap-4 px-4 py-3 rounded-lg text-primary transition-all" href="dashboard.php">
<span class="material-symbols-outlined fill-1">dashboard</span>
<span class="font-semibold">Dashboard</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all" href="noticias.php">
<span class="material-symbols-outlined">newspaper</span>
<span class="font-medium">Notícias</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all" href="eventos.php">
<span class="material-symbols-outlined">event</span>
<span class="font-medium">Eventos</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all" href="artistas.php">
<span class="material-symbols-outlined">mic_external_on</span>
<span class="font-medium">Artistas</span>
</a>
<div class="pt-6 pb-2 px-4">
<p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Sistema</p>
</div>
<?php if ($userRole === 'admin' || $userRole === 'Gestor da Estação'): ?>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all" href="admin/admin_fontes.php">
<span class="material-symbols-outlined">settings</span>
<span class="font-medium">Painel Admin</span>
</a>
<?php
endif; ?>
</nav>
<div class="p-6">
<div class="bg-gradient-to-br from-primary/20 to-slate-800 rounded-xl p-5 border border-primary/20">
<p class="text-sm font-semibold text-white mb-1">Broadcaster Pro</p>
<p class="text-xs text-slate-400 mb-4">Estás no plano premium.</p>
<button class="w-full py-2 bg-primary hover:bg-primary/90 text-white text-xs font-bold rounded-lg transition-colors">Ver Análises</button>
</div>
</div>
</aside>
<!-- Main Content Wrapper -->
<main class="flex-1 flex flex-col overflow-y-auto">
<!-- Header -->
<header class="h-20 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-10 shrink-0 bg-white/5 backdrop-blur-md sticky top-0 z-10">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="w-full bg-slate-100 dark:bg-slate-800/50 border-none rounded-xl py-2.5 pl-12 pr-4 focus:ring-2 focus:ring-primary/50 text-sm" placeholder="Pesquisar emissões, artistas ou análises..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<button class="relative p-2 text-slate-500 hover:text-primary transition-colors">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 size-2 bg-primary rounded-full border-2 border-background-dark"></span>
</button>
<div class="h-8 w-px bg-slate-200 dark:bg-slate-800"></div>
<div class="flex items-center gap-3 cursor-pointer group">
<div class="text-right">
<p class="text-sm font-bold text-slate-900 dark:text-white"><?php echo $userName; ?></p>
<p class="text-[11px] font-medium text-slate-500"><?php echo $userRole; ?></p>
</div>
<a href="logout.php" title="Sair" class="size-10 flex items-center justify-center rounded-full bg-slate-200 dark:bg-slate-800 border-2 border-primary hover:bg-slate-300 dark:hover:bg-slate-700 transition-colors">
<span class="material-symbols-outlined text-slate-600 dark:text-white">logout</span>
</a>
</div>
</div>
</header>
<!-- Page Content -->
<div class="p-10 space-y-10">
<!-- Welcome Section -->
<section>
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
<div>
<h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Bem-vindo de volta, <?php echo $userName; ?></h2>
<p class="text-slate-500 mt-2">Aqui está o coração da sua estação para <?php echo date('d \d\e F'); ?>.</p>
</div>
<div class="flex gap-4">
<div class="glass-card rounded-xl px-6 py-4 min-w-[160px]">
<p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Ouvintes em Direto</p>
<div class="flex items-end gap-2">
<span class="text-2xl font-bold text-primary">2.4k</span>
<span class="text-[10px] text-green-500 font-bold mb-1">+14%</span>
</div>
</div>
<div class="glass-card rounded-xl px-6 py-4 min-w-[160px]">
<p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Média de Sessão</p>
<div class="flex items-end gap-2">
<span class="text-2xl font-bold text-accent-orange">42m</span>
<span class="text-[10px] text-green-500 font-bold mb-1">+5%</span>
</div>
</div>
</div>
</div>
</section>
<!-- Recent News Grid -->
<section>
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">bolt</span>
<h3 class="text-xl font-bold">Notícias Recentes</h3>
</div>
<a class="text-sm font-bold text-primary hover:underline" href="#">Ver todas as notícias</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- News Card 1 -->
<div class="glass-card rounded-xl overflow-hidden group hover:translate-y-[-4px] transition-all duration-300">
<div class="h-48 overflow-hidden relative">
<div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent z-10"></div>
<div class="absolute top-4 left-4 z-20 bg-primary text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md">Notícias</div>
<div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500" data-alt="Professional radio studio equipment with microphones" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAwoFETqLHvrAljwblykh8iEv5920a0rnYp-NF5NOU_RVuXJy5X-CjI4mUM5BjFSpNSTT7YHGLdILVgKO6Yk47SIS4N0kfTQZ5zPHPsUaat1fvK4AUF_tB_irPYtTqNsoYwc9BZ9J-RlL5h85kXFsjKugijNL3THgWQIkimzobim7Ezh1A9PwNCc0-YZwS3daCOaV9K4BCxu-tXZDWJXYx3AYuG-kJzlHLzBqabY85wnwqROpB5rS3phmFwazg4ona4ms_eqJSpLjI');"></div>
</div>
<div class="p-6">
<h4 class="text-lg font-bold leading-tight mb-3 group-hover:text-primary transition-colors">Futuro do FM: Tendências de Radiodifusão Digital Híbrida</h4>
<div class="flex items-center justify-between text-xs text-slate-400 font-medium">
<span class="flex items-center gap-1">leitura de 5 min</span>
<span>há 2 horas</span>
</div>
</div>
</div>
<!-- News Card 2 -->
<div class="glass-card rounded-xl overflow-hidden group hover:translate-y-[-4px] transition-all duration-300">
<div class="h-48 overflow-hidden relative">
<div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent z-10"></div>
<div class="absolute top-4 left-4 z-20 bg-primary text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md">Indústria</div>
<div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500" data-alt="Crowd of people at a music concert" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVgkK3uuYj4PmfImcKmmmcGvm1yhzHvQfkTlKtBYaE4QbAo3SOyOYiJEN8SS8H97KW3VLjaT0tUDQ7urV7sBucYmr7wtU6Ba4IQeu78hebT74Hk6RBC70GxkFLewHr5VJKmzmXGwXIzAHXg1iOYZDDkEgALkFq2N7yUfHTSKXEvNLVSTWQSwGId6xncq0yCI6bzbUNvHFfWQpO88xTX9JXWLX9NZeqVePW2lP0xhcaxTyimjXcl9JZnJiiLuf2TFFTNiliibbrKoM');"></div>
</div>
<div class="p-6">
<h4 class="text-lg font-bold leading-tight mb-3 group-hover:text-primary transition-colors">Envolvimento dos Ouvintes: Dominar o Segmento de Chamadas</h4>
<div class="flex items-center justify-between text-xs text-slate-400 font-medium">
<span class="flex items-center gap-1">leitura de 5 min</span>
<span>há 2 horas</span>
</div>
</div>
</div>
<!-- News Card 3 -->
<div class="glass-card rounded-xl overflow-hidden group hover:translate-y-[-4px] transition-all duration-300">
<div class="h-48 overflow-hidden relative">
<div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent z-10"></div>
<div class="absolute top-4 left-4 z-20 bg-primary text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md">Atualização</div>
<div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500" data-alt="Modern high-tech data visualization on a screen" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBhQ52jwD05IupOx_fhgar8EPKIjFfY7M75Y4zj6h6vzYboxnjuBg6JoftTxDN77dB1dhesnmzzqKHfomY5axBRtYv14MrCaV5CogaqdlEeH1nILvYgqRFG4ElyFaCQxjTzg-aYamoRbDLfgilwkpQlDz63iKXdl7Bh1rrFH4uO-h-J_v1icQzhLz6wliYdcr8DhWAZibGfw4WFZYyX0yNKOUeaygPJa1mOdpejPyXCwxaXqBmSFD-aWnmy-PM19RN78mat4oMUKC4');"></div>
</div>
<div class="p-6">
<h4 class="text-lg font-bold leading-tight mb-3 group-hover:text-primary transition-colors">Sintoniza+ v2.4: Novo Curador de Playlists com IA</h4>
<div class="flex items-center justify-between text-xs text-slate-400 font-medium">
<span class="flex items-center gap-1">leitura de 5 min</span>
<span>1 day ago</span>
</div>
</div>
</div>
</div>
</section>
<!-- Upcoming Events Grid -->
<section>
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-accent-orange">calendar_month</span>
<h3 class="text-xl font-bold">Próximos Eventos</h3>
</div>
<a class="text-sm font-bold text-accent-orange hover:underline" href="#">Calendário completo</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Event Card 1 -->
<div class="glass-card rounded-xl p-2 flex flex-col md:flex-row gap-6 group hover:border-accent-orange/30 transition-all duration-300">
<div class="w-full md:w-48 h-40 shrink-0 rounded-lg overflow-hidden relative">
<div class="absolute top-2 left-2 z-20 bg-accent-orange text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md">Live Stream</div>
<div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500" data-alt="Artist performing with a guitar on stage" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCSlY2Y70MN-GhptQII6BI2VzvMpn_nnoDRcg9u4PvkzXWyS-Rpwy9BhICqMTSSHDxLpoKc5Llv-0T8BqNDKtMTTPaF0ycY75xakfnQmxx2OivTr7BVf4CrbWSsRXe-AYeOKw7LfX3Id6Hn5KByB4fS-3bCwUsCaVeDx6LWZRRkuc_tvme4kE6T0314CCQ4LQWJ8sBNrQJYF13vFRyBCmkbGl9yJ1HvMiIZxtxkaWq4x31kaa4s4lGZSaDI2OP5nNGFIEs2cZ6W8-M');"></div>
</div>
<div class="p-4 flex-1 flex flex-col justify-center">
<p class="text-accent-orange text-[11px] font-black uppercase tracking-widest mb-1">Ouvintes em Direto</p>
<h4 class="text-xl font-extrabold mb-2 group-hover:text-accent-orange transition-colors">Sessões da Meia-Noite: Acústico ao Vivo com Elara</h4>
<p class="text-sm text-slate-400 line-clamp-2">Atuação acústica exclusiva e entrevista com a sensação indie-pop Elara. Em direto do Estúdio A.</p>
<div class="mt-4 flex items-center gap-4">
<button class="px-4 py-1.5 bg-accent-orange/10 text-accent-orange border border-accent-orange/20 rounded-lg text-xs font-bold hover:bg-accent-orange hover:text-white transition-all">Lembrete</button>
<div class="flex -space-x-2">
<div class="size-6 rounded-full border-2 border-background-dark bg-slate-700" data-alt="Avatar of attending listener" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDZN92QdJfKyLWAe-zu5jB6-YlWuaacMgLtncJioL59PirdAGR9hwK7CW3PFkx-YpEijwdpHrE0m5ctersAFz7I5jUv8mmwOIhYbm7v_mqiDZ1nNS-3D44_FQFke0vxRYf_SzHcaAC9qKxtUxM65XqknyEf845Qa-ZfSBVujKEOxi3UXwZ1pBicjOIaFdjm-fO_-bo6-qOcsEy-YfA_X40KaTO5NtgVk2UXvcwQ_V8Bc9_F4p19Ttsp1rA68rIp7lnPRkxjBKzcCvI'); background-size: cover;"></div>
<div class="size-6 rounded-full border-2 border-background-dark bg-slate-700" data-alt="Avatar of attending listener" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC-fFoaW2tOlglKCFJXLOyNSpTaI9mdQayF9BXJmXbBSn_dJKYGBU04ljZlhCsQ7vBXw4EMdHJTOMs_Qn4Htf_JD5QyyAdzmg8c8Vq1Q5wy722Gxr5hiJ_VkaEdLTL8dzKg7H0wKNH6fhdOLfw-nlApTd45Hg2prdYfMI6eTZu4UtGGB4c9OfQcEzTouQMW3eAC-RzQrjd54p36pa4hY_wxCi_Zsa4opON2F9oSjj30bGjCOo2BMmWRYxB6S_ANUZeD8aCUR_gliYU'); background-size: cover;"></div>
<div class="size-6 rounded-full border-2 border-background-dark bg-slate-600 flex items-center justify-center text-[8px] font-bold">+1.2k</div>
</div>
</div>
</div>
</div>
<!-- Event Card 2 -->
<div class="glass-card rounded-xl p-2 flex flex-col md:flex-row gap-6 group hover:border-accent-orange/30 transition-all duration-300">
<div class="w-full md:w-48 h-40 shrink-0 rounded-lg overflow-hidden relative">
<div class="absolute top-2 left-2 z-20 bg-accent-orange text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md">Interview</div>
<div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-500" data-alt="DJ controller and mixer with neon lights" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBnWYv02SrRrd6L2z1VZbLwCcW0ig1BckBTRzsANsbdThdi9YlCI6MJInPMiS15seQY4xj-zHUHezFlUcNHhDfnLpoEtTIvXB5fHppRDhhFaBkGjZmVBWxvA5hrAWAY_pPhmLTsK608Q7CcqoQuYzXLBXMESgEP23RxmGyTizi9HZ5uBzDRE7KsyxGQM7u1oWJEtanaC1FsP43MnaPnAZ4SGxiKmAygwlls0INHtd5ZSyHITsGFZBVNmcvd1rb0mehGpPABN3j6cfM');"></div>
</div>
<div class="p-4 flex-1 flex flex-col justify-center">
<p class="text-accent-orange text-[11px] font-black uppercase tracking-widest mb-1">Média de Sessão</p>
<h4 class="text-xl font-extrabold mb-2 group-hover:text-accent-orange transition-colors">Cimeira de Música Eletrónica: Conversa Virtual</h4>
<p class="text-sm text-slate-400 line-clamp-2">Junte-se a DJs globais para discutir a evolução das batidas eletrónicas na indústria do rádio.</p>
<div class="mt-4 flex items-center gap-4">
<button class="px-4 py-1.5 bg-accent-orange/10 text-accent-orange border border-accent-orange/20 rounded-lg text-xs font-bold hover:bg-accent-orange hover:text-white transition-all">Lembrete</button>
<div class="flex -space-x-2">
<div class="size-6 rounded-full border-2 border-background-dark bg-slate-700" data-alt="Avatar of attending listener" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCTsUwh0f234YXWp9iq5w0x9Q27DjNb0IqzhGpq_uRdnLoBsZtZZHRBirl2t1OaZiNYTxr2_kE8xIH1Yo3NCfMQNQygi5gdntuLYkkufviZ_QMpjo2KkAdvOkOZR5yB3PZ3VTg427vHovsBIinVROqBBkPYJC_iWBpOFoFtHNxyUaw9BLsHb8rmiPOn6kc5cOL-8aGXq8SSeH2u7OT2jyyhFD1q1spKIw9vELg7D5pwSm9FE7SN_fUiMvHVV9VDExqZri1sXKpRn2c'); background-size: cover;"></div>
<div class="size-6 rounded-full border-2 border-background-dark bg-slate-600 flex items-center justify-center text-[8px] font-bold">+840</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<!-- Footer for additional space -->
<footer class="p-10 text-center">
<p class="text-slate-500 text-xs">© 2024 Sintoniza+ Premium SaaS. Todos os sistemas operacionais. Desenvolvido por Broadcaster AI.</p>
</footer>
</main>
</div>
</body></html>