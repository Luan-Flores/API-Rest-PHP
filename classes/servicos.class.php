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
}