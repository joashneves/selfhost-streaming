<?php
// Classe que representa a sinopse de um filme como um tipo fortemente tipado
class Sinopse {
    private string $sinopse;

    // Construtor recebe a sinopse como string
    public function __construct(string $sinopse)
    {
        $this->sinopse = $sinopse;
    }

    // Retorna a sinopse como string ao converter o objeto
    public function __toString(): string {
        return $this->sinopse;
    }
}
