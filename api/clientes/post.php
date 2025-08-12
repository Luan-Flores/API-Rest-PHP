<?php

if ($acao == 'adiciona' && $param == ''){
    $sql = "INSERT INTO clientes (";

    $contador = 1;
    foreach (array_keys($_POST) as $indice) {
        if (count($_POST) > $contador){
            $sql .= "{$indice},";
        }else {
            
            $sql .= "{$indice}";
        }
        $contador++;
    }
    $sql .= ") VALUES (";
    $contador = 1;
    foreach (array_values($_POST) as $valor){
        if (count($_POST) > $contador){
            $sql .= "'{$valor}',";
        }else{
            $sql .= "'{$valor}'";
        }
        $contador++;
    }


    $sql .= ");";
    var_dump($sql);
    $rs = $db->prepare($sql);
    $exec = $rs->execute();

    // if ($exec){
    //     echo json_encode(["dados" => "Dados inseridos com sucesso."]);
    // }else {
    //     echo json_encode(["dados" => "Não existem dados para retornar"]);
    // }

    // troquei esse if/else pelo operador ternario

    echo json_encode(["dados"=> ($exec ? "Dados inseridos com sucesso" : "Erro ao inserir os dados")]);
    
}