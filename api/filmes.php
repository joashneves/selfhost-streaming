<?php
require __DIR__ . '/../utils/responderjson.php';
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
                responderJson(true, 'Filme encontrado', $filme);
            } else {
                responderJson(false, 'Filme não encontrado', null, 404);
            }
        } else {
            $todos = Filme::getTodos();
            responderJson(true, 'Lista de filmes', $todos);
        }
        break;

    case 'POST':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            responderJson(false, 'Campos obrigatórios: titulo, genero, sinopse e data de publicação', null, 400);
        }

        $resultado = Filme::postFilme(
            $dados['titulo'],
            $dados['genero'],
            $dados['sinopse'],
            $dados['publicacao']
        );

        if ($resultado) {
            responderJson(true, 'Filme criado com sucesso', $resultado, 201);
        } else {
            responderJson(false, 'Erro ao criar filme', null, 500);
        }
        break;

    case 'PUT':
        if ($id === null) {
            responderJson(false, 'ID do filme é obrigatório para atualização', null, 400);
        }

        $dados = json_decode(file_get_contents('php://input'), true);

        if (!$dados || !isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            responderJson(false, 'Campos obrigatórios: titulo, genero, sinopse e data de publicação', null, 400);
        }

        $atualizado = Filme::putFilme($id, $dados);
        if ($atualizado) {
            responderJson(true, 'Filme atualizado com sucesso', $atualizado);
        } else {
            responderJson(false, 'Filme não encontrado', null, 404);
        }
        break;

    case 'DELETE':
        if ($id === null) {
            responderJson(false, 'ID do filme é obrigatório para exclusão', null, 400);
        }

        if (Filme::deleteFilme($id)) {
            responderJson(true, 'Filme removido com sucesso');
        } else {
            responderJson(false, 'Filme não encontrado', null, 404);
        }
        break;

    default:
        responderJson(false, 'Método não suportado', null, 405);
        break;
}

