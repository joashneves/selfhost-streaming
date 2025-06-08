<?php
class Id{
    private string $id;
    public function __construct(string $id)
    {
        $this->id = $id;
    }
    // Override do método __toString
    public function __toString(): string {
        return $this->id;
    }
}