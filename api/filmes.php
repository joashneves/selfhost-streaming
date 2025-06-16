<?php

/**
 * Rota de gerenciamento de filmes
 *
 * Este script trata requisições HTTP para o endpoint /api/filmes, 
 * permitindo operações de CRUD (Create, Read, Update, Delete) 
 *
 * Métodos suportados:
 * - GET     /api/filmes           → Lista todos os filmes
 * - GET     /api/filmes/{id}      → Retorna um filme específico
 * - POST    /api/filmes           → Cria um novo filme (campos: titulo, genero, sinopse, publicacao)
 * - PUT     /api/filmes/{id}      → Atualiza um filme existente
 * - DELETE  /api/filmes/{id}      → Remove um filme do banco
 *
 * Requisitos:
 * - Arquivo responderjson.php para formatação de respostas JSON
 * - Classe Filme (filmesModels.php) com os métodos getPorId, getTodos, postFilme, putFilme, deleteFilme
 *
 * Todas as respostas são retornadas no formato JSON.
 */


// Importa utilitários para responder em JSON e modelo de filmes
require __DIR__ . '/../utils/responderjson.php';
require __DIR__ . '/../models/filmesModels.php';

// Define o cabeçalho de resposta como JSON
header('Content-Type: application/json');

// Captura o método HTTP e a URI da requisição
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$basePath = '/api/filmes';
$id = null;

// Verifica se há um ID numérico na URL e o extrai
if (preg_match('#^' . $basePath . '/(\d+)$#', $requestUri, $matches)) {
    $id = (int)$matches[1];
}

// Lida com a requisição conforme o método HTTP
switch ($method) {
    case 'GET':
        // Retorna um único filme se ID for informado
        if ($id !== null) {
            $filme = Filme::getPorId($id);
            
            if ($filme) {
                responderJson(true, 'Filme encontrado', $filme);
            } else {
                responderJson(false, 'Filme não encontrado', null, 404);
            }
        } else {
            // Retorna todos os filmes se nenhum ID for informado
            $todos = Filme::getTodos();
            responderJson(true, 'Lista de filmes', $todos);
        }
        break;

    case 'POST':
        // Lê e decodifica os dados enviados no corpo da requisição
        $dados = json_decode(file_get_contents('php://input'), true);

        // Verifica se os campos obrigatórios foram enviados
        if (!isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            responderJson(false, 'Campos obrigatórios: titulo, genero, sinopse e data de publicação', null, 400);
        }

        // Cria um novo filme no banco
        $resultado = Filme::postFilme(
            $dados['titulo'],
            $dados['genero'],
            $dados['sinopse'],
            $dados['publicacao']
        );

        // Responde com sucesso ou erro
        if ($resultado) {
            responderJson(true, 'Filme criado com sucesso', $resultado, 201);
        } else {
            responderJson(false, 'Erro ao criar filme', null, 500);
        }
        break;

    case 'PUT':
        // Atualização exige ID do filme
        if ($id === null) {
            responderJson(false, 'ID do filme é obrigatório para atualização', null, 400);
        }

        $dados = json_decode(file_get_contents('php://input'), true);

        // Valida os campos recebidos
        if (!$dados || !isset($dados['titulo'], $dados['genero'], $dados['sinopse'], $dados['publicacao'])) {
            responderJson(false, 'Campos obrigatórios: titulo, genero, sinopse e data de publicação', null, 400);
        }

        // Atualiza os dados do filme
        $atualizado = Filme::putFilme($id, $dados);
        if ($atualizado) {
            responderJson(true, 'Filme atualizado com sucesso', $atualizado);
        } else {
            responderJson(false, 'Filme não encontrado', null, 404);
        }
        break;

    case 'DELETE':
        // Exclusão exige ID do filme
        if ($id === null) {
            responderJson(false, 'ID do filme é obrigatório para exclusão', null, 400);
        }

        // Remove o filme do banco
        if (Filme::deleteFilme($id)) {
            responderJson(true, 'Filme removido com sucesso');
        } else {
            responderJson(false, 'Filme não encontrado', null, 404);
        }
        break;

    default:
        // Método HTTP não permitido
        responderJson(false, 'Método não suportado', null, 405);
        break;
}
