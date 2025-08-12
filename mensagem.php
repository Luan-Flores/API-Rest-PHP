<?php
header('Access-Control-Allow-Origin: *'); // Liberar CORS para testes
header('Content-Type: application/json'); // Indicar retorno JSON

$resposta = [
    'mensagem' => 'Olá do PHP!',
    'autor' => 'Luan'
];

echo json_encode($resposta);
