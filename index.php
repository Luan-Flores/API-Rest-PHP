<?php
header('Access-Control-Allow-Origin: *'); //Permitir acesso para todos endereços

header('Content-type: application/json'); //Api retorna dados em JSON

date_default_timezone_set("America/Sao_Paulo"); //Definindo o horário

// var_dump($_GET['path']); //Tudo que vem da URL com parametro 'path'


//Verifica se o parâmetro path foi enviado na URL (via .htaccess ou manualmente com ?path=alguma/coisa).
// if (isset($_GET['path'])) {
//     $path = explode('/', $_GET['path']);
// } else {
//     echo "Caminho inexistente 1"; exit;
// }    
// if (isset($path[0])) { $api = $path[0]; } else {echo "Caminho inexistente "; exit;}
// // Verifica se existe a primeira parte da URL (índice 0).
// // Salva em $api, que representa o "nome do recurso".
// // Exemplo: "usuarios" (ex: api/usuarios/listar/123).

// if (isset($path[1])) { $acao = $path[1]; } else {$acao = ''; }
// // Verifica se existe a segunda parte da URL.
// // Salva em $acao, que representa o que será feito (ex: "listar" ou "criar").

// if (isset($path[2])) { $param = $path[2]; } else { $param = ''; }
// //Verifica se existe a terceira parte da URL.
// //Salva em $param, que geralmente é um ID ou parâmetro específico (ex: "123").

// metodo ficou na classe rotas
// $method = $_SERVER['REQUEST_METHOD'];
// Captura o método HTTP da requisição (GET, POST, PUT, DELETE, etc).
// Isso é útil para definir o tipo de ação que será tomada.
// Por exemplo:
// GET → buscar dados
// POST → inserir
// PUT → atualizar
// DELETE → remover

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
$rota->add('GET', '/clientes/listar', 'Clientes::listarTodos', false);
$rota->add('GET', '/clientes/listar/[PARAM]', 'Clientes::listarUnico', true);
$rota->add('PUT', '/clientes/atualizar/[PARAM]', 'Clientes::atualizar', true);
$rota->add('POST', '/clientes/deletar/[PARAM]', 'Clientes::deletar', true);
$rota->add('POST', '/clientes/adicionar', 'Clientes::adicionar', true);
var_dump("TESTE");
$rota->ir($_GET['path']);

