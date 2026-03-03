<?php
require_once 'UserManager.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$manager = new UserManager();
$message = '';
$error = '';

// Processar Ações (Aprovar / Remover / Editar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['id'])) {
        try {
            if ($_POST['action'] === 'approve') {
                // Obter dados do utilizador para enviar email
                $userTarget = $manager->getById($_POST['id']);
                
                if ($manager->approve($_POST['id'])) {
                    $message = 'Utilizador aprovado com sucesso!';
                    
                    if ($userTarget && !empty($userTarget['email'])) {
                        $to = $userTarget['email'];
                        $subject = "Bem-vindo ao Sintoniza+ - Conta Aprovada";
                        // URL base dinâmica
                        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                        // Se estiver numa subpasta (ex: /admin/users.php), subir um nível para o login
                        $loginUrl = dirname(dirname($baseUrl . $_SERVER['REQUEST_URI'])) . '/login.php';
                        
                        $email_content = "Olá " . $userTarget['username'] . ",\n\n";
                        $email_content .= "A sua conta no Sintoniza+ foi aprovada pelo Administrador!\n";
                        $email_content .= "Já pode iniciar sessão e aceder ao Painel de Controlo.\n\n";
                        $email_content .= "Login: " . $loginUrl . "\n\n";
                        $email_content .= "Com os melhores cumprimentos,\nA Equipa Sintoniza+";

                        $headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n";
                        $headers .= "Reply-To: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n";
                        $headers .= "X-Mailer: PHP/" . phpversion();

                        // Tentar enviar (sem bloquear se falhar)
                        @mail($to, $subject, $email_content, $headers);
                        $message .= ' (Notificação enviada)';
                    }
                } else {
                    $error = 'Erro ao aprovar utilizador.';
                }
            } elseif ($_POST['action'] === 'delete') {
                if ($manager->delete($_POST['id'])) {
                    $message = 'Utilizador removido/rejeitado com sucesso!';
                } else {
                    $error = 'Erro ao remover utilizador.';
                }
            } elseif ($_POST['action'] === 'update') {
                if ($manager->update(
                    $_POST['id'], 
                    $_POST['username'], 
                    $_POST['email'], 
                    $_POST['radio_name'], 
                    $_POST['radio_role'],
                    !empty($_POST['password']) ? $_POST['password'] : null
                )) {
                    $message = 'Dados do utilizador atualizados com sucesso!';
                } else {
                    $error = 'Erro ao atualizar dados.';
                }
            }
        } catch (Exception $e) {
            $error = 'Erro ao processar pedido: ' . $e->getMessage();
        }
    }
}

