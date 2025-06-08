<?php
require_once __DIR__ . '/../data/db.php';
require_once __DIR__ . '/tipos/Titulo.php';
require_once __DIR__ . '/tipos/Genero.php';
require_once __DIR__ . '/tipos/Sinopse.php';
require_once __DIR__ . '/tipos/Publicacao.php';
require_once __DIR__ . '/tipos/Id.php';

class Filme
{
  public Id $id;
  public Titulo $titulo;
  public Genero $genero;
  public Sinopse $sinopse;
  public Publicacao $publicacao;

  public function __construct($id, $titulo, $genero, $sinopse, $publicacao)
  {
    $this->id = new Id($id);
    $this->titulo = new Titulo($titulo);
    $this->genero = new Genero($genero);
    $this->sinopse = new Sinopse($sinopse);
    $this->publicacao = new Publicacao($publicacao);
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
