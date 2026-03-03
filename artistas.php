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
                    borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        .glass-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .neon-active {
            box-shadow: 0 0 15px rgba(60, 131, 246, 0.4);
            border: 1px solid rgba(60, 131, 246, 0.5);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="flex h-screen overflow-hidden">
<!-- Sidebar -->
<aside class="w-72 flex-shrink-0 border-r border-slate-200 dark:border-slate-800 bg-white/5 dark:bg-slate-900/50 backdrop-blur-xl flex flex-col p-6">
<div class="flex items-center gap-3 mb-10 px-2">
<div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
<span class="material-symbols-outlined text-2xl">graphic_eq</span>
</div>
<div>
<h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white leading-none">Sintoniza+</h1>
<p class="text-[10px] uppercase tracking-widest text-primary font-bold mt-1">Premium Audio</p>
</div>
</div>
<nav class="flex-1 space-y-2">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-all" href="dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-all" href="noticias.php">
<span class="material-symbols-outlined">newspaper</span>
<span class="font-medium">Notícias</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-all" href="eventos.php">
<span class="material-symbols-outlined">event</span>
<span class="font-medium">Eventos</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 text-primary neon-active transition-all" href="artistas.php">
<span class="material-symbols-outlined">mic_external_on</span>
<span class="font-medium">Artistas</span>
</a>
<div class="pt-6 mt-6 border-t border-slate-200 dark:border-slate-800">
<?php if ($userRole === 'admin' || $userRole === 'Gestor da Estação'): ?>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-all" href="admin/admin_fontes.php">
<span class="material-symbols-outlined">settings</span>
<span class="font-medium">Painel Admin</span>
</a>
<?php
endif; ?>
</div>
</nav>
<div class="mt-auto glass-card rounded-xl p-4 flex items-center gap-3 border border-slate-200/50 dark:border-slate-800">
<div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="User profile portrait smiling woman" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHO6HMjUf10qh5h5DnH7y421RBIqnfk39URTNmp7fHmts8_Abp7yQ2-JVsvggGvNdCkqkriZpUXerybekuluZwFQXZMNOVhAFq-y7MlaZvNWoLWv_6Uoi0xrcCFFSE5JBp2N8ipNrGhFS_HnA3kM8RaP73QptheSv1SJyZs1iEMNzVzP-BCLMr5tyEUK8phLGBz5IuETcfWXBUtS0cKmlH2XIxQPWyXKzM1F5xPTLlvNm4c8FKIK8OW0cxJe2rAlvg7eus-lRnKZo"/>
</div>
<div class="flex-1 min-w-0">
<p class="text-sm font-semibold truncate"><?php echo $userName; ?></p>
<p class="text-xs text-slate-500 dark:text-slate-400"><?php echo $userRole; ?></p>
</div>
<a href="logout.php" title="Sair" class="flex items-center justify-center hover:bg-slate-800 p-1 rounded-md transition-colors"><span class="material-symbols-outlined text-slate-400 text-sm">logout</span></a>
</div>
</aside>
<!-- Main Content -->
<main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark flex flex-col">
<!-- Header -->
<header class="sticky top-0 z-10 px-8 py-6 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-6 max-w-7xl mx-auto w-full">
<div>
<h2 class="text-3xl font-black tracking-tight dark:text-white">Catálogo de Artistas Locais</h2>
<p class="text-slate-500 dark:text-slate-400 mt-1">Descubra e explore os melhores talentos nacionais.</p>
</div>
<div class="relative w-full md:w-80">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="w-full pl-12 pr-4 py-3 rounded-xl border-none bg-slate-200/50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary/50 text-slate-900 dark:text-slate-100 placeholder:text-slate-500 transition-all" placeholder="Pesquisar artistas..." type="text"/>
</div>
</div>
<!-- Filters -->
<div class="flex gap-3 mt-8 overflow-x-auto pb-2 no-scrollbar max-w-7xl mx-auto w-full">
<button class="px-5 py-2 rounded-full bg-primary text-white font-medium shadow-lg shadow-primary/20 whitespace-nowrap">Todos</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Pop</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Fado</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Rock</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Jazz</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Hip-Hop</button>
<button class="px-5 py-2 rounded-full bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium whitespace-nowrap transition-colors">Electrónica</button>
</div>
</header>
<!-- Artist Grid -->
<section class="p-8 max-w-7xl mx-auto w-full">
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
<!-- Artist 1 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Fado singer portrait aesthetic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2hGQocaqJwJ9IhfnDTGLPqOlnH5m3dhJgHrnK97JN1LlQfSppgWY1mYbmHnrz5ZYsdvyjqpmfxIm_3anCF7114W0AB7gKovyFhtfxjNV0onPrMbVXZrluTPWpmeblq_jQGKSfil0D3D0XxWvvuxU98w3hpqc5nB26qp_4_hMH_y0r1jeHdOuJ7yzusS2mNAw87f9hmGdbx-NOU_5oPRk4R8cvvQ1NAoeT-E6M3HLIXKhMM5aEx-QmHMVE2IJYArnodRXY45GLcco"/>
<div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Ana Moura</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Fado / Soul</p>
</div>
<!-- Artist 2 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Famous female singer performance portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAefBGLMgjHtEERHSe6nuBAIMHO0Glyd0sFA-RBmHUH7rdcGfV2fGpnGPMhqpKwcvXqTAJnKXTwdQmbnbDjyQlZjozxEMyGflwbjIwvBbgElqY0gDzeFT0DfgugdH_DcNWVw9rN-t0qcuE-iXkUf67yZ4kmg6fPqQ5Gi88jLFTW7fQW1_DjVfgOjgi0s08QJl_SQMlfRV6eDjFlRQhGwWhvN45WspA9VXRhq-SVfLOM3fzEjIAHF4Yy1Iqexheez_kabP2GKIoqBI0"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Mariza</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Fado Tradicional</p>
</div>
<!-- Artist 3 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Male hip-hop artist dramatic studio portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNAP-ErUmqiW_3cFeOnLq3Xp4UWttFxcn-ox1Uu5ZJ-FcUjCoWxnBrTAIlfYFZT5Rv-N01lm-Zk3DmCilY4hAnhry79z1gK8o99wx3XPv-hBE9H-9_8SvvvxpAV8x8WUIiaFmoavIZ5aXwGyutzcoE5NaX525N_vMyeWGyDBJ0-kZjgcaKNP_oPvq0Cx4H8vwn_DJKtAtH-aUb5fENdA4WEiH4IlHmnuIqnOewgJtRDV4dOy_d9NvPmG_cQTZV5SL4NWrinT3I9zw"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Slow J</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Hip-Hop / R&amp;B</p>
</div>
<!-- Artist 4 -->
<a href="artista_detalhe.php?id=3" class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Portuguese female singer elegant portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOMy6d2TWjJp2tJEqPvZKgu7AHiXE5Mg1LSVlhMwrA3Aqgc5WWamR-p93wHQECzt-HDqjdDppUTvfF5UnIh_sDyqfG1HxGojRtaSR3_ci0ZyDYY4GoUW9fye8oQ03t_RW4fLt69LugVwdF614WT4h-JC07X2pbmIxaKDmbkqcuQ0_TRawjPDD5xmrjoKZEF4cfuXoRjLOueVPaGhzTAhk62O0nzb3Q7UO3BlcojsS_YggrxADYYEHCah7tCK3fJeUsLgcuJUXcvkI"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Carminho</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Fado</p>
</a>
<!-- Artist 5 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Modern pop artist portrait neon vibes" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxsMaMoqgYWAQgJMV5Ybbuyy_ezyUy_6e4Vtl7SspMTT8-i9aNKkG3s1eMzmuqEacwftHukljNAEX9PgwreqTmBd2-vy11XecgTk-uSdidb6vrnRlz2IMueJ-yGnapCUvUwWR03noh-ZtLYANtFdrfBKC8FUOUdXZFnMnT0-19RuozQpoT4v_OsnCZYLwcdltYZe_1goQYPaVFh-Vad9uSMPTPLjvclyKjPLMwLErhmILyQFUyPEPiHrwQ5WBoyEDH3F5D0IlnlbQ"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Dino D'Santiago</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Pop / Afrobeat</p>
</div>
<!-- Artist 6 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Portuguese fado singer black and white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUBPi7wfY5A9rmiro2FQ5ABP27lBBBjbncmJJA883YUjv9OtC6uZ5Fp0znzxWr4qX647B1E61Q1o4jEhDw6HshD5Qvg7Pcu-gGqBxSoFVfCeMEGTdyWhN-pnCRX6q-dabzzy_kspP1jeCBD-5dAeZoPfR1LelSM4g2TR_qfEonQ-Totfa0sEeFraqaquPv5WosoYakslglEDJHgtSeqeKAN6H_B4uxD6h_Nq640ZAmCtX293qsOTcMEYifiODRJ7y9sMlL2GTBW4A"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Camané</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Fado</p>
</div>
<!-- Artist 7 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Indie rock band member portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJQrIZHPQjyhrGKiLLNGh23g5K06AugkzlmwNqMC4klHnTG2YhFFK7pI5khrnrjLgiFUwdojk_ccFCDHcdByzUlLrMfu2nWJNUfxHClyJIBhXbME6XQoXNLgeXuMHFYODWoCQFdptHv16URtrs-cJcsd_MK7RN2afBdSi9WcPikPVkK2WtyhRfYctpuxc6HMp1SpY_yuBAkvordOO6HtVtikGKlCfzLHMPQJtr76eUzH15gNVKIjwIOpVcV5Si-EvavUbK4tuI1qw"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">The Legendary Tigerman</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Rock / Blues</p>
</div>
<!-- Artist 8 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Hip-hop female artist performance" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDTBIHRnjz7eME1wrawKeKm7DRd8JYHYqXVinqphxnFE5GcDdgOTwlnyYCdC_qqbWgN61O4t0aJIdVPTPO7sBgcrqbnl1dQp_cXnAqjEoaSrFk_Wf1tBkQT5Ha9jck8yXgF5PBbaQGSb5TiNjG7z9eBWUWhiBb9L6g6QCkx62htuLmb7Dnk4dgYQX3VzvwxIntgXqM2Pj6JwtlwfK3Y0CFNGv2FlRi4gV8JUlR--W6JKf7lOn71lP5_8ePEIXXaMS38_DkeSlBwn8"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Capicua</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Hip-Hop</p>
</div>
<!-- Artist 9 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Jazz musician with instrument portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIhz1fic8M-0recwAZx6q2v77e8sr2aLtzuWowkGCFjKEfWfEDrDr8Cok6Cs0N-bEWvBX3DsHHwo9H6Zgi-aznZQMNxD6MiL5klCPB0UyKpcCt2Z2uY06vjYgesfGE8ieWouIfHq-TGGG8xmXlDd-W-3r1IA8ang8r2p2eXTYmUWzIHtBRcb7c3sirOdvo_80erxBStYAphoYbUhgpKROtsO4TQsqJcSKnT3KfkAfGmt24OzWcHW02YAj-JulY5KBotkIhf_H68ps"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Salvador Sobral</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Jazz / Pop</p>
</div>
<!-- Artist 10 -->
<div class="group flex flex-col items-center text-center">
<div class="relative w-full aspect-square mb-4 rounded-full p-1 border-2 border-transparent group-hover:border-primary transition-all duration-300 overflow-hidden cursor-pointer shadow-2xl">
<img class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500" data-alt="Electronic music producer artistic shot" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAT6OXugU066VAlSHOwnVGHLwqoujIYt_1WboBPYwlxjgrG2ZysYbvwfBBmMiydack3gFHNURSOvcIFAr9N4UgiT2Cf5ehOpaQKDeBW-jwA9robWPUfM2tvBWg5i2cnXa6ppcjJUT96KFLJoy4DZvUSl9q2UhKakd-8Xn6pE-crthNix0w0BHgwUgNXXtgp8rY0_3axmp24iSqGM9HwOwQi3duPuBsSqfpXjiF5LvI1nOjcnIp7aYNkgfcOHRbRML8okAJ_F-b_dsA"/>
</div>
<h3 class="text-lg font-bold group-hover:text-primary transition-colors">Branko</h3>
<p class="text-sm text-slate-500 dark:text-slate-400">Electronic / Global</p>
</div>
</div>
</section>
<!-- Player Bar (Mini) -->
<div class="mt-auto bg-white/5 dark:bg-slate-900/80 backdrop-blur-xl border-t border-slate-200 dark:border-slate-800 p-4 px-8 flex items-center justify-between">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-800">
<img class="w-full h-full object-cover" data-alt="Currently playing song album art" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTZJQhk37HOgrMiVqIOQr0g1NpXo3QvVsxfyzhlYf2_oHrinlJwgyWFMGG3-Kx7YBg-R7BybveqB0TC-MQEEKI9RMO12gpOEeBlQAAWnFmsVBZx2lsqYoM5B9ylS6DohZWJTtcG6i4Ol9Gv9dMRhDP8FQYKsvldYEUR267luQfoMQcKM-aYxFYhXNP-pRx8PYIL_wYidT96fIBp5H5bbbCzk9ypO3aKVzhxht2onYZbGfq7ZtRrk47m6phk0KNJ3JsvVTqQQWnF88"/>
</div>
<div>
<p class="text-sm font-bold">Andarilho</p>
<p class="text-xs text-slate-500 dark:text-slate-400">Ana Moura</p>
</div>
<button class="ml-4 text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="flex flex-col items-center flex-1 max-w-md px-10">
<div class="flex items-center gap-6">
<button class="text-slate-400 hover:text-white"><span class="material-symbols-outlined">shuffle</span></button>
<button class="text-slate-400 hover:text-white text-3xl leading-none"><span class="material-symbols-outlined">skip_previous</span></button>
<button class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
<span class="material-symbols-outlined">play_arrow</span>
</button>
<button class="text-slate-400 hover:text-white text-3xl leading-none"><span class="material-symbols-outlined">skip_next</span></button>
<button class="text-slate-400 hover:text-white"><span class="material-symbols-outlined">repeat</span></button>
</div>
<div class="w-full flex items-center gap-3 mt-2">
<span class="text-[10px] text-slate-500">1:24</span>
<div class="flex-1 h-1 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
<div class="w-1/3 h-full bg-primary"></div>
</div>
<span class="text-[10px] text-slate-500">3:45</span>
</div>
</div>
<div class="flex items-center gap-4 w-48 justify-end">
<span class="material-symbols-outlined text-slate-400">volume_up</span>
<div class="w-24 h-1 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
<div class="w-3/4 h-full bg-slate-400"></div>
</div>
<span class="material-symbols-outlined text-slate-400">fullscreen</span>
</div>
</div>
</main>
</div>
</body></html>