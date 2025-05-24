<?php


$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remover prefixo /api
$path = substr($requestUri, 4); // remove "/api"
$path = $path === '' ? '/' : $path;

switch ($path) {
  case '/':
    echo json_encode(['mensagem' => 'Bem-vindo à API']);
    break;

  case '/status':
    require __DIR__ . '/status.php';
    break;

  case str_starts_with($path, '/filmes'):
    require __DIR__ . '/filmes.php';
    break;

  default:
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada na API']);
    break;
}
