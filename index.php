<?php
// $_SERVER['REQUEST_URI']: Pega o caminho da URL acessada.
$request = $_SERVER['REQUEST_URI'];

switch ($request){
  // Se a URL for /, mostra uma mensagem de boas-vindas simples.
  case '/':
      echo '<h1>Bem vindo - Home</h1>';
    break;
  // Se começar com /api, redireciona para o roteador da API (api/index.php).
  case str_starts_with($request, '/api'):
      require __DIR__ . '/api/index.php';
   break;
   // Qualquer outra rota retorna um erro 404.
    default:
      http_response_code(404);
      echo '404 - Pagina não encontrada';
    break;
};

?>