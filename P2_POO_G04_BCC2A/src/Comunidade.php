<?php

namespace Unimar\Poo;

class Comunidade {

    private string $nome;
    private array $membros = [];        
    private array $comentarios = [];     

    public function __construct(string $nome){
        $this->nome = $nome;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getMembros(): array{
        return $this->membros;
    }

    public function getComentarios(): array{
        return $this->comentarios;
    }

    public function adicionarMembro(Pessoa $membro): void{
        $this->membros[] = $membro;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }

    public function removerMembro(Pessoa $membro): void{
        foreach ($this->membros as $index => $u) {
            if ($u === $membro) {
                unset($this->membros[$index]);
                $this->membros = array_values($this->membros);
                break;
            }
        }
    }

    public function adicionarComentario(Comentario $comentario): void{
        $this->comentarios[] = $comentario;
    }

    public function removerComentario(Comentario $comentario): void {
        $chave = array_search($comentario, $this->comentarios, true);
        if ($chave !== false) {
            unset($this->comentarios[$chave]);
            $this->comentarios = array_values($this->comentarios); 
        }
    }

    public function exibirListaDeComentarios(): void{
        if (empty($this->comentarios)) {
            echo "Nenhum comentário disponível.\n";
            return;
        }

        echo "Comentários da comunidade '{$this->nome}':\n";
        foreach ($this->comentarios as $c) {
            if ($c instanceof Comentario) {
                echo "- [" . $c->getDataFormatada() . "] " . 
                     $c->getAutor()->getNome() . ": " . 
                     $c->getTexto() . "\n";
            }
        }
    }

    public function exibirListaDeUsuarios(): void{
        if (empty($this->membros)) {
            echo "Nenhum usuário inserido.\n";
            return;
        }

        echo "Usuários da comunidade '{$this->nome}':\n";
        foreach ($this->membros as $u) {
            echo "- " . $u->getNome() . "\n";
        }
    }
}
?>