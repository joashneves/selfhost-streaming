<?php
// Classe que representa a data de publicação de um filme como um tipo específico
class Publicacao {
    private string $publicacao;

    // Construtor recebe a data de publicação como string
    public function __construct(string $publicacao)
    {
        $this->publicacao = $publicacao;
    }

    // Retorna a data de publicação como string ao converter o objeto
    public function __toString(): string {
        return $this->publicacao;
    }
}
