<?php

class Clientes {
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }
    public function listarTodos(){
        // Buscar todos os clientes
        
            $rs = $this->db->prepare("SELECT * FROM clientes ORDER BY nome");
            $rs->execute();
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                "dados" => $dados ?: 'Não existem dados'
            ]);
            exit;
        
    }
    public function listarUnico($param){
        // Buscar cliente por ID
            
            $rs = $this->db->prepare("SELECT * FROM clientes WHERE id = {$param}");

            $rs->execute();
            $obj = $rs->fetchObject();
            echo json_encode([
                "dados" => $obj ?: 'Não existem dados'
            ]);
            exit;
        
    }
    public function adicionar(){
        $sql = "INSERT INTO clientes (";

        //metodo 1
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
        $rs = $this->db->prepare($sql);
        $exec = $rs->execute();

        // if ($exec){
        //     echo json_encode(["dados" => "Dados inseridos com sucesso."]);
        // }else {
        //     echo json_encode(["dados" => "Não existem dados para retornar"]);
        // }

        // troquei esse if/else pelo operador ternario

        echo json_encode(["dados"=> ($exec ? "Dados inseridos com sucesso" : "Erro ao inserir os dados")]);
    
    }
    public function atualizar($param){
        array_shift($_POST);
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
        $sql .= "WHERE id = {$param};";
        
        $rs = $this->db->prepare($sql);
        $exec = $rs->execute();
    
        echo json_encode(["dados" => $exec ? "Dados atualizados com sucesso" : "Erro ao inserir os dados"]);
        
    }
    public function deletar($param){
        $rs = $this->db->prepare("DELETE from clientes WHERE id = {$param};");
        $exec = $rs->execute();
        echo json_encode(["Dados" => $exec ? "Dados excluídos com sucesso" : "Não foi possível excluir os dados"]);
    }
    
}