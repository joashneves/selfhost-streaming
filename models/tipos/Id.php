<?php
// Classe que representa o identificador único de um filme como tipo específico
class Id {
    private string $id;

    // Construtor recebe o ID como string
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    // Retorna o ID como string ao converter o objeto
    public function __toString(): string {
        return $this->id;
    }
}
