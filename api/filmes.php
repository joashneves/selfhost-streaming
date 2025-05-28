<?php
// Importa o model Filme com os dados.
require __DIR__ . '/../models/filmesModels.php';
// Define que o conteúdo da resposta será JSON.
header('Content-Type: application/json');
// Pega o método HTTP e a URL da requisição.
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$basePath = '/api/filmes';
$id = null;


// Pega o ID da URL se houver Usa preg_match para extrair o ID da URL se presente.
if (preg_match('#^' . $basePath . '/(\d+)$#', $requestUri, $matches)) {
    $id = (int)$matches[1];
}

switch ($method) {
    case 'GET':
        // Se for /api/filmes/{id} - retorna o filme com aquele ID (ex: /api/filmes/3).
        if ($id !== null) {
            $filme = Filme::getPorId($id);
            if ($filme) {
                echo json_encode($filme, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['erro' => 'Filme não encontrado']);
            }
        } else {
            // Se a URL for /api/filmes - retorna todos os filmes.
            echo json_encode(Filme::getTodos(), JSON_UNESCAPED_UNICODE);
        }
        break;
    // Só aceita GET. Outros métodos (como POST/PUT/DELETE) retornam erro 405 (não permitido).
    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não suportado']);
        break;
}
