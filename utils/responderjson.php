<?php
// Define o cabeçalho para resposta JSON com charset UTF-8
header('Content-Type: application/json; charset=utf-8');

/**
 * Função para enviar resposta JSON padronizada
 * 
 * @param bool $success Indica sucesso ou falha da operação
 * @param string $message Mensagem descritiva para o cliente
 * @param mixed|null $data Dados opcionais a serem retornados
 * @param int $statusCode Código HTTP da resposta (padrão 200)
 */
function responderJson(bool $success, string $message, $data = null, int $statusCode = 200) {
    http_response_code($statusCode); // Define o código HTTP da resposta
    $response = ['success' => $success, 'message' => $message];

    // Inclui dados na resposta, se fornecidos
    if ($data !== null) {
        $response['data'] = $data;
    }

    // Envia a resposta JSON com caracteres unicode não escapados
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit(); // Encerra a execução após enviar a resposta
}
