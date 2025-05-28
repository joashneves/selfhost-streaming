<?php
require __DIR__ . '/../models/filmesModels.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$basePath = '/api/filmes';
$id = null;


// Pega o ID da URL se houver
if (preg_match('#^' . $basePath . '/(\d+)$#', $requestUri, $matches)) {
    $id = (int)$matches[1];
}

switch ($method) {
    case 'GET':
        if ($id !== null) {
            $filme = Filme::getPorId($id);
            if ($filme) {
                echo json_encode($filme, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['erro' => 'Filme não encontrado']);
            }
        } else {
            echo json_encode(Filme::getTodos(), JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não suportado']);
        break;
}