<!DOCTYPE html>
<html class="dark" lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Artistas Locais - Catálogo</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300..700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#f9f506",
            "background-light": "#f8f8f5",
            "background-dark": "#23220f",
          },
          fontFamily: {
            "display": ["Spline Sans", "sans-serif"]
          },
          borderRadius: {
            "DEFAULT": "1rem",
            "lg": "2rem",
            "xl": "3rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
<style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="flex h-full grow flex-row">
<!-- SideNavBar -->
<aside class="flex-shrink-0 w-64 p-4 border-r border-gray-200 dark:border-gray-700/50">
<div class="flex flex-col h-full">
<div class="flex flex-col gap-4">
<div class="flex gap-3 items-center px-3 py-2">
<img src="Logos/logo_v2.png" alt="Sintoniza+ Logo" class="h-16 w-auto">
<div class="flex flex-col">
<!-- Removed Title -->
</div>
</div>
<div class="px-2 mt-4 mb-2">
<a class="flex items-center justify-center gap-2 px-4 py-3 rounded-full bg-primary text-black font-bold hover:brightness-95 transition-all shadow-sm w-full" href="dashboard.php">
<span class="material-symbols-outlined">arrow_back</span>
<p>Voltar</p>
</a>
</div>
<nav class="flex flex-1 flex-col gap-2">
<a class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-secondary hover:text-white text-gray-600 dark:text-gray-300 dark:hover:bg-secondary dark:hover:text-white" href="noticias.php">
<span class="material-symbols-outlined">article</span>
<p class="font-medium">Notícias</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-secondary hover:text-white text-gray-600 dark:text-gray-300 dark:hover:bg-secondary dark:hover:text-white" href="eventos.php">
<span class="material-symbols-outlined">event</span>
<p class="font-medium">Eventos</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-full bg-primary/20 dark:bg-primary/30 text-gray-900 dark:text-white" href="meteorologia.php">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">cloudy</span>
<p class="font-medium">Meteorologia</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-secondary hover:text-white text-gray-600 dark:text-gray-300 dark:hover:bg-secondary dark:hover:text-white" href="artistas.php">
<span class="material-symbols-outlined">mic_external_on</span>
<p class="font-medium">Artistas Locais</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-secondary hover:text-white text-gray-600 dark:text-gray-300 dark:hover:bg-secondary dark:hover:text-white" href="novidades.php">
<span class="material-symbols-outlined">music_note</span>
<p class="font-medium">Novidades Musicais</p>
</a>
</nav>
<div class="my-4 border-t border-gray-200 dark:border-gray-700"></div>
<a class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-secondary hover:text-white text-gray-600 dark:text-gray-300 dark:hover:bg-secondary dark:hover:text-white transition-colors" href="logout.php">
    <span class="material-symbols-outlined">logout</span>
    <p class="font-medium">Sair</p>
</a>
</div>
</div>
</aside>
<!-- Main Content -->
<main class="flex-1 p-8">
<div class="layout-content-container flex flex-col max-w-7xl mx-auto">
<!-- PageHeading -->
<div class="flex flex-wrap justify-between gap-3 mb-4">
<h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-tight">Meteorologia</h1>
</div>
<p class="text-gray-500 dark:text-gray-400">Previsão e informações meteorológicas.</p>
</div>
<!-- ImageGrid as Artist Cards - Removed for Meteo -->
<div class="grid grid-cols-1 gap-6">
  <!-- Meteo content placeholder -->
</div>
</div>
</main>
</div>
</div>
</body></html>