// Obter todos os utilizadores
$users = $manager->getAll();
?>
<!DOCTYPE html>
<html class="dark" lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Gestão de Utilizadores</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
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
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
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
        /* Modal transitions */
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex min-h-screen w-full">
    <!-- Sidebar -->
    <nav class="flex w-64 flex-col gap-4 border-r border-slate-200/10 bg-[#111418] p-4">
        <div class="flex gap-3 items-center">
             <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Logo" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBmLiA4N4W7hWDKm5Sw9YyXrH2ds15UnQ_Cuu93dhsJh7SuJckSqJud-PpEpvhGj1qUfNdQGP_EXlMKKt5hP2YIcbTlBNWCwj7gKkno22cfRs3IZoobgUKvIo4dVXmUnaSTWWDJ99SuTZzaxuPmxHhxMsB56sr0qGiCr8kQXr6brR1xtOcbwmMRM2HnswRPlpswz0cCmQqDwYFEGOP5eXPFAL2Sp_Tiv625scfaX4q5-gePWSBNqz74fbH0ElsAEcdVOUdKot0siwI");'></div>
            <div class="flex flex-col">
                <h1 class="text-white text-base font-medium leading-normal">Sintoniza+</h1>
                <p class="text-slate-400 text-sm font-normal leading-normal">Painel de Controlo</p>
            </div>
        </div>
        <div class="flex flex-col gap-1 mt-4">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors" href="#">
                <span class="material-symbols-outlined text-slate-300">dashboard</span>
                <p class="text-slate-300 text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors" href="admin_fontes.php">
                <span class="material-symbols-outlined text-slate-300">link</span>
                <p class="text-slate-300 text-sm font-medium leading-normal">Fontes de Conteúdo</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20" href="users.php">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1, 'wght' 500;">group</span>
                <p class="text-primary text-sm font-medium leading-normal">Utilizadores</p>
            </a>
        </div>
    </nav>

    <main class="flex-1 p-8">
        <div class="w-full max-w-7xl mx-auto">
            
            <!-- Feedback Messages -->
            <?php if ($message): ?>
            <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sucesso!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($message); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($error): ?>
            <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erro!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
            <?php endif; ?>

            <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
                <div class="flex flex-col gap-2">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Gestão de Utilizadores</h1>
                    <p class="text-slate-400 text-base font-normal leading-normal">Aprove ou remova registos de utilizadores da plataforma.</p>
                </div>
            </div>

            <div class="bg-[#111418] border border-slate-200/10 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-500/10">
                            <tr>
                                <th class="p-4 font-semibold">Utilizador</th>
                                <th class="p-4 font-semibold">Rádio / Projeto</th>
                                <th class="p-4 font-semibold">Fonte</th>
                                <th class="p-4 font-semibold">Estado</th>
                                <th class="p-4 font-semibold text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0): ?>
                                <?php foreach ($users as $user): ?>
                                <tr class="border-t border-slate-200/10 <?php echo $user['approved'] ? '' : 'bg-primary/5'; ?>">
                                    <td class="p-6 font-medium text-white align-middle">
                                        <div class="flex flex-col">
                                            <span class="text-base"><?php echo htmlspecialchars($user['username']); ?></span>
                                            <span class="text-xs text-slate-400"><?php echo htmlspecialchars($user['email']); ?></span>
                                        </div>
                                    </td>
                                    <td class="p-6 align-middle">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium"><?php echo htmlspecialchars($user['radio_name'] ?? '-'); ?></span>
                                            <span class="text-xs text-slate-400"><?php echo htmlspecialchars($user['radio_role'] ?? '-'); ?></span>
                                        </div>
                                    </td>
                                    <td class="p-6 align-middle text-slate-400">
                                        <?php echo htmlspecialchars($user['referral_source'] ?? '-'); ?>
                                    </td>
                                    <td class="p-6 align-middle">
                                        <?php if ($user['approved']): ?>
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-500/10 text-green-400 border border-green-500/20">
                                                Aprovado
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">
                                                Pendente
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-6 align-middle">
                                        <div class="flex justify-end items-center gap-2">
                                            <!-- EDIT BUTTON -->
                                            <button onclick='openEditModal(<?php echo json_encode($user); ?>)' aria-label="Editar" class="flex items-center justify-center size-9 rounded-lg hover:bg-white/10 transition-colors text-slate-400 hover:text-white">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>

                                            <?php if (!$user['approved']): ?>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="action" value="approve">
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" title="Aprovar Conta" class="flex items-center justify-center size-9 rounded-lg bg-green-600 hover:bg-green-500 transition-colors text-white">
                                                    <span class="material-symbols-outlined text-lg">check</span>
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                            
                                            <form method="POST" onsubmit="return confirm('ATENÇÃO: Vai remover este utilizador permanentemente. Confirmar?');" style="display:inline;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" title="Remover/Rejeitar" class="flex items-center justify-center size-9 rounded-lg bg-slate-800 hover:bg-red-900/50 transition-colors text-slate-400 hover:text-red-400 border border-slate-700">
                                                    <span class="material-symbols-outlined text-lg">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php if (!$user['approved'] && !empty($user['interest_reason'])): ?>
                                <tr class="bg-primary/5 border-b border-primary/10">
                                    <td colspan="5" class="px-6 pb-4 pt-0 text-sm text-slate-400">
                                        <div class="flex gap-2 items-start">
                                            <span class="material-symbols-outlined text-sm pt-1 opacity-50">info</span>
                                            <div>
                                                <strong class="text-primary/70 text-xs uppercase tracking-wide">Motivo de Interesse:</strong>
                                                <p class="mt-1 italic">"<?php echo htmlspecialchars($user['interest_reason']); ?>"</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-500">
                                            <span class="material-symbols-outlined text-4xl mb-2 opacity-50">search_off</span>
                                            <p>Nenhum utilizador registado ainda.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal de Edição -->
