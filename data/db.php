<?php

define('DB_FILE', __DIR__ . '/db.json');

// Garante que o arquivo existe
if (!file_exists(DB_FILE)) {
    file_put_contents(DB_FILE, json_encode([]));
}

function lerFilmes()
{
    $conteudo = file_get_contents(DB_FILE);
    return json_decode($conteudo, true) ?? [];
}

function salvarFilmes(array $novoFilme)
{
    $filmes = lerFilmes();

    $novoFilme['id'] = gerarNovoId($filmes);
    $filmes[] = $novoFilme;

    file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $novoFilme;
}

function atualizarFilme(int $id, array $filmeAtualizado)
{
    $filmes = lerFilmes();
    $atualizado = false;

    foreach ($filmes as &$filme) {
        if ($filme['id'] == $id) {
            // Atualiza apenas os campos presentes no array enviado
            $filme = array_merge($filme, $filmeAtualizado);
            $atualizado = true;
            break;
        }
    }

    if ($atualizado) {
        file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $filme; // retorna o filme atualizado
    }

    return null; // não encontrou o filme
}

function gerarNovoId($filmes)
{
    $ids = array_column($filmes, 'id');
    return $ids ? max($ids) + 1 : 1;
}

function deletarFilme(int $id)
{
    $filmes = lerFilmes();
    $filmesFiltrados = array_filter($filmes, fn($f) => $f['id'] !== $id);

    if (count($filmes) === count($filmesFiltrados)) {
        return false; // nenhum foi removido
    }

    file_put_contents(DB_FILE, json_encode(array_values($filmesFiltrados), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return true;
}
