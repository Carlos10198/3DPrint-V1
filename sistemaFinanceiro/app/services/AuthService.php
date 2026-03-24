<?php
// app/services/AuthService.php
// contém a regra de negócio do login
// une o validator e o repository para autenticar o usuário

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\LoginValidator;

class AuthService
{
    // recebe o repository pelo construtor
    public function __construct(private UserRepository $userRepository) {}

    public function login(string $usuario, string $senha): array
    {
        // passo 1 — valida os campos antes de qualquer coisa
        $validator = new LoginValidator();

        if (!$validator->validar($usuario, $senha)) {
            return [
                'sucesso' => false,
                'erro'    => $validator->getPrimeiroErro()
            ];
        }

        // passo 2 — busca o usuário no banco
        $user = $this->userRepository->findByUsuario($usuario);

        // passo 3 — verifica se o usuário existe
        if (!$user) {
            return [
                'sucesso' => false,
                // mensagem genérica — não revela se o usuário existe ou não
                'erro'    => 'Usuário ou senha incorretos.'
            ];
        }

        // passo 4 — verifica se a senha está correta
        // password_verify compara a senha digitada com o hash do banco
        if (!password_verify($senha, $user->senha)) {
            return [
                'sucesso' => false,
                // mesma mensagem genérica do passo 3 — por segurança
                'erro'    => 'Usuário ou senha incorretos.'
            ];
        }

        // passo 5 — tudo certo, salva na sessão
        $_SESSION['usuario_id']   = $user->id;
        $_SESSION['usuario_nome'] = $user->usuario;

        return ['sucesso' => true];
    }
}