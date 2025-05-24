<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request){
  case '/':
      echo '<h1>Bem vindo - Home</h1>';
    break;
  case str_starts_with($request, '/api'):
      require __DIR__ . '/api/index.php';
   break;
    default:
      http_response_code(404);
      echo '404 - Pagina não encontrada';
    break;
};

?>