<?php
// Esse arquivo age como roteador da API (dentro de /api).

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remover prefixo "/api"
$path = substr($requestUri, 4); 
$path = $path === '' ? '/' : $path;

switch ($path) {
  // /api/ - retorna mensagem de boas-vindas em JSON
  case '/':
    echo json_encode(['mensagem' => 'Bem-vindo à API']);
    break;

  case '/status':
    // /api/status -retorna o status da API
    require __DIR__ . '/status.php';
    break;
   // /api/filmes - chama filmes.php (para listar ou buscar filmes)
  case str_starts_with($path, '/filmes'):
    require __DIR__ . '/filmes.php';
    break;

  default:
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada na API']);
    break;
}
