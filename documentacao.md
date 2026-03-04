# Documentação do Projeto Sintoniza+

Este ficheiro serve como registo histórico do desenvolvimento e guia de manutenção do sistema.

## Histórico de Alterações

### 2026-03-04 - Fixes de Layout, Segurança e Deploy
- **Objetivo**: Corrigir layout de Fontes, injetar utilizador Super Admin, e afinar o workflow do GitHub Actions.
- **Alterações e Ajustes Concluídos**:
    - **Layout**: O logo da Área de Administração foi corrigido (apontando agora para `../assets/img/logo.png`); a tabela da página `admin_fontes.php` foi reparada (problemas de alinhamento em URLs compridos); e ativámos a Pop-up de Inserção Ligada ao botão "Adicionar Nova Fonte".
    - **Segurança**: Foi utilizado o ficheiro `admin/cria_admin.php` para injetar a conta super administradora pretendida, sendo o mesmo eliminado logo após a inserção (para fechar a falha de segurança).
    - **Cache Litespeed**: Foram embutidos scripts no topo do `admin_fontes.php` para que os browsers evitem puxar a página da memória cache.
- **Pendentes/Bugs Conhecidos**:
    - **GitHub Actions (FTP)**: Apesar do Github Actions reportar estado verde "Success", o robot do `SamKirkland/FTP-Deploy-Action` está a ser bloqueado nas sombras pelo servidor cPanel da PT Servidor, o que faz os ficheiros PHP no servidor manterem as datas antigas ignorando as constantes atualizações que estão perfeitamente sincronizadas aqui no projeto Git.

### 2025-12-12 - Debugging de Email e Sistema de Logs
- **Objetivo**: Resolver falha no envio de emails de registo e melhorar diagnóstico de erros.
- **Alterações**:
    - Criação de `logs/sistema_erros.log` para registo centralizado de erros.
    - Criação de `admin/config_logs.php` para funções de log.
    - Atualização de `register_process.php` para remover silenciamento (`@`) do `mail()` e adicionar logs.
    - Criação de `test_email.php` para diagnóstico de envio de email.

## Estrutura de Logs
O sistema utiliza um ficheiro de log localizado em `logs/sistema_erros.log`.
A função `logErro($mensagem)` em `admin/config_logs.php` deve ser usada para registar exceções e erros críticos.

## Guia de Resolução de Problemas (Troubleshooting)
### Envio de Emails
Se o sistema não estiver a enviar emails:
1. Verificar `logs/sistema_erros.log` para erros específicos.
2. Executar `test_email.php` para validar se o servidor consegue enviar emails.
3. Se estiver em **Localhost** (XAMPP/WAMP), a função `mail()` do PHP normalmente não funciona sem configurar um servidor SMTP no `php.ini` ou usar uma biblioteca como PHPMailer.
