<?php
// Define a classe Filme, que representa um filme com seus dados.
require_once __DIR__ . '/../data/db.php';
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

  // Retorna todos os filmes (como array de objetos) O método getTodos() retorna uma lista fixa (mockada) de filmes.
  public static function getTodos()
  {
    return lerFilmes();
  }

  // Busca por ID O método getPorId($id) busca um filme específico pelo ID.  
  public static function getPorId($id)
  {
    $filmes = lerFilmes();
    foreach ($filmes as $filme) {
      if ($filme['id'] == $id) {
        return $filme;
      }
    }
    return null;
  }
  // Cria objeto novo com o Metodo PostFilme, passa dados para a função que cria um filme
  public static function postFilme(string $nome, string $genero, string $sinopse, string $publicacao): ?Filme
  {
    $filme = [
      'titulo' => $nome,
      'genero' => $genero,
      'sinopse' => $sinopse,
      'publicacao' => $publicacao
    ];
    // manda o objeto criado para o db.php
    $salvo = salvarFilmes($filme);

    return new Filme(
      $salvo['id'],
      $salvo['titulo'],
      $salvo['genero'],
      $salvo['sinopse'],
      $salvo['publicacao']
    );
  }
}
