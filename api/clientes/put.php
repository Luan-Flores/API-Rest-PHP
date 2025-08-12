<?php

if ($acao == 'update' && $param == ''){
    echo json_encode(["ERRO" => "Informe um cliente"]);
}
if ($acao == 'update' && $param != ''){
    array_shift($_POST);
    var_dump($_POST);
    $sql = "UPDATE clientes SET ";
    $contador = 1;
    foreach (array_keys($_POST) as $column){
            $value = $_POST[$column];
            
            if (count($_POST) > $contador){
                $sql .= "{$column} = '{$value}', ";
            }else{
                $sql .= "{$column} = '{$value}' ";
            }
        
        $contador++;
    }
    $sql .= "WHERE id = $param;";
    var_dump($sql);
    $rs = $db->prepare($sql);
    $exec = $rs->execute();
   
    echo json_encode(["dados" => $exec ? "Dados atualizados com sucesso" : "Erro ao inserir os dados"]);
    
}

// UPDATE table_name
// SET column1 = value1, column2 = value2, ...
// WHERE condition;
