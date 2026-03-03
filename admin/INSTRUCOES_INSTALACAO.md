# Guia de Instalação - Módulo de Fontes Sintoniza+

Este módulo permite gerir as fontes de conteúdo através de um painel de administração simples. Segue os passos abaixo para instalar no teu alojamento cPanel.

## 1. Base de Dados (via phpMyAdmin)

1.  Acede ao **cPanel** e abre a ferramenta **phpMyAdmin**.
2.  Seleciona a base de dados do teu projeto na barra lateral esquerda.
3.  Clica na aba **Importar** (no topo).
4.  Clica em "Escolher ficheiro" e seleciona o ficheiro `schema.sql` fornecido.
5.  Clica em **Executar** no fundo da página.
    *   *Isto irá criar a tabela `fontes_conteudo`.*

## 2. Configuração (PHP)

1.  Abre o ficheiro `config.php` num editor de texto.
2.  Edita as seguintes linhas com os dados do teu alojamento:
    ```php
    define('DB_HOST', 'localhost'); // Geralmente mantém-se localhost
    define('DB_USER', 'o_teu_utilizador_cpanel');
    define('DB_PASS', 'a_tua_password_base_dados');
    define('DB_NAME', 'o_nome_da_base_dados');
    ```
3.  Guarda as alterações.

## 3. Upload de Ficheiros

Carrega os seguintes ficheiros para a pasta pública do teu servidor (ex: `public_html/admin` ou onde desejar o painel):

*   `admin_fontes.php` (O painel principal)
*   `FonteManager.php` (A classe de lógica)
*   `config.php` (A configuração editada)

## 4. Utilização

1.  Acede ao URL onde colocaste os ficheiros (ex: `www.tueseite.com/admin/admin_fontes.php`).
2.  Verás a tabela de fontes vazia.
3.  Clica em **"Adicionar Nova Fonte"** verde.
4.  Preenche o modal e clica em **Guardar**.
5.  A fonte aparecerá na lista. Podes editar ou apagar a qualquer momento.
