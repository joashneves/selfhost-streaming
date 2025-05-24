<?php
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/api/filmes';


$filmes = [
  ['id' => 1, 'titulo' => 'O Poderoso Chefão'],
  ['id' => 2, 'titulo' => 'Interestelar'],
  ['id' => 3, 'titulo' => 'doctor who']
];


// Verifica se tem um ID na rota
$id = null;
if (preg_match('#^' . $basePath . '/(\d+)$#', $requestUri, $matches)) {
  $id = (int)$matches[1];
}

switch ($method) {
  case 'GET':
    if ($id !== null) {
      // Buscar filme específico
      foreach ($filmes as $filme) {
        if ($filme['id'] === $id) {
          echo json_encode($filme, JSON_UNESCAPED_UNICODE);
          exit;
        }
      }
      http_response_code(404);
      echo json_encode(['erro' => 'Filme não encontrado']);
    } else {
      // Listar todos os filmes
      echo json_encode($filmes, JSON_UNESCAPED_UNICODE);
    }
    break;

  case 'POST':
    echo json_encode(['mensagem' => 'Aqui você criaria um novo filme']);
    break;

  case 'PUT':
    echo json_encode(['mensagem' => 'Aqui você atualizaria um filme existente']);
    break;

  default:
    http_response_code(405); // Method Not Allowed
    echo json_encode(['erro' => 'Método não suportado']);
    break;
  }
?>