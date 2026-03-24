<?php
// recebe a conexão do banco e retorna objetos User

namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo) {}

    public function findByUsuario(string $usuario): ?User
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, usuario, senha 
             FROM usuarios 
             WHERE usuario = :usuario 
             LIMIT 1"
        );

        // executa substituindo :usuario pelo valor real
        $stmt->execute([':usuario' => $usuario]);

        // busca o resultado como array associativo
        $dados = $stmt->fetch();

        if (!$dados) return null;
        
        $user          = new User();
        $user->id      = $dados['id'];
        $user->usuario = $dados['usuario'];
        $user->senha   = $dados['senha'];

        return $user;
    }
}