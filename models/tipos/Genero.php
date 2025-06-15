<?php
// Classe que representa o gênero de um filme como tipo específico
class Genero {
    private string $genero;

    // Construtor recebe o gênero como string
    public function __construct(string $genero)
    {
        $this->genero = $genero;
    }

    // Retorna o gênero como string ao converter o objeto
    public function __toString(): string {
        return $this->genero;
    }
}
