<?php 

class Servicos{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function listarTodos(){
        try{
            //Buscar todos os serviços
            $rs = $this->db->prepare("SELECT * FROM servicos ORDER BY nome");
            $rs->execute();
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

            if (empty($dados)){
                http_response_code(204);
                exit;
            }

            http_response_code(200);
            echo json_encode([
                "dados" => $dados,
                "quantidade" => count($dados)
            ]);

        } catch (PDOException $e){
            // Tratamento de erro mais específico
            http_response_code(500);
            echo json_encode([
                "erro" => "Erro ao buscar serviços"
            ]);
        } 
        exit;
    }
    public function adicionar(){    
        $inputJson = file_get_contents('php://input');
        $input = json_decode($inputJson, true);

        $dados = (is_array($input) && count($input)) ? $input : $_POST;

        if (!is_array($dados) || count($dados) === 0 ){
            http_response_code(400);
            echo json_encode(["erro" => "Nenhum dado recebido"]);
            exit();
        }

        $colunas = array_keys($dados);
        $placeholders = array_map(fn($c) => ':' . $c, $colunas);

        $sql = "INSERT INTO servicos (" . implode(',', $colunas) . ") VALUES (" . implode(',', $placeholders) . ")";

        try{
            $stmt = $this->db->prepare($sql);
            
            foreach ($dados as $k => $v){
                $stmt->bindValue(":" . $k, $v);
            }

            $exec = $stmt->execute();
            
            if ($exec){
                http_response_code(201);
                echo json_encode(["dados" => "Dados adicionados com sucesso"]);
            }else{
                http_response_code(500);
                echo json_encode(["erro" => "Erro ao inserir os dados"]);
            }
        }catch (PDOException $e){
            http_response_code(500);
            echo json_encode(["erro" => "Erro no servidor", "detalhado" => $e->getMessage()]);
        }
    
    }

    public function atualizar($idServ){
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $dados = (is_array($input) && count($input)) ? $input : $_POST;

        if (!is_array($dados) || count($dados) === 0){
            http_response_code(400);
            echo json_encode(["erro" => "Nenhum dado recebido"]);
            exit();
        }

        $colunas = array_keys($dados);

        $pares = [];
        foreach($colunas as $col){
            $pares[] = "$col = :$col";
        }

        $sql = "UPDATE servicos SET " . implode(', ', $pares) . " WHERE id = :idServ";
        try{

            $stmt = $this->db->prepare($sql);
            
            foreach ($dados as $col => $valor){
                $stmt->bindValue(":$col", $valor);
            }
            
            $stmt->bindValue(":idServ", $idServ, PDO::PARAM_INT);
            
            $exec = $stmt->execute();
            
            if ($exec) {
                echo json_encode([
                    'sucesso' => true,
                    'mensagem' => 'Serviço atualizado com sucesso!',
                    'id' => $idServ,
                    'dados_atualizados' => $dados
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'erro' => 'Falha ao atualizar serviço.'
                ]);
            }
        }catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode([
                'erro' => 'Erro no servidor',
                'detalhe' => $th->getMessage()
            ]);
        }
    }

    public function deletar($idServ){
        $sql = "DELETE FROM servicos WHERE id = :idServ";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idServ', $idServ, PDO::PARAM_INT);
            $exec = $stmt->execute();
            if ($exec) http_response_code(204);
            else{
                http_response_code(500);
                echo json_encode(['erro' => 'Falha ao excluir serviço.']);
            }
        } catch (PDOException $e){
            http_response_code(500);
            echo json_encode(["erro" => "Erro no servidor", "detalhe" => $e->getMessage()]);
        }
    }
}