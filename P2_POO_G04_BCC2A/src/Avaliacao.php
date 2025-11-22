<?php

namespace Unimar\Poo;

use Unimar\Poo\Jogo;
use Unimar\Poo\Avaliador;

class Avaliacao
{
    private Avaliador $avaliador;
    private Jogo $jogo;
    private float $nota;
    private bool $recomenda;

    public function __construct(Avaliador $avaliador, Jogo $jogo, float $nota, bool $recomenda)
    {
        $this->avaliador = $avaliador;
        $this->jogo = $jogo;
        $this->nota = $nota;
        $this->recomenda = $recomenda;
    }

    public function getAvaliador(): Avaliador
    {
        return $this->avaliador;
    }

    public function getJogo(): Jogo
    {
        return $this->jogo;
    }

    public function getNota(): float
    {
        return $this->nota;
    }

    public function getRecomenda(): bool
    {
        return $this->recomenda;
    }

    public function setNota(float $nota): void
    {
        $this->nota = $nota;
    }

    public function setRecomenda(bool $recomenda): void
    {
        $this->recomenda = $recomenda;
    }
}

?>