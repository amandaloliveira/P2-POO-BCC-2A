<?php

namespace Unimar\Poo;

class Categoria{
    private string $nome;
    private array $jogos = [];

    public function __construct(string $nome){
        $this->nome = $nome;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }
    
    public function adicionarjogo(jogo $jogo): void{
        $this->jogos[] = $jogo;
    }

    public function removerJogo(Jogo $jogo): void{
        $jogoParaRemover = array_search($jogo, $this->jogos, true);
        
        if ($jogoParaRemover !== false) {
            unset($this->jogos[$jogoParaRemover]);
            $this->jogos = array_values($this->jogos); 
        }
    }

    public function getJogos(): array{
        return $this->jogos; 
    }
}

?>