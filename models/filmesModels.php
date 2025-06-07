<?php
require_once __DIR__ . '/../data/db.php';

class Filme
{
  public $id;
  public $titulo;
  public $genero;
  public $sinopse;
  public $publicacao;

  public function __construct($id, $titulo, $genero, $sinopse, $publicacao)
  {
    $this->id = $id;
    $this->titulo = $titulo;
    $this->genero = $genero;
    $this->sinopse = $sinopse;
    $this->publicacao = $publicacao;
  }

  public static function getTodos()
  {
    return lerFilmes();
  }

  public static function getPorId($id)
  {
    $filmes = lerFilmes();
    foreach ($filmes as $filme) {
      if ($filme['id'] == $id) {
        return new Filme(
          $filme['id'],
          $filme['titulo'],
          $filme['genero'],
          $filme['sinopse'],
          $filme['publicacao']
        );
      }
    }
    return null;
  }

  public static function postFilme(string $nome, string $genero, string $sinopse, string $publicacao): ?Filme
  {
    $filme = [
      'titulo' => $nome,
      'genero' => $genero,
      'sinopse' => $sinopse,
      'publicacao' => $publicacao
    ];

    $salvo = salvarFilmes($filme);

    return new Filme(
      $salvo['id'],
      $salvo['titulo'],
      $salvo['genero'],
      $salvo['sinopse'],
      $salvo['publicacao']
    );
  }

  public static function putFilme($id, array $dadosAtualizados): ?Filme
  {
    $atualizado = atualizarFilme($id, $dadosAtualizados);

    if ($atualizado) {
      return new Filme(
        $atualizado['id'],
        $atualizado['titulo'],
        $atualizado['genero'],
        $atualizado['sinopse'],
        $atualizado['publicacao']
      );
    }

    return null;
  }

  public static function deleteFilme($id): bool
  {
    return deletarFilme($id);
  }
}
