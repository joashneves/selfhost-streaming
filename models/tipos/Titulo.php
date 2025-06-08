<?php
class Titulo{
    private string $titulo;
    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
    }
    // Override do método __toString
    public function __toString(): string {
        return $this->titulo;
    }
}