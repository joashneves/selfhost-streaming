<?php
/**
 * Filme.php
 *
 * Define a classe `Filme`, que representa um filme com tipos fortemente tipados
 * (Título, Gênero, Sinopse, Publicação, Id) e fornece métodos estáticos para
 * manipular filmes armazenados no "banco de dados" (db.json).
 */

require_once __DIR__ . '/../data/db.php'; // Acesso ao "banco" de dados
require_once __DIR__ . '/tipos/Titulo.php'; // Tipagem forte para título
require_once __DIR__ . '/tipos/Genero.php'; // Tipagem forte para gênero
require_once __DIR__ . '/tipos/Sinopse.php'; // Tipagem forte para sinopse
require_once __DIR__ . '/tipos/Publicacao.php'; // Tipagem forte para data
require_once __DIR__ . '/tipos/Id.php'; // Tipagem forte para ID

class Filme implements JsonSerializable
{
  // Propriedades tipadas
  public Id $id;
  public Titulo $titulo;
  public Genero $genero;
  public Sinopse $sinopse;
  public Publicacao $publicacao;

  
  // Construtor da classe Filme
  public function __construct($id, $titulo, $genero, $sinopse, $publicacao)
  {
    $this->id = new Id($id);
    $this->titulo = new Titulo($titulo);
    $this->genero = new Genero($genero);
    $this->sinopse = new Sinopse($sinopse);
    $this->publicacao = new Publicacao($publicacao);
  }

  
  // Serializa a instância para JSON (para uso em respostas de API)
  public function jsonSerialize(): array
  {
    return [
      'id' => (string) $this->id,
      'titulo' => (string) $this->titulo,
      'genero' => (string) $this->genero,
      'sinopse' => (string) $this->sinopse,
      'publicacao' => (string) $this->publicacao,
    ];
  }

  
  // Retorna todos os filmes do banco
  public static function getTodos()
  {
    return lerFilmes();
  }

  
  // Retorna um filme específico pelo ID
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

  
  // Cria e salva um novo filme
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

  //  Atualiza um filme pelo ID com os dados fornecidos
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

  
  // Remove um filme pelo ID
  public static function deleteFilme($id): bool
  {
    return deletarFilme($id);
  }
}
