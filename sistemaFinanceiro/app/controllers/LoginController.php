<?php
// recebe a requisição, chama o service e decide o que mostrar

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\AuthService;

class LoginController
{
    public function __construct(private \PDO $pdo) {}

    public function index(): void
{
    $titulo  = 'Login';

    // pega o erro da sessão e limpa logo em seguida
    $erro    = $_SESSION['erro'] ?? '';
    $usuario = $_SESSION['usuario'] ?? '';

    unset($_SESSION['erro']);
    unset($_SESSION['usuario']);

    $this->renderizar($titulo, $erro, $usuario);
}
    public function autenticar(): void
{
    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = trim($_POST['senha']   ?? '');

    $repository = new UserRepository($this->pdo);
    $service    = new AuthService($repository);
    $resultado  = $service->login($usuario, $senha);

    if ($resultado['sucesso']) {
        header('Location: /dashboard');
        exit;
    }

    $_SESSION['erro']    = $resultado['erro'];
    $_SESSION['usuario'] = $usuario;
    header('Location: /login');
    exit;
}
    private function renderizar(string $titulo, string $erro, string $usuario): void
    {
        // ob_start() captura tudo que o PHP imprimir a partir daqui
        ob_start();

        // carrega o conteúdo da view — vai para o buffer, não para a tela
        require_once __DIR__ . '/../../resources/views/auth/login.php';

        // ob_get_clean() pega o buffer e limpa — salva na variável $conteudo
        $conteudo = ob_get_clean();

        // carrega o layout base — que vai imprimir o $conteudo no lugar certo
        require_once __DIR__ . '/../../resources/views/layouts/base.php';
    }
}