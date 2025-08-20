<?php

class Clientes {
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }
    public function listarTodos(){
        try {
            $rs = $this->db->prepare("SELECT * FROM clientes ORDER BY nome");
            $rs->execute();
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

            if (empty($dados)) {
                // Nenhum cliente → 204 (No Content)
                http_response_code(204);
                exit; // sem body, já que 204 não retorna conteúdo
            }

            // Clientes encontrados → 200 (OK)
            http_response_code(200);
            echo json_encode([
                "dados" => $dados,
                "quantidade" => count($dados)
            ]);

        } catch (PDOException $e) {
            // Erro inesperado → 500 (Internal Server Error)
            http_response_code(500);
            echo json_encode([
                "error" => "Erro ao buscar clientes"
            ]);
        }
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
    public function adicionar()
    {
        // Lê JSON do body (se houver)
        $inputJson = file_get_contents('php://input');
        $input = json_decode($inputJson, true);

        // Usa JSON decodificado ou $_POST (caso cliente envie form-urlencoded)
        $dados = (is_array($input) && count($input)) ? $input : $_POST;

        if (!is_array($dados) || count($dados) === 0) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nenhum dado recebido']);
            exit();
        }

        // Monta colunas e placeholders
        $colunas = array_keys($dados);
        $placeholders = array_map(fn($c) => ':' . $c, $colunas);

        $sql = "INSERT INTO clientes (" . implode(',', $colunas) . ") VALUES (" . implode(',', $placeholders) . ")";

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($dados as $k => $v) {
                $stmt->bindValue(':' . $k, $v);
            }
            $exec = $stmt->execute();

            if ($exec) {
                http_response_code(201);
                echo json_encode(['dados' => 'Dados inseridos com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['erro' => 'Erro ao inserir os dados']);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            // Em DEV você pode retornar a mensagem, em produção omita $e->getMessage()
            echo json_encode(['erro' => 'Erro no servidor', 'detalhe' => $e->getMessage()]);
        }
    }

    public function truncar(){
        $sql = "TRUNCATE TABLE clientes;";
        $rs = $this->db->prepare($sql);
        $exec = $rs->execute();
        echo json_encode(["dados" => $exec ? "Clientes apagados com sucesso" : "Erro ao apagar clientes"]);
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