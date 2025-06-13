<?php
class Genero{
    private string $genero;
    public function __construct(string $genero)
    {
        $this->genero = $genero;
    }
    // Override do método __toString
    public function __toString(): string {
        return $this->genero;
    }
}