<!DOCTYPE html>
<html class="dark" lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login/Registro Radialista - Sintoniza+ (v3.1)</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
    /* Force simple pointer for the toggle */
    .toggle-password {
        cursor: pointer !important;
        z-index: 50 !important;
        position: relative !important;
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#137fec",
              "background-light": "#f6f7f8",
              "background-dark": "#101922",
            },
            fontFamily: {
              "display": ["Spline Sans", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }

      // Função Global para o "Olhinho"
      // Função Global para o "Olhinho" (Versão Robusta ID)
      function togglePassword(inputId, triggerElement) {
          const input = document.getElementById(inputId);
          // Procura o ícone dentro do elemento clicado
          const icon = triggerElement.querySelector('.material-symbols-outlined');
          
          if (!input) {
              console.error('Input não encontrado: ' + inputId);
              return;
          }

          if (input.type === 'password') {
              input.type = 'text';
              icon.textContent = 'visibility_off';
          } else {
              input.type = 'password';
              icon.textContent = 'visibility';
          }
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        font-size: 20px;
      }
    </style>
</head>
<?php session_start(); ?>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 overflow-x-hidden">
<div class="layout-container flex h-full w-full max-w-md grow flex-col items-center justify-center">
<div class="flex flex-col items-center pb-8">
<!-- Logo here if needed -->
<h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Sintoniza+</h1>
</div>
<div class="w-full rounded-xl bg-white/50 dark:bg-gray-800/20 p-2 shadow-lg backdrop-blur-lg">
<div class="w-full flex flex-col items-stretch">
    
    <!-- Messages -->
    <?php if(isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-4" role="alert">
      <span class="block sm:inline"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
    </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mx-4" role="alert">
      <span class="block sm:inline"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
    </div>
    <?php endif; ?>

    <div class="flex px-4 py-3">
        <div class="flex h-10 flex-1 items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-900/50 p-1">
            <label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-lg px-2 has-[:checked]:bg-primary has-[:checked]:shadow-md has-[:checked]:text-white text-gray-500 dark:text-gray-400 has-[:checked]:dark:text-white text-sm font-medium leading-normal transition-all duration-200">
                <span class="truncate">Entrar</span>
                <input checked="" class="invisible w-0" name="auth-toggle" type="radio" value="Entrar" onchange="toggleForm('login')"/>
            </label>
            <label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-lg px-2 has-[:checked]:bg-primary has-[:checked]:shadow-md has-[:checked]:text-white text-gray-500 dark:text-gray-400 has-[:checked]:dark:text-white text-sm font-medium leading-normal transition-all duration-200">
                <span class="truncate">Registrar</span>
                <input class="invisible w-0" name="auth-toggle" type="radio" value="Registrar" onchange="toggleForm('register')"/>
            </label>
        </div>
    </div>

    <!-- Login Form -->
    <form id="login-form" action="login_process.php" method="POST" class="block">
        <h1 class="text-gray-900 dark:text-white tracking-tight text-[32px] font-bold leading-tight px-4 text-center pb-3 pt-6">Bem-vindo de volta.</h1>
        <p class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal pb-3 pt-1 px-4 text-center">Entre na sua conta para continuar.</p>
        
        <div class="flex flex-col gap-4 p-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Email</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input name="email" autocomplete="off" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Digite seu email" value="" required/>
                </div>
            </label>
            <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Senha</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input id="pass-login" name="password" autocomplete="new-password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 rounded-r-none border-r-0 pr-2 text-base font-normal leading-normal transition-colors" placeholder="Digite sua senha" type="password" value="" required/>
                    <div onclick="togglePassword('pass-login', this)" class="text-gray-400 dark:text-gray-500 flex border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark items-center justify-center px-3 rounded-r-lg border-l-0 cursor-pointer toggle-password">
                        <span class="material-symbols-outlined select-none pointer-events-none">visibility</span>
                    </div>
                </div>
            </label>
            <div class="flex justify-between items-center pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input class="form-checkbox h-4 w-4 rounded text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-background-dark" type="checkbox"/>
                    <span class="text-sm text-gray-600 dark:text-gray-300">Manter-me conectado</span>
                </label>
                <a class="text-sm font-medium text-primary hover:underline" href="#">Esqueci a senha?</a>
            </div>
        </div>
        <div class="p-4 pt-2">
            <button class="flex items-center justify-center w-full bg-primary text-white font-bold h-12 px-6 rounded-lg text-base leading-normal transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark">Entrar</button>
        </div>
    </form>

    <!-- Register Form -->
    <form id="register-form" action="register_process.php" method="POST" class="hidden">
        <h1 class="text-gray-900 dark:text-white tracking-tight text-[32px] font-bold leading-tight px-4 text-center pb-3 pt-6">Criar Conta</h1>
        <p class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal pb-3 pt-1 px-4 text-center">Preencha os dados para se registar.</p>
        
        <div class="flex flex-col gap-4 p-4">
             <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Nome</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input name="username" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Seu Nome" value="" required/>
                </div>
            </label>
            <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Email</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input name="email" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Digite seu email" value="" required/>
                </div>
            </label>
            <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Senha</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input id="pass-register" name="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 rounded-r-none border-r-0 pr-2 text-base font-normal leading-normal transition-colors" placeholder="Crie uma senha" type="password" value="" required/>
                    <div onclick="togglePassword('pass-register', this)" class="text-gray-400 dark:text-gray-500 flex border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark items-center justify-center px-3 rounded-r-lg border-l-0 cursor-pointer toggle-password">
                        <span class="material-symbols-outlined select-none pointer-events-none">visibility</span>
                    </div>
                </div>
            </label>

            <!-- Questionnaire Fields -->
             <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Nome da Rádio / Projeto</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input name="radio_name" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Ex: Rádio Local" value="" required/>
                </div>
            </label>
             <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Função / Cargo</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input name="radio_role" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Ex: Locutor, Diretor" value="" required/>
                </div>
            </label>
             <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Qual o interesse na plataforma?</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <textarea name="interest_reason" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-24 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal transition-colors" placeholder="Descreva brevemente..." required></textarea>
                </div>
            </label>
             <label class="flex flex-col w-full">
                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Como conheceu o Sintoniza+?</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <select name="referral_source" class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-white dark:bg-background-dark h-12 p-3 text-base font-normal leading-normal transition-colors">
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Google">Google</option>
                        <option value="Amigo/Colega">Amigo / Colega</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
            </label>
        </div>
        <div class="p-4 pt-2">
            <button class="flex items-center justify-center w-full bg-primary text-white font-bold h-12 px-6 rounded-lg text-base leading-normal transition-all hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark">Registrar</button>
        </div>
    </form>

</div>
</div>
</div>
</div>
<script>
    function toggleForm(mode) {
        if (mode === 'login') {
            document.getElementById('login-form').classList.remove('hidden');
            document.getElementById('login-form').classList.add('block');
            document.getElementById('register-form').classList.remove('block');
            document.getElementById('register-form').classList.add('hidden');
        } else {
            document.getElementById('login-form').classList.remove('block');
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('register-form').classList.remove('hidden');
            document.getElementById('register-form').classList.add('block');
        }
    }
</script>
</body></html>
