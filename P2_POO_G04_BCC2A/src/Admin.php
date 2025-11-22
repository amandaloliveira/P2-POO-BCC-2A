<?php

namespace Unimar\Poo;

use Unimar\Poo\Jogo;
use Unimar\Poo\Pessoa;
use Unimar\Poo\Categoria;
use Unimar\Poo\Comunidade;

class Admin extends Pessoa
{
    public function adicionarJogo(array &$jogos, string $nome, string $descricao, int $ano, Categoria $categoria): Jogo
    {
        $novoJogo = new Jogo($nome, $descricao, $ano, $categoria);
        $jogos[] = $novoJogo; 
        $categoria->adicionarJogo($novoJogo); 
        echo "$this->nome adicionou o jogo $nome.\n";
        return $novoJogo;
    }

    public function editarJogo(Jogo $jogo, string $novoNome, string $novaDescricao, int $novoAno, Categoria $novaCategoria): void
    {
        $categoriaAntiga = $jogo->getCategoria();
        if ($categoriaAntiga !== $novaCategoria) {
            $categoriaAntiga->removerJogo($jogo);
            $novaCategoria->adicionarJogo($jogo);
    }

    $jogo->editarJogo($novoNome, $novaDescricao, $novoAno, $novaCategoria);
    
    echo "$this->nome editou o jogo '$novoNome' e atualizou suas associações.\n";
    }

    public function removerJogo(array &$jogos, Jogo $jogoRemover): void{
        $jogoRemover->getCategoria()->removerJogo($jogoRemover);
        
        $jogoParaRemover = array_search($jogoRemover, $jogos, true);

        if($jogoParaRemover !== false){
            unset($jogos[$jogoParaRemover]);
            $jogos = array_values($jogos);
            echo "Jogo removido com sucesso.\n";
        } else {
            echo "Erro: Jogo não encontrado na lista.\n";
        }
    }

    public function adicionarCategoria(array &$categorias, string $chave, string $nome): bool{
        if (isset($categorias[$chave])){
            return false;
        }
        $categorias[$chave] = new Categoria($nome);
        return true; 
    }

    public function editarCategoria(Categoria $categoria, string $novoNome): void{
        $categoria->setNome($novoNome);
    }

    public function excluirCategoria(array &$categorias, string $chave): void{
        if (isset($categorias[$chave])) {
            unset($categorias[$chave]);
        }
    }

     public function criarComunidade(array &$comunidades, string $nome): void{
        $novaComunidade = new Comunidade($nome);
        $comunidades[] = $novaComunidade;
        echo "$this->nome criou a nova comunidade: $nome.\n";
    }

    public function editarComunidade(Comunidade $comunidade, string $novoNome): void{
        $nomeAntigo = $comunidade->getNome();
        $comunidade->setNome($novoNome); 
        echo "$this->nome editou a comunidade '$nomeAntigo' para '$novoNome'.\n";
    }

    public function excluirComunidade(array &$comunidades, Comunidade $comunidadeParaExcluir): void
    {
        $nomeComunidade = $comunidadeParaExcluir->getNome();
        
        foreach ($comunidades as $comunidadeChave => $comunidade) {
            if ($comunidade === $comunidadeParaExcluir) {
                unset($comunidades[$comunidadeChave]);
                
                $comunidades = array_values($comunidades);
                echo "Comunidade '$nomeComunidade' excluída com sucesso.\n";
                return;
            }
        }
        echo "Erro: Comunidade não encontrada no sistema.\n";
    }

    public function seApresentar(): string
    {
        return "ADMINISTRADOR: " . $this->nome . " - Acesso Total ao Sistema.";
    }
}
?>