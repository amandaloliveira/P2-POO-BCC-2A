<?php

namespace Unimar\Poo;

abstract class Pessoa
{
    protected string $nome;
    protected string $email;
    private string $senha;

    public function __construct(string $nome, string $email, string $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = trim($nome);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = trim($email);
    }

    public function setSenha(string $senha): void
    {
        if (strlen($senha) >= 4) {
            $this->senha = $senha;
        }
    }

    public function verificarSenha(string $senha): bool
    {
        return $this->senha === $senha;
    }

    public function seApresentar(): string
    {
        return "Usuário: " . $this->nome . " (" . $this->email . ")";
    }
}
?>