<div id="editModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-black opacity-50"></div>
    
    <div class="modal-container bg-[#111418] w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto border border-slate-200/10">
        
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3 border-b border-slate-200/10">
                <p class="text-2xl font-bold text-white">Editar Utilizador</p>
                <div class="modal-close cursor-pointer z-50" onclick="closeModal()">
                    <span class="material-symbols-outlined text-slate-300">close</span>
                </div>
            </div>

            <!--Body & Form-->
            <form id="editForm" method="POST" class="mt-4">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="edit_id" value="">

                <div class="mb-4">
                    <label class="block text-slate-300 text-sm font-bold mb-2" for="edit_username">Nome</label>
                    <input class="shadow appearance-none border border-slate-600 rounded w-full py-2 px-3 text-white bg-slate-800 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" id="edit_username" name="username" type="text" required>
                </div>

                <div class="mb-4">
                    <label class="block text-slate-300 text-sm font-bold mb-2" for="edit_email">Email</label>
                    <input class="shadow appearance-none border border-slate-600 rounded w-full py-2 px-3 text-white bg-slate-800 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" id="edit_email" name="email" type="email" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-slate-300 text-sm font-bold mb-2" for="edit_radio_name">Rádio / Projeto</label>
                    <input class="shadow appearance-none border border-slate-600 rounded w-full py-2 px-3 text-white bg-slate-800 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" id="edit_radio_name" name="radio_name" type="text">
                </div>

                <div class="mb-6">
                    <label class="block text-slate-300 text-sm font-bold mb-2" for="edit_radio_role">Cargo / Função</label>
                    <input class="shadow appearance-none border border-slate-600 rounded w-full py-2 px-3 text-white bg-slate-800 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" id="edit_radio_role" name="radio_role" type="text">
                </div>

                <div class="mb-6 pt-4 border-t border-slate-700">
                    <label class="block text-slate-300 text-sm font-bold mb-2" for="edit_password">Nova Palavra-passe <span class="text-xs font-normal text-slate-500">(Opcional)</span></label>
                    <input class="shadow appearance-none border border-slate-600 rounded w-full py-2 px-3 text-white bg-slate-800 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" id="edit_password" name="password" type="password" placeholder="Deixe em branco para manter a atual">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 p-3 rounded-lg text-slate-400 bg-transparent hover:bg-white/5 mr-2">Cancelar</button>
                    <button type="submit" class="px-4 py-2 p-3 rounded-lg bg-primary hover:bg-primary/90 text-white font-bold">Guardar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('editModal');
    const body = document.querySelector('body');

    function openEditModal(userData) {
        // Preencher o formulário
        document.getElementById('edit_id').value = userData.id;
        document.getElementById('edit_username').value = userData.username;
        document.getElementById('edit_email').value = userData.email;
        document.getElementById('edit_radio_name').value = userData.radio_name || '';
        document.getElementById('edit_radio_role').value = userData.radio_role || '';
        document.getElementById('edit_password').value = ''; // Limpar campo da password

        // Mostrar Modal
        modal.classList.remove('opacity-0');
        modal.classList.remove('pointer-events-none');
        body.classList.add('modal-active');
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modal.classList.add('pointer-events-none');
        body.classList.remove('modal-active');
    }

    // NOVO MÉTODO: Atacar o problema pela raiz.
    // Em vez de complicar com "propagação", vamos ser diretos.
    // Só fecha se clicar explicitamente na camada escura (overlay).
    document.querySelector('.modal-overlay').addEventListener('click', function() {
        closeModal();
    });

    // Remover qualquer outro listener de fechar automático para evitar conflitos.
    // O botão "X" já tem o seu próprio onclick="closeModal()", por isso continua a funcionar.
</script>
</body>
</html>
