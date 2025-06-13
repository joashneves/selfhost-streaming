<?php
class Sinopse{
    private string $sinopse;
    public function __construct(string $sinopse)
    {
        $this->sinopse = $sinopse;
    }
    // Override do método __toString
    public function __toString(): string {
        return $this->sinopse;
    }
}