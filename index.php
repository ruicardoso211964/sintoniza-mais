<?php session_start(); ?>
<!DOCTYPE html>
<html class="dark" lang="pt-PT"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#22d3ee",
                        "accent": "#f97316",
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
        .glass {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(34, 211, 238, 0.15) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="relative min-h-screen w-full flex flex-col overflow-x-hidden">
<!-- Hero Background Glow -->
<div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] hero-gradient pointer-events-none"></div>
<div class="layout-container flex h-full grow flex-col">
<!-- Navigation -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-white/10 px-6 py-4 lg:px-20 glass sticky top-0 z-50">
<a class="flex items-center" href="#">
<img alt="Sintoniza+ Logo" class="h-10 w-auto object-contain" src="assets/img/logo.png"/>
</a>
<nav class="hidden md:flex flex-1 justify-center gap-8">
<a class="text-slate-300 hover:text-primary text-sm font-medium transition-colors" href="#">Funcionalidades</a>
<a class="text-slate-300 hover:text-primary text-sm font-medium transition-colors" href="#">Preçário</a>
<a class="text-slate-300 hover:text-primary text-sm font-medium transition-colors" href="#">Sobre</a>
<a class="text-slate-300 hover:text-primary text-sm font-medium transition-colors" href="#">Contacto</a>
</nav>
<div class="flex items-center gap-4">
<?php if (isset($_SESSION['user_id'])): ?>
    <a href="dashboard.php" class="hidden sm:flex min-w-[120px] cursor-pointer items-center justify-center rounded-lg h-10 px-5 bg-primary text-background-dark text-sm font-bold transition-all hover:scale-105 active:scale-95">
        Dashboard
    </a>
    <div class="bg-primary/20 p-1 flex items-center justify-center rounded-full border border-primary/30 size-10 hover:bg-primary/40 transition-colors">
        <a href="logout.php" title="Sair" class="flex items-center justify-center">
            <span class="material-symbols-outlined text-white">logout</span>
        </a>
    </div>
<?php
else: ?>
    <a href="login.php" class="hidden sm:flex min-w-[120px] cursor-pointer items-center justify-center rounded-lg h-10 px-5 bg-primary text-background-dark text-sm font-bold transition-all hover:scale-105 active:scale-95">
        Começar Agora
    </a>
<?php
endif; ?>
</div>
</header>
<main class="flex-1">
<!-- Hero Section -->
<div class="max-w-7xl mx-auto px-6 lg:px-20 py-16 lg:py-24">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="flex flex-col gap-8">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 w-fit">
<span class="flex size-2 rounded-full bg-primary animate-pulse"></span>
<span class="text-primary text-xs font-bold uppercase tracking-wider">Nova Era 2024</span>
</div>
<div class="flex flex-col gap-4">
<h1 class="text-white text-5xl lg:text-7xl font-black leading-tight tracking-tight">
                                    A Próxima Geração da <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent">Radiodifusão</span>
</h1>
<p class="text-slate-400 text-lg lg:text-xl leading-relaxed max-w-xl">
                                    Simplifique a sua emissão com a nossa plataforma SaaS de gestão inteligente. Tecnologia de ponta, automação por IA e controlo total para rádios modernas.
                                </p>
</div>
<div class="flex flex-wrap gap-4">
<a href="<?php echo isset($_SESSION['user_id']) ? 'dashboard.php' : 'login.php'; ?>" class="flex min-w-[180px] cursor-pointer items-center justify-center rounded-xl h-14 px-8 bg-primary text-background-dark text-base font-black transition-all hover:shadow-[0_0_20px_rgba(34,211,238,0.4)]">
                                    Começar Agora
                                </a>
<button class="flex min-w-[180px] cursor-pointer items-center justify-center rounded-xl h-14 px-8 border border-white/10 hover:bg-white/5 text-white text-base font-bold transition-all">
                                    Ver Demonstração
                                </button>
