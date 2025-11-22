<?php

namespace Unimar\Poo;

use Unimar\Poo\Avaliacao;
use Unimar\Poo\Categoria;

class Jogo
{
    private string $titulo;
    private string $descricao;
    private int $ano;
    private array $avaliacoes = [];
    private float $mediaDeAvaliacoes = 0.0;
    private Categoria $categoria;

    public function __construct(string $titulo, string $descricao, int $ano, Categoria $categoria)
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->ano = $ano;
        $this->categoria = $categoria;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getAno(): int {
        return $this->ano;
    }

    public function getCategoria(): Categoria {
        return $this->categoria;
    }

    public function getMediaDeAvaliacoes(): float {
        return $this->mediaDeAvaliacoes;
    }

    public function setTitulo(string $titulo): void {
        if (empty(trim($titulo))){
            echo "ERRO: O título não pode ser vazio.\n";
            return;
        }
        $this->titulo = $titulo;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function setAno(int $ano): void {
        if ($ano < 1800 || $ano > date('Y') + 5){
            echo "AVISO: O ano inserido aparenta ser uma informação duvidosa, mas será salvo mesmo assim.\n";
        }
        $this->ano = $ano;
    }

    public function setCategoria(Categoria $categoria): void {
        $this->categoria = $categoria;
    }

    public function receberAvaliacao(Avaliacao $avaliacao): void
    {
        $this->avaliacoes[] = $avaliacao;
        $this->calcularMediaAvaliacoes();
    }

    public function removerAvaliacao(Avaliacao $avaliacaoParaRemover): void
    {
        foreach ($this->avaliacoes as $key => $avaliacao) {
            if ($avaliacao === $avaliacaoParaRemover) {
                unset($this->avaliacoes[$key]);
                break;
            }
        }
        $this->avaliacoes = array_values($this->avaliacoes);
        $this->calcularMediaAvaliacoes();
    }

    public function calcularMediaAvaliacoes(): void
    {
        $totalNotas = 0;
        $numeroDeAvaliacoes = count($this->avaliacoes);

        if ($numeroDeAvaliacoes === 0) {
            $this->mediaDeAvaliacoes = 0.0;
            return;
        }

        foreach ($this->avaliacoes as $avaliacao) {
            $totalNotas += $avaliacao->getNota();
        }

        $this->mediaDeAvaliacoes = $totalNotas / $numeroDeAvaliacoes;
    }

    public function editarJogo(string $titulo, string $descricao, int $ano, Categoria $categoria): void {
        $this->setTitulo($titulo);
        $this->setDescricao($descricao);
        $this->setAno($ano);
        $this->setCategoria($categoria);
    }

    public function exibirDetalhes(): void
    {
        echo "\n---------------- Ficha do Jogo ----------------\n";
        echo "Nome: " . $this->getTitulo() . "\n";
        echo "Descrição: " . $this->getDescricao() . "\n";
        echo "Categoria: " . $this->categoria->getNome() . "\n";
        echo "Ano de Lançamento: " . $this->getAno() . "\n";
        echo "Média de Avaliações: " . number_format($this->mediaDeAvaliacoes, 2) . "\n";
        echo "-----------------------------------------------\n";
    }
}
?>