<?php

define('DB_FILE', __DIR__ . '/db.json');

// Garante que o arquivo existe
if (!file_exists(DB_FILE)) {
    file_put_contents(DB_FILE, json_encode([]));
}

function lerFilmes() {
    $json = file_get_contents(DB_FILE);
    return json_decode($json, true);
}

function salvarFilmes($filmes) {
    file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function gerarNovoId($filmes) {
    $ids = array_column($filmes, 'id');
    return $ids ? max($ids) + 1 : 1;
}
