<?php

/**
 * db.php
 *
 * Este arquivo implementa as funções de acesso aos dados dos filmes, armazenados em um arquivo JSON (`db.json`).
 * Ele simula operações de banco de dados, oferecendo funções de leitura, escrita, atualização e exclusão.
 */

// Caminho do "banco de dados" (arquivo JSON)
define('DB_FILE', __DIR__ . '/db.json');

// Garante que o arquivo existe; se não, cria um arquivo vazio com array
if (!file_exists(DB_FILE)) {
    file_put_contents(DB_FILE, json_encode([]));
}

/**
 * Lê todos os filmes do arquivo JSON
 *
 * @return array Lista de filmes
 */
function lerFilmes()
{
    $conteudo = file_get_contents(DB_FILE);
    return json_decode($conteudo, true) ?? [];
}

/**
 * Salva um novo filme no "banco"
 *
 * @param array $novoFilme Dados do novo filme
 * @return array Filme salvo com ID gerado
 */
function salvarFilmes(array $novoFilme)
{
    $filmes = lerFilmes();

    // Define ID único para o novo filme
    $novoFilme['id'] = gerarNovoId($filmes);
    $filmes[] = $novoFilme;

    // Salva no arquivo
    file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $novoFilme;
}

/**
 * Atualiza um filme existente pelo ID
 *
 * @param int $id ID do filme a ser atualizado
 * @param array $filmeAtualizado Campos a serem atualizados
 * @return array|null Filme atualizado ou null se não encontrado
 */
function atualizarFilme(int $id, array $filmeAtualizado)
{
    $filmes = lerFilmes();
    $atualizado = false;

    foreach ($filmes as &$filme) {
        if ($filme['id'] == $id) {
            // Atualiza apenas os campos fornecidos
            $filme = array_merge($filme, $filmeAtualizado);
            $atualizado = true;
            break;
        }
    }

    if ($atualizado) {
        file_put_contents(DB_FILE, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $filme;
    }

    return null;
}

/**
 * Gera um novo ID baseado nos IDs existentes
 *
 * @param array $filmes Lista de filmes
 * @return int Novo ID único
 */
function gerarNovoId($filmes)
{
    $ids = array_column($filmes, 'id');
    return $ids ? max($ids) + 1 : 1;
}

/**
 * Remove um filme do "banco" pelo ID
 *
 * @param int $id ID do filme a ser removido
 * @return bool True se removido, false se não encontrado
 */
function deletarFilme(int $id)
{
    $filmes = lerFilmes();

    // Filtra o filme que deve ser removido
    $filmesFiltrados = array_filter($filmes, fn($f) => $f['id'] !== $id);

    // Se nada mudou, o filme não foi encontrado
    if (count($filmes) === count($filmesFiltrados)) {
        return false;
    }

    // Reindexa e salva
    file_put_contents(DB_FILE, json_encode(array_values($filmesFiltrados), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return true;
}
