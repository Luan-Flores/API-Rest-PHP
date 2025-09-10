<?php
header('Access-Control-Allow-Origin: *'); //Permitir acesso para todos endereços
header('Content-type: application/json'); //Api retorna dados em JSON
date_default_timezone_set("America/Sao_Paulo"); //Definindo o horário
// Permitir métodos necessários
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH");
// Permitir headers enviados pelo frontend
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Se a requisição for OPTIONS, apenas responde 200 e encerra
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
// var_dump($_GET['path']); //Tudo que vem da URL com parametro 'path'

// senha de criptografia para o TOKEN
$GLOBALS['secretJWT'] = '123456';
// echo password_hash('123456', PASSWORD_DEFAULT);
// var_dump($method); //Apenas para debug

# Autoload
include_once "classes/autoload.class.php";
new Autoload();

# Rotas
$rota = new Rotas();
$rota->add('POST', '/usuarios/login', 'Usuarios::login', false);
# clientes
$rota->add('GET', '/clientes/listar', 'Clientes::listarTodos', false);
$rota->add('GET', '/clientes/listar/[PARAM]', 'Clientes::listarUnico', false);
$rota->add('DELETE', '/clientes/deletar/[PARAM]', 'Clientes::deletar', false);
$rota->add('PATCH', '/clientes/atualizar/[PARAM]', 'Clientes::atualizar', false);
$rota->add('POST', '/clientes/adicionar', 'Clientes::adicionar', false);
# reservas
$rota->add('GET', '/reservas/listar', 'Reservas::listarTodos', false);
# serviços
$rota->add('GET', '/servicos/listar', 'Servicos::listarTodos', false);
$rota->add('PATCH', '/servicos/atualizar/[PARAM]', 'Servicos::atualizar', false);
$rota->ir($_GET['path']);