</div>
</div>
<div class="relative">
<div class="absolute -inset-4 bg-gradient-to-tr from-primary/20 to-accent/20 blur-3xl rounded-full"></div>
<div class="relative glass rounded-xl overflow-hidden shadow-2xl border border-white/10">
<div class="bg-slate-800/50 p-2 flex gap-1.5 border-b border-white/5">
<div class="size-2.5 rounded-full bg-red-500/50"></div>
<div class="size-2.5 rounded-full bg-yellow-500/50"></div>
<div class="size-2.5 rounded-full bg-green-500/50"></div>
</div>
<div class="aspect-video bg-slate-900 bg-center bg-cover" data-alt="Interface de dashboard analítico futurista com gráficos ciano" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD6TBYlEpN7HOcQT1kjor-tn0Gl7x5cWOC7Rr2Bj3iqjLneIa8Fn8ZlwYRQQRI_paSbPdad0vstQsac4F9-rJRediQSJoKbq3A-hiGYuN94D6k6O1yanpW5X2dWgBZBsfE-bHuNOgx2dwIG5hCVY56CEWlLXmlKi2RbammmZW6IKoF9JehHq9lIy7t_dApxPw58xHC1nnf7ImxrnDjZP2f5Rl5rHEBy55gaoTwPEIYTQ7SY7fH0HjuhnzV_oW_N2mdz0_H9kgZwUm8");'></div>
</div>
</div>
</div>
</div>
<!-- Features Section -->
<div class="max-w-7xl mx-auto px-6 lg:px-20 py-20">
<div class="flex flex-col gap-4 mb-16 text-center lg:text-left">
<h2 class="text-primary font-bold tracking-widest uppercase text-sm">Funcionalidades Elite</h2>
<h3 class="text-white text-3xl lg:text-5xl font-bold tracking-tight">O futuro da rádio, <span class="italic font-light">hoje.</span></h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Card 1 -->
<div class="group flex flex-col gap-6 p-8 rounded-xl glass hover:border-primary/50 transition-all hover:-translate-y-2">
<div class="size-14 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors">
<span class="material-symbols-outlined text-3xl">dashboard_customize</span>
</div>
<div>
<h4 class="text-white text-xl font-bold mb-3">Dashboard Inteligente</h4>
<p class="text-slate-400 leading-relaxed">Painel centralizado com métricas em tempo real, audiência ao vivo e controlo total da emissão num só lugar.</p>
</div>
<div class="mt-auto pt-4">
<span class="text-primary text-sm font-bold cursor-pointer inline-flex items-center gap-2 hover:gap-3 transition-all">Saber mais <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
</div>
</div>
<!-- Card 2 -->
<div class="group flex flex-col gap-6 p-8 rounded-xl glass hover:border-accent/50 transition-all hover:-translate-y-2">
<div class="size-14 rounded-lg bg-accent/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-background-dark transition-colors">
<span class="material-symbols-outlined text-3xl">news</span>
</div>
<div>
<h4 class="text-white text-xl font-bold mb-3">Notícias Automáticas</h4>
<p class="text-slate-400 leading-relaxed">Integração nativa com IA que gera resumos de notícias locais e mundiais para leitura automática entre blocos.</p>
</div>
<div class="mt-auto pt-4">
<span class="text-accent text-sm font-bold cursor-pointer inline-flex items-center gap-2 hover:gap-3 transition-all">Saber mais <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
</div>
</div>
<!-- Card 3 -->
<div class="group flex flex-col gap-6 p-8 rounded-xl glass hover:border-primary/50 transition-all hover:-translate-y-2">
<div class="size-14 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-background-dark transition-colors">
<span class="material-symbols-outlined text-3xl">calendar_month</span>
</div>
<div>
<h4 class="text-white text-xl font-bold mb-3">Gestão de Eventos</h4>
<p class="text-slate-400 leading-relaxed">Calendário dinâmico drag-and-drop para planeamento de grelhas, convidados e publicidade sem esforço.</p>
</div>
<div class="mt-auto pt-4">
<span class="text-primary text-sm font-bold cursor-pointer inline-flex items-center gap-2 hover:gap-3 transition-all">Saber mais <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
</div>
</div>
</div>
</div>
<!-- Secondary Info Section -->
<div class="max-w-7xl mx-auto px-6 lg:px-20 py-20">
<div class="rounded-xl overflow-hidden bg-gradient-to-r from-slate-900 to-background-dark border border-white/5 relative">
<div class="absolute right-0 top-0 w-1/3 h-full bg-primary/5 blur-3xl rounded-full"></div>
<div class="flex flex-col lg:flex-row items-center gap-12 p-10 lg:p-20 relative z-10">
<div class="lg:w-1/2 flex flex-col gap-6">
<h2 class="text-white text-3xl lg:text-4xl font-black">Porquê escolher o Sintoniza+?</h2>
<p class="text-slate-400 text-lg">A solução completa para levar a sua rádio ao próximo nível com eficiência e inovação constante.</p>
<div class="grid grid-cols-1 gap-4">
<div class="flex items-start gap-4 p-4 rounded-lg bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
<span class="material-symbols-outlined text-primary">cloud_done</span>
<div>
<p class="text-white font-bold">Cloud Nativa</p>
<p class="text-sm text-slate-500">Aceda à sua rádio de qualquer lugar, sem hardware complexo.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-lg bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
<span class="material-symbols-outlined text-accent">bolt</span>
<div>
<p class="text-white font-bold">Automação IA</p>
<p class="text-sm text-slate-500">Reduza o trabalho manual e otimize a sua playlist diária.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-lg bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
<span class="material-symbols-outlined text-primary">support_agent</span>
<div>
<p class="text-white font-bold">Suporte 24/7</p>
<p class="text-sm text-slate-500">Equipa técnica sempre disponível para manter a sua rádio no ar.</p>
</div>
</div>
</div>
</div>
<div class="lg:w-1/2">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-xl shadow-2xl rotate-3 scale-95" data-alt="Microfone de rádio profissional em estúdio moderno com luzes néon" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDnknHABaUwo_DTc6ZfqfkLvidDj7wglgkSdYRPYpq8MMb-iCzOD437__aAgE6RFTda4Q8Ps7i26mqNebJV49Mnpeo2iQlcVgEWNwtnwQpvn_qkxOMY23qQZxjSHqUeXWDKyhyO-6qhlNk07ptMwF26TTZ91l4eyXZAxf9X-rBZEdae_XoWL64hgXptrm1v3gZglR0IzxUx3uuKXCzRCrJuwnO4E7LC_91ubtrlSXdSWm2X2hTAirSLeJ7odhaDCyl7moo_qFIv6cY");'></div>
</div>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="border-t border-white/10 px-6 lg:px-20 py-12 glass">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
<a class="flex items-center" href="#">
<img alt="Sintoniza+ Logo" class="h-12 w-auto object-contain" src="assets/img/logo.png"/>
</a>
<div class="flex gap-8">
<a class="text-slate-500 hover:text-white transition-colors" href="#">Políticas</a>
<a class="text-slate-500 hover:text-white transition-colors" href="#">Termos</a>
<a class="text-slate-500 hover:text-white transition-colors" href="#">Privacidade</a>
</div>
<p class="text-slate-600 text-sm">© 2024 Sintoniza+. Todos os direitos reservados.</p>
</div>
</footer>
</div>
</div>
</body></html>