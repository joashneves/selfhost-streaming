<?php
/*
 * Representa o título de um filme como um tipo fortemente tipado.
 * Encapsula a string e fornece um método __toString para fácil conversão.
 */
class Titulo {
    private string $titulo;

    // Construtor recebe o título como string
    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
    }

    // Converte a instância para string automaticamente
    public function __toString(): string {
        return $this->titulo;
    }
}
