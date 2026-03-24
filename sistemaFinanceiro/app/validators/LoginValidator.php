<?php
// app/validators/LoginValidator.php
// valida os dados do formulário antes de qualquer consulta ao banco
// se inválido, retorna o erro imediatamente sem nem tocar no banco

namespace App\Validators;

class LoginValidator
{
    // armazena todos os erros encontrados
    private array $erros = [];

    public function validar(string $usuario, string $senha): bool
    {
        // limpa erros de uma validação anterior
        $this->erros = [];

        // verifica se o campo usuário está vazio
        if (empty(trim($usuario))) {
            $this->erros[] = 'O campo usuário é obrigatório.';
        }

        // verifica se o campo senha está vazio
        if (empty(trim($senha))) {
            $this->erros[] = 'O campo senha é obrigatório.';
        }

        // verifica tamanho mínimo da senha
        // só verifica se a senha não está vazia para não duplicar erro
        if (!empty($senha) && strlen($senha) < 6) {
            $this->erros[] = 'A senha deve ter no mínimo 6 caracteres.';
        }

        // retorna true se não tiver nenhum erro
        return empty($this->erros);
    }

    // retorna todos os erros encontrados
    public function getErros(): array
    {
        return $this->erros;
    }

    // retorna só o primeiro erro — usado para exibir na tela
    public function getPrimeiroErro(): string
    {
        return $this->erros[0] ?? '';
    }
}