<?php
header('Content-Type: application/json');
    echo json_encode(['status' => 'ok', 'hora' => date('H:i:s')]);

?>