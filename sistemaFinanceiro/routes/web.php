<?php
// toda requisição passa por aqui antes de chegar no controller

use App\Controllers\LoginController;

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$metodo = $_SERVER['REQUEST_METHOD'];

// GET / ou GET /login — exibe o formulário
if (($uri === '/' || $uri === '/login') && $metodo === 'GET') {
    $controller = new LoginController($pdo);
    $controller->index();
    exit;
}

// POST /login — processa o formulário enviado
if ($uri === '/login' && $metodo === 'POST') {
    $controller = new LoginController($pdo);
    $controller->autenticar();
    exit;
}

// nenhuma rota encontrada — retorna 404
http_response_code(404);
echo '404 — Página não encontrada.';

// GET /dashboard — página inicial após login
if ($uri === '/dashboard' && $metodo === 'GET') {
    // verifica se está logado
    if (empty($_SESSION['usuario_id'])) {
        header('Location: /login');
        exit;
    }

    $titulo   = 'Dashboard';
    $erro     = '';
    $usuario  = '';

    ob_start();
    require_once __DIR__ . '/../resources/views/dashboard/index.php';
    $conteudo = ob_get_clean();
    require_once __DIR__ . '/../resources/views/layouts/base.php';
    exit;
}