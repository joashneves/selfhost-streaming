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
      new Filme(1, 'O Poderoso Chefão', 'Drama',
      'Don Corleone resolve tudo com um olhar mortal e propostas que você literalmente não pode recusar. Um guia prático de negócios, família e tapas de luva de pelica.', '24/03/1972'),
      new Filme(2, 'Interestelar', 'Ficção', 
      'Gravidade, buracos negros e lágrimas no espaço: o manual de como plantar milho, atravessar galáxias e tentar entender o final com um diploma de física quântica nas mãos.', '06/11/2014'),
      new Filme(3, 'Doctor Who', 'Ficção', 
      'Um alienígena britânico viaja no tempo com uma cabine telefônica azul, salvando o universo com um sorriso sarcástico e uma chave de fenda que faz tudo — menos parafusar', '23/11/1963'),
      new Filme(4, 'Jumanji', 'Aventura',
      'Nunca subestime um jogo de tabuleiro antigo. Ele pode liberar selvas, leões, e até adultos traumatizados. Tudo por diversão em família e gritos pela casa inteira.', '15/12/1995'),
      new Filme(5, 'Rei Leão', 'Animação', 
      'Prepare-se pra chorar com um pai leão, cantar com um javali e ver um suricato dando lição de vida. Hamlet na savana com muito Hakuna Matata e traumas infantis inclusos.', '24/06/1994'),
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
