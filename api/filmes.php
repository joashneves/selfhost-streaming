<?php
require __DIR__ . '/../models/filmesModels.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$basePath = '/api/filmes';
$id = null;

$filmes = [
  [
    'id' => 1,
    'titulo' => 'O Poderoso Chefão',
    'genero' => 'Drama',
    'sinopse' => 'Don Corleone resolve tudo com um olhar mortal e propostas que você literalmente não pode recusar. Um guia prático de negócios, família e tapas de luva de pelica.',
    'publicacao' => '24/03/1972'
  ],
  [
    'id' => 2,
    'titulo' => 'Interestelar',
    'genero' => 'Ficção',
    'sinopse' => 'Gravidade, buracos negros e lágrimas no espaço: o manual de como plantar milho, atravessar galáxias e tentar entender o final com um diploma de física quântica nas mãos.',
    'publicacao' => '06/11/2014'
  ],
  [
    'id' => 3,
    'titulo' => 'Doctor Who',
    'genero' => 'Ficção',
    'sinopse' => 'Um alienígena britânico viaja no tempo com uma cabine telefônica azul, salvando o universo com um sorriso sarcástico e uma chave de fenda que faz tudo — menos parafusar.',
    'publicacao' => '23/11/1963'
  ],
  [
    'id' => 4,
    'titulo' => 'Jumanji',
    'genero' => 'Aventura',
    'sinopse' => 'Nunca subestime um jogo de tabuleiro antigo. Ele pode liberar selvas, leões, e até adultos traumatizados. Tudo por diversão em família e gritos pela casa inteira.',
    'publicacao' => '15/12/1995'
  ],
  [
    'id' => 5,
    'titulo' => 'Rei Leão',
    'genero' => 'Animação',
    'sinopse' => 'Prepare-se pra chorar com um pai leão, cantar com um javali e ver um suricato dando lição de vida. Hamlet na savana com muito Hakuna Matata e traumas infantis inclusos.',
    'publicacao' => '24/06/1994'
  ]
];

// Pega o ID da URL se houver
if (preg_match('#^' . $basePath . '/(\d+)$#', $requestUri, $matches)) {
    $id = (int)$matches[1];
}

switch ($method) {
    case 'GET':
        if ($id !== null) {
            $filme = Filme::getPorId($id);
            if ($filme) {
                echo json_encode($filme, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['erro' => 'Filme não encontrado']);
            }
        } else {
            echo json_encode(Filme::getTodos(), JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não suportado']);
        break;
}