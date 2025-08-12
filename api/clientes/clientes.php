<?php
if ( $acao == '' && $param == ''){
    echo json_encode(["ERRO" => 'Caminho não encontrado']); exit;
}
// Conectar ao banco uma única vez
$db = DB::connect();

if ($api === 'clientes') {
    if ($method === 'GET'){
        include_once "get.php";
    }

    if (Usuarios::verificar()){
        if ($method === 'POST' && !isset($_POST['_method'])){
            include_once "post.php";
        }
        elseif ($method == "POST" && isset($_POST['_method']) && $_POST['_method'] == "PUT"){
            include_once "put.php";
        }
        elseif ($method == "POST" && isset($_POST['_method']) && $_POST['_method'] == "DELETE"){
            include_once "delete.php";
        }
    } else{
        echo json_encode(['ERRO' => 'Você não está logado, ou seu token é inválido.']);
    }
}

