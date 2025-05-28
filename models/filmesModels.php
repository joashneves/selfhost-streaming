<?php

class Filme
{
  public $id;
  public $titulo;
  public $genero;
  public $sinopse;
  public $publicacao;

  // Construtor para facilitar a criação de objetos
  public function __construct($id, $titulo, $genero, $sinopse, $publicacao)
  {
    $this->id = $id;
    $this->titulo = $titulo;
    $this->genero = $genero;
    $this->sinopse = $sinopse;
    $this->publicacao = $publicacao;
  }

  // Retorna todos os filmes (como array de objetos)
  public static function getTodos(): array
  {
    return [
      new Filme(1, 'O Poderoso Chefão', 'Drama', 'Don Corleone resolve tudo com um olhar mortal...', '24/03/1972'),
      new Filme(2, 'Interestelar', 'Ficção', 'Gravidade, buracos negros e lágrimas no espaço...', '06/11/2014'),
      new Filme(3, 'Doctor Who', 'Ficção', 'Um alienígena britânico viaja no tempo...', '23/11/1963'),
      new Filme(4, 'Jumanji', 'Aventura', 'Nunca subestime um jogo de tabuleiro antigo...', '15/12/1995'),
      new Filme(5, 'Rei Leão', 'Animação', 'Prepare-se pra chorar com um pai leão...', '24/06/1994'),
    ];
  }

  // Busca por ID
  public static function getPorId(int $id): ?Filme
  {
    foreach (self::getTodos() as $filme) {
      if ($filme->id === $id) {
        return $filme;
      }
    }
    return null;
  }
}
