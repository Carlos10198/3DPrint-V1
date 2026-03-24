<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/db.php';

// gera token CSRF para proteger os formulários, só gera se ainda não existir na sessão
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../routes/web.php';