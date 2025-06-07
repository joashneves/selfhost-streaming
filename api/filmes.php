<?php
require __DIR__ . '/../models/filmesModels.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$basePath = '/api/filmes';
$id = null;

// Extrai ID da URL se existir
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

    case 'POST':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Campos obrigatórios: titulo, genero, sinopse e data de publicação']);
            break;
        }

        $resultado = Filme::postFilme(
            $dados['titulo'],
            $dados['genero'],
            $dados['sinopse'],
            $dados['publicacao']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(['mensagem' => 'Filme criado com sucesso', 'filme' => $resultado]);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao criar filme']);
        }
        break;

    case 'PUT':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID do filme é obrigatório para atualização']);
            break;
        }
        // Recebe campo body do json
        $dados = json_decode(file_get_contents('php://input'), true);
        // Valida se os dados do campo são validos
        if (!isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Campos obrigatórios: titulo, genero, sinopse e data de publicação']);
            break;
        }
        if (!$dados) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos ou ausentes']);
            break;
        }

        $atualizado = Filme::putFilme($id, $dados);
        if ($atualizado) {
            echo json_encode(['mensagem' => 'Filme atualizado com sucesso', 'filme' => $atualizado]);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Filme não encontrado']);
        }
        break;

    case 'DELETE':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID do filme é obrigatório para exclusão']);
            break;
        }

        if (Filme::deleteFilme($id)) {
            echo json_encode(['mensagem' => 'Filme removido com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Filme não encontrado']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não suportado']);
        break;
}
