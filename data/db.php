<?php

define('DB_FILE', __DIR__ . '/db.json');

// Garante que o arquivo existe
if (!file_exists(DB_FILE)) {
    file_put_contents(DB_FILE, json_encode([]));
}

function lerFilmes() {
    if (!file_exists(DB_FILE)) {
        return [];
    }
    $conteudo = file_get_contents(DB_FILE);
    return json_decode($conteudo, true) ?? [];
}

function salvarFilmes(array $novoFilme) {
    $filmes = lerFilmes();

    // Gera ID automático baseado no maior ID atual
    $ultimoId = 0;
    foreach ($filmes as $f) {
        if ($f['id'] > $ultimoId) {
            $ultimoId = $f['id'];
        }
    }

    $novoFilme['id'] = $ultimoId + 1;
    $filmes[] = $novoFilme;

    file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $novoFilme;
}
function gerarNovoId($filmes) {
    $ids = array_column($filmes, 'id');
    return $ids ? max($ids) + 1 : 1;
}
