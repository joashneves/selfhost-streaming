<?php
/**
 * Roteador principal da API (localizado em /api)
 *
 * Este script identifica a URI da requisição e direciona a execução 
 * para o arquivo correspondente, como `filmes.php` ou `status.php`.
 * Também trata a rota raiz da API (/api) e erros de rota.
 */

// Obtém a URI e o método HTTP da requisição
$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remove o prefixo "/api" da URI para obter o caminho interno
$path = substr($requestUri, 4); 
$path = $path === '' ? '/' : $path; // Se vazio, define como raiz "/"

// Direciona para a rota apropriada
switch ($path) {
  // Rota raiz da API (/api) – retorna mensagem de boas-vindas em JSON
  case '/':
    echo json_encode(['mensagem' => 'Bem-vindo à API']);
    break;

  // Rota de status (/api/status) – carrega script que retorna informações da API
  case '/status':
    require __DIR__ . '/status.php';
    break;

  // Rota de filmes (/api/filmes e derivados) – direciona para filmes.php
  case str_starts_with($path, '/filmes'):
    require __DIR__ . '/filmes.php';
    break;

  // Qualquer outro caminho – responde com erro 404
  default:
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada na API']);
    break;
}
