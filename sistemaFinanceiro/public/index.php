<?php
session_start();

require_once __DIR__ . '/../config/db.php';

// captura o html da view em memória
ob_start();
require_once __DIR__ . '/../resources/views/auth/login.php';
$conteudo = ob_get_clean();

// injeta no layout base
require_once __DIR__ . '/../resources/views/layouts/base.php';