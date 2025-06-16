<?php
/**
 * status.php
 *
 * Retorna o status da API em formato JSON, incluindo a hora atual do servidor.
 */

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Envia resposta com status e hora atual
echo json_encode([
    'status' => 'ok',
    'hora' => date('H:i:s')
]);
?>
