<?php

if ($acao == 'delete' && $param == ''){
    echo json_encode(["ERRO" => "Informe um cliente"]);
    exit;
}

if ($acao == 'delete' && $param != ''){
    $rs = $db->prepare("DELETE from clientes WHERE id = {$param};");
    $exec = $rs->execute();
    echo json_encode(["Dados" => $exec ? "Dados excluídos com sucesso" : "Não foi possível excluir os dados"]);
}

// DELETE FROM table_name WHERE condition;