<?php
session_start();

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
                        "background-dark": "#101722",
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
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .spotify-gradient {
            background: linear-gradient(135deg, #1DB954 0%, #191414 100%);
        }
        .youtube-gradient {
            background: linear-gradient(135deg, #FF0000 0%, #282828 100%);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<div class="flex min-h-screen overflow-hidden">
<!-- SideNavBar -->
<aside class="w-64 border-r border-primary/10 bg-background-dark flex flex-col justify-between p-6 shrink-0">
<div class="flex flex-col gap-8">
<div class="flex items-center gap-3">
<div class="rounded-full size-10 bg-primary/20 flex items-center justify-center border border-primary/30">
<span class="material-symbols-outlined text-primary">radio</span>
</div>
<div class="flex flex-col">
<h1 class="text-slate-100 text-lg font-bold leading-tight">Sintoniza+</h1>
<p class="text-primary text-xs font-medium uppercase tracking-widest">Vibe Local</p>
</div>
</div>
<nav class="flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 text-slate-400 hover:text-primary transition-all group" href="dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 text-slate-400 hover:text-primary transition-all group" href="noticias.php">
<span class="material-symbols-outlined">newspaper</span>
<span class="text-sm font-medium">Notícias</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 text-slate-400 hover:text-primary transition-all group" href="eventos.php">
<span class="material-symbols-outlined">event</span>
<span class="text-sm font-medium">Eventos</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white transition-all shadow-lg shadow-primary/20" href="artistas.php">
<span class="material-symbols-outlined font-fill">mic_external_on</span>
<span class="text-sm font-medium">Artistas</span>
</a>
<?php if ($userRole === 'admin' || $userRole === 'Gestor da Estação'): ?>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary/10 text-slate-400 hover:text-primary transition-all group" href="admin/admin_fontes.php">
<span class="material-symbols-outlined">settings</span>
<span class="text-sm font-medium">Painel Admin</span>
</a>
<?php
endif; ?>
</nav>
</div>
<div class="flex flex-col gap-4">
<div class="p-4 rounded-xl bg-gradient-to-br from-primary/20 to-transparent border border-primary/10">
<p class="text-xs text-slate-400 mb-2">Utilizador Atual</p>
<p class="text-sm font-bold text-white mb-3 truncate"><?php echo $userName; ?></p>
<a href="logout.php" class="block text-center w-full py-2 bg-primary hover:bg-primary/80 text-white text-xs font-bold rounded-lg transition-colors">
                        SAIR (LOGOUT)
                    </a>
</div>
</div>
</aside>
<!-- Main Content -->
<main class="flex-1 overflow-y-auto relative bg-background-dark">
<!-- Hero Header -->
<header class="relative h-[450px] w-full group">
<div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Close up professional studio photo of a local music artist" style="background-image: linear-gradient(to bottom, rgba(16, 23, 34, 0.2) 0%, rgba(16, 23, 34, 1) 100%), url('https://lh3.googleusercontent.com/aida-public/AB6AXuBFjkIEmJLUuqJFkexny2nZT5M0-hiGWc6ikov2yy-5kQ-x07aBuxNcIvyYmj0BG8GUDAmRBDV4l3gYlkKuqqcPRd0IRbi3hiMLXS_idk0VR_vmLjkWQAE9zFGiwNesvL5z6BW_L9Cm1UqtthAmjTPITZA3dzmYdfgvi3QVVpa22TP-C_dcMrTftzBMUlVRwcEuCdzqBhVN3HsCPX0ZRSxdD-y3XXELTPzlHjjbqCVMTRNuQQt10INwOy91zNvCJzYSiBON4nWm5a8');">
</div>
<div class="absolute bottom-0 left-0 p-12 w-full flex flex-col gap-4">
<div class="flex items-center gap-2">
<span class="bg-primary px-3 py-1 rounded-full text-[10px] font-bold text-white tracking-widest uppercase">Artista Verificado</span>
</div>
<h1 class="text-6xl font-black text-white tracking-tight">Nome do Artista</h1>
<div class="flex items-center gap-6">
<p class="text-slate-300 flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-sm">location_on</span>
                            Lisboa, Portugal
                        </p>
<p class="text-slate-300 flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-sm">group</span>
                            12.4k Ouvintes Mensais
                        </p>
</div>
</div>
</header>
<div class="p-12 max-w-6xl mx-auto flex flex-col gap-16">
<!-- Action Buttons -->
<section class="flex flex-wrap gap-4">
<button class="flex items-center gap-3 px-8 py-4 rounded-xl spotify-gradient text-white font-bold hover:scale-105 transition-transform shadow-xl shadow-green-500/10">
<span class="material-symbols-outlined">play_circle</span>
                        Ouvir no Spotify
                    </button>
<button class="flex items-center gap-3 px-8 py-4 rounded-xl youtube-gradient text-white font-bold hover:scale-105 transition-transform shadow-xl shadow-red-500/10">
<span class="material-symbols-outlined">video_library</span>
                        Ver no YouTube
                    </button>
<button class="flex items-center gap-3 px-8 py-4 rounded-xl glass-effect text-slate-200 font-bold hover:bg-white/10 transition-colors">
<span class="material-symbols-outlined">link</span>
                        Outros Links
                    </button>
</section>
<!-- Apresentação Section -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-12">
<div class="lg:col-span-2 space-y-6">
<h2 class="text-2xl font-bold text-white flex items-center gap-3">
<span class="w-8 h-[2px] bg-primary"></span>
                            Apresentação
                        </h2>
<div class="text-slate-400 leading-relaxed space-y-4 text-lg font-light">
<p>
                                Com raízes profundas na cena underground de Lisboa, <strong class="text-white font-medium">Nome do Artista</strong> tem redefinido os contornos da música contemporânea portuguesa nos últimos cinco anos. A sua sonoridade é uma fusão audaciosa entre as batidas eletrónicas modernas e a melancolia tradicional do fado, criando uma atmosfera que é ao mesmo tempo futurista e visceralmente local.
                            </p>
<p>
                                Influenciado por nomes como James Blake e Amália Rodrigues, o seu trabalho explora temas de isolamento urbano, identidade e a constante evolução da cultura lusófona. Desde o seu primeiro EP, tem recebido elogios da crítica especializada pela sua capacidade de transitar entre texturas sintéticas e composições acústicas orgânicas.
                            </p>
<p>
                                Vencedor do prémio "Revelação do Ano" em 2023, o artista continua a sua jornada de experimentação sonora, preparando o seu próximo álbum de estúdio que promete ser uma viagem sensorial pelos recantos escondidos da capital.
                            </p>
</div>
</div>
<!-- Sidebar Stats/Details -->
<div class="flex flex-col gap-6">
<div class="p-6 rounded-2xl glass-effect space-y-6">
<h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Detalhes Adicionais</h3>
<div class="space-y-4">
<div class="flex justify-between border-b border-primary/5 pb-2">
<span class="text-slate-400 text-sm">Género</span>
<span class="text-white text-sm font-medium">Alternative / Electro</span>
</div>
<div class="flex justify-between border-b border-primary/5 pb-2">
<span class="text-slate-400 text-sm">Início</span>
<span class="text-white text-sm font-medium">2018</span>
</div>
<div class="flex justify-between border-b border-primary/5 pb-2">
<span class="text-slate-400 text-sm">Editora</span>
<span class="text-white text-sm font-medium">Independente</span>
</div>
<div class="flex justify-between">
<span class="text-slate-400 text-sm">Instrumentos</span>
<span class="text-white text-sm font-medium">Sintetizadores, Guitarra</span>
</div>
</div>
</div>
<!-- Mini Gallery Preview -->
<div class="grid grid-cols-2 gap-2">
<div class="h-32 rounded-lg bg-cover bg-center" data-alt="Artist performing live with dramatic blue lighting" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC7SAbuP4HGzVIZDA2zY3F87pGqm7hhErV60XtDZyslcxQuGxyQvf-7svT-ZlM4Mmi3DR5e67F6gTSuOV0HNEW4qEA_l5XWHs_VRMAom7WjBgRj-FOiyXGkg9ID5XHiLpJI5ZXWXNsIq_Ve2WcqAX49y12M5P2c5JLjybdRzz09dtK8TY-NeDD9smYaZhMRc3WiSyhFuumfZm_Lpzxb-LV2H2udt_psk6bGBMtsbPubW-TF2b3fcHnLshadyQhc5PLVIza2rhC9lg8')"></div>
<div class="h-32 rounded-lg bg-cover bg-center" data-alt="Blurry creative shot of musical instruments on stage" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaKM1gbkx3S6QIDyfQbdS1nw7VJCS3WQgQ7knVuMneus0J_WrcByAYyth_NdqgXx-EsUw9mQhtJ3EKzMPlyNU9g-YGvYNWYaC7PNe30w4DMSnqh4B9YkskwubtMR285Il_-f6wAr4ecCtaxB7hlVWU3rdzyugyslM6hjV-y5btbJv9f45OffM9Tou-I3EsZ5rI7pt1gkA8EJgHWcVuFJtQH7XdCoAJoicWlDOH-HO4JElYGmxMmmuej3PoAlbTIAxbotjg0hK4MyQ')"></div>
</div>
</div>
</section>
<!-- Discography Preview -->
<section class="space-y-8">
<div class="flex justify-between items-end">
<h2 class="text-2xl font-bold text-white">Últimos Lançamentos</h2>
<a class="text-primary text-sm font-bold hover:underline" href="#">Ver discografia completa</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
<div class="flex flex-col gap-3 group cursor-pointer">
<div class="aspect-square rounded-xl overflow-hidden glass-effect relative">
<img alt="Album Cover" class="w-full h-full object-cover transition-transform group-hover:scale-110" data-alt="Abstract colorful album cover art" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBY846YDdc-y2HvxXNhTsnflUd7GDc3FMznBL_QHZ4CNtNEj8Rrztqq9c9u3DLXVG1ycR_C7_mB9x8Ak5PG9ENlkmpbWm5uOFo7XRNBYnptdBLDHADOuWGPVEachuJnANYMS3xXIfoUTulKBtFkvqrL2NAKzllfQ4lIRawbLfSKBx6O2ga868YC3v0XocqgQeezxT4-cKYjgszWSrl0BLqdM3EnLRhvxzUQuD2heRU48b6RIZYBUhUBw4UOT5VijE0D4kQeXnUoGsQ"/>
<div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
<span class="material-symbols-outlined text-white text-4xl">play_circle</span>
</div>
</div>
<p class="text-white font-bold text-sm truncate">Luz de Neon</p>
<p class="text-slate-500 text-xs">Álbum • 2023</p>
</div>
<div class="flex flex-col gap-3 group cursor-pointer">
<div class="aspect-square rounded-xl overflow-hidden glass-effect relative">
<img alt="Album Cover" class="w-full h-full object-cover transition-transform group-hover:scale-110" data-alt="Minimalist monochrome album cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6_zvssW3-XMwnKQBAjB0d5olDfkffgcwrmzFBFPw7oR4RuSJTnCbOEBN1FkdmztyLXuQikEuX5r1VtRrtZY5NDU59Y25h7Ri3SbMexmThfLd6Gi4XELx-PtZ_BY27oSu0VJL6cI7_bTGLFGNsAPGYpouiUy-5LPf_fzfkfkSYNu8Jd6eFUugDkZFHOxCRdaxRYJjSIZqFuGNSrb6RvFFJ0B3D7bJdaVczGKMl4mKEfx9blWDHOt6fsAoEUzcGibg_BYb5fzFixhY"/>
<div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
<span class="material-symbols-outlined text-white text-4xl">play_circle</span>
</div>
</div>
<p class="text-white font-bold text-sm truncate">Eco das Ruas</p>
<p class="text-slate-500 text-xs">Single • 2023</p>
</div>
<div class="flex flex-col gap-3 group cursor-pointer">
<div class="aspect-square rounded-xl overflow-hidden glass-effect relative">
<img alt="Album Cover" class="w-full h-full object-cover transition-transform group-hover:scale-110" data-alt="Atmospheric landscape album cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPPpZzBXERgWL7aOprS_JZJQCZnpDwN2xrdl3XEau2w3TAcoHF4nfwVSpfWr3nknnRlawuOoHUxZjbtDMgIFnmqY8Feb0UNJNbP9H1nXsSFl54Qw8hLDsFspc7RSFBiyaw-XxzD8EZIj_fZa6C5xNKBU4qsVdds6zcri7nYlWU7XYjHOFEMKXAtCPyiYhrwmBqeO98MiFMEfcsxmal7nt7Cvj477Y1orF31cey0kJ7olzKSN5NX6emYnaG-5zjHRof6PcU47iCO6c"/>
<div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
<span class="material-symbols-outlined text-white text-4xl">play_circle</span>
</div>
</div>
<p class="text-white font-bold text-sm truncate">Fado Sintético</p>
<p class="text-slate-500 text-xs">EP • 2022</p>
</div>
</div>
</section>
</div>
<!-- Floating Player Placeholder -->
<div class="sticky bottom-4 mx-4 mb-4 p-4 rounded-2xl glass-effect border border-primary/20 flex items-center justify-between shadow-2xl z-50">
<div class="flex items-center gap-4">
<div class="size-12 rounded-lg bg-cover bg-center" data-alt="Small album cover thumbnail" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBzcIQLpdfZmzcj-mLNu5_BnCrIKx5Ri6CtfIPg-DDeVNfmr1gizr2VG0s4reHpxfuFItR69N2ry6uK1aMFS2jCOG122jR5rgpl4s9M_nyjeQX6diiT9fk1pE7fjaC5e9q4GQNysQS9D9AsHNR7ptNJBYLtUwHeuKp8hkUZSk7HetLZvOWC4nBzSbCO7-tqAvOsNzij2btz3TBVnOaIRPm9LmORxVT3o9Y1-ULVWFJvzwUPh8W2Pv41UEmpjlR8rMNLwC2dETS1N2k')"></div>
<div>
<p class="text-white text-sm font-bold">Luz de Neon</p>
<p class="text-slate-400 text-xs">Nome do Artista</p>
</div>
</div>
<div class="flex items-center gap-6">
<span class="material-symbols-outlined text-slate-400 hover:text-white cursor-pointer">shuffle</span>
<span class="material-symbols-outlined text-slate-400 hover:text-white cursor-pointer">skip_previous</span>
<div class="size-10 rounded-full bg-white flex items-center justify-center cursor-pointer hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-background-dark">play_arrow</span>
</div>
<span class="material-symbols-outlined text-slate-400 hover:text-white cursor-pointer">skip_next</span>
<span class="material-symbols-outlined text-slate-400 hover:text-white cursor-pointer">repeat</span>
</div>
<div class="flex items-center gap-4 w-48">
<span class="material-symbols-outlined text-slate-400 text-sm">volume_up</span>
<div class="h-1 flex-1 bg-white/10 rounded-full overflow-hidden">
<div class="h-full bg-primary w-2/3"></div>
</div>
</div>
</div>
</main>
</div>
</body></html>