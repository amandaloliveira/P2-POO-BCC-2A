<?php

namespace Unimar\Poo;

use Unimar\Poo\Jogo;
use Unimar\Poo\Avaliacao;
use Unimar\Poo\Pessoa;

class Avaliador extends Pessoa
{
    private array $minhasAvaliacoes = [];
    private array $jogosFavoritos = [];
    private array $comunidades = [];
   
    public function avaliarJogo(Jogo $jogo, float $nota, bool $recomenda): ?Avaliacao
    {
        foreach ($this->minhasAvaliacoes as $avaliacao) {
            if ($avaliacao->getJogo() === $jogo) {
                return null;
            }
        }

        $avaliacao = new Avaliacao($this, $jogo, $nota, $recomenda);
        $jogo->receberAvaliacao($avaliacao);
        $this->minhasAvaliacoes[] = $avaliacao;

        return $avaliacao;
    }

    public function editarAvaliacao(Avaliacao $avaliacao, float $novaNota, bool $novoRecomenda): void
    {
        if (!in_array($avaliacao, $this->minhasAvaliacoes, true)) {
            echo "Operação não permitida. Esta avaliação não é sua.\n";
            return;
        }

        $avaliacao->setNota($novaNota);
        $avaliacao->setRecomenda($novoRecomenda);
        $avaliacao->getJogo()->calcularMediaAvaliacoes();
        echo "\nAvaliação editada com sucesso!\n";
    }

    public function excluirAvaliacao(Avaliacao $avaliacao): void
    {
        $chave = array_search($avaliacao, $this->minhasAvaliacoes, true);

        if ($chave === false) {
            echo "Operação não permitida. Esta avaliação não é sua.\n";
            return;
        }

        unset($this->minhasAvaliacoes[$chave]);
        $this->minhasAvaliacoes = array_values($this->minhasAvaliacoes);

        $avaliacao->getJogo()->removerAvaliacao($avaliacao);
        echo "\nAvaliação excluída com sucesso!\n";
    }

    public function getMinhasAvaliacoes(): array
    {
        return $this->minhasAvaliacoes;
    }

    public function adicionarJogoFavorito(Jogo $jogo): void
    {
        if (!isset($this->jogosFavoritos[$jogo->getTitulo()])) {
            $this->jogosFavoritos[$jogo->getTitulo()] = $jogo;
            echo "\nJogo '" . $jogo->getTitulo() . "' adicionado aos favoritos!\n";
        } else {
            echo "\nEste jogo já está nos seus favoritos.\n";
        }
    }

    public function removerJogoFavorito(Jogo $jogo): void
    {
        if (isset($this->jogosFavoritos[$jogo->getTitulo()])) {
            unset($this->jogosFavoritos[$jogo->getTitulo()]);
            echo "\nJogo '" . $jogo->getTitulo() . "' removido dos favoritos.\n";
        } else {
            echo "\nEste jogo não estava nos seus favoritos.\n";
        }
    }

    public function limparJogoExcluido(Jogo $jogoExcluido): void
    {
        $jogoParaLimpar = array_search($jogoExcluido, $this->jogosFavoritos, true);

        if ($jogoParaLimpar !== false) {
            unset($this->jogosFavoritos[$jogoParaLimpar]);
            $this->jogosFavoritos = array_values($this->jogosFavoritos);
            echo "Jogo '" . $jogoExcluido->getTitulo() . "' foi removido dos favoritos de $this->nome.\n";
        }
    }

    public function getJogosFavoritos(): array
    {
       return array_values($this->jogosFavoritos);
    }

    public function entrarComunidade(Comunidade $comunidade): bool {
        if (in_array($comunidade, $this->comunidades, true)) {
            return false; 
        }
        $this->comunidades[] = $comunidade;
        $comunidade->adicionarMembro($this);
        return true;
    }

    public function sairComunidade(Comunidade $comunidade): bool {
        $key = array_search($comunidade, $this->comunidades, true);
        if ($key !== false) {
            unset($this->comunidades[$key]);
            $comunidade->removerMembro($this);
            return true;
        }
        return false;
    }

    public function publicarComentario(Comunidade $comunidade, string $texto): void {
        if (in_array($comunidade, $this->comunidades, true)) {
            $novoComentario = new Comentario($this, $texto);
            $comunidade->adicionarComentario($novoComentario);
        } else {
            throw new \Exception("Você precisa ser membro da comunidade para comentar.");
        }
    }

    public function editarComentario(Comentario $comentario, string $novoTexto): bool {
        if ($comentario->getAutor() === $this) {
            $comentario->setTexto($novoTexto);
            return true;
        }
        return false;
    }

    public function excluirComentario(Comunidade $comunidade, Comentario $comentario): bool {
        if ($comentario->getAutor() === $this) {
            $comunidade->removerComentario($comentario);
            return true;
        }
        return false;
    }
    
    public function getMinhasComunidades(): array {
        return $this->comunidades;
    }

    public function limparComunidadeExcluida(Comunidade $comunidadeExcluida): void
    {
        $chave = array_search($comunidadeExcluida, $this->comunidades, true);
        if ($chave !== false) {
            unset($this->comunidades[$chave]);
            $this->comunidades = array_values($this->comunidades);
            echo "A comunidade '{$comunidadeExcluida->getNome()}' foi extinta e removida da sua lista.\n";
        }
    }

    public function limparAvaliacoesDeJogoExcluido(Jogo $jogoExcluido): void
    { 
        foreach ($this->minhasAvaliacoes as $chave => $avaliacao) {
            if ($avaliacao->getJogo() === $jogoExcluido) {
                unset($this->minhasAvaliacoes[$chave]);
            }
        }
        $this->minhasAvaliacoes = array_values($this->minhasAvaliacoes);
    }

    public function seApresentar(): string
    {
        return parent::seApresentar() . " - Perfil de Crítico de Jogos.";
    }
}
?>