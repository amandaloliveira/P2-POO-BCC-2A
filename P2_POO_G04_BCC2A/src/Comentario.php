<?php

namespace Unimar\Poo;

class Comentario {
    private Pessoa $autor;
    private string $texto;
    private \DateTime $data;

    public function __construct(Pessoa $autor, string $texto) {
        $this->autor = $autor;
        $this->texto = $texto;
        $this->data = new \DateTime();
    }

    public function getAutor(): Pessoa {
        return $this->autor; 
    }

    public function getTexto(): string {
        return $this->texto;
    }

    public function setTexto(string $texto): void {
        $this->texto = $texto;
    }

    public function getDataFormatada(): string {
        return $this->data->format('d/m/Y H:i');
    }
}