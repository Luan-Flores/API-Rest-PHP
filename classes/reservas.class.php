<?php 

class Reservas {
    private $db;
    
    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function listarTodos(){
        try{
            $rs = $this->db->prepare("SELECT * FROM reservas");
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
        }
        catch (PDOException){
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao buscar reservas"]);   
        }
        exit;
    }


} 