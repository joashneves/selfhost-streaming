<?php
class Publicacao{
    private string $publicacao;
    public function __construct(string $publicacao)
    {
        $this->publicacao = $publicacao;
    }
    // Override do método __toString
    public function __toString(): string {
        return $this->publicacao;
    }
}