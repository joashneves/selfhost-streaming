<?php
header('Content-Type: application/json; charset=utf-8');

function responderJson(bool $success, string $message, $data = null, int $statusCode = 200) {
    http_response_code($statusCode);
    $response = ['success' => $success, 'message' => $message];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
}